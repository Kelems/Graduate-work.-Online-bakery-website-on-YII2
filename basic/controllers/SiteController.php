<?php
namespace app\controllers;

use Yii;

use yii\db\Query;

use yii\web\Controller;
use yii\web\Response;

use yii\data\Pagination;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\components\AccessRule;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\QuestionForm;

//use app\models\User;
use app\models\Category;
use app\models\Comment;
use app\models\Product;
use app\models\Ingredient;
use app\models\IngredientHasProduct;
use app\models\User;
use app\models\CommentForm;

//Controller
class SiteController extends Controller{

  //work behaviors
  public function behaviors(){
    return [
      'access' => [
        'class' => AccessControl::className(),
        // We will override the default rule config with the new AccessRule class
        'ruleConfig' => [
          'class' => AccessRule::className(),
        ],
        'only' => ['create', 'update', 'delete'],
        'rules' => [
          [
            'actions' => ['create'],
            'allow' => true,
            // Allow users, moderators and admins to create
            'roles' => [
                User::ROLE_USER,
                User::ROLE_ADMIN
            ],
          ],
          [
            'actions' => ['update'],
            'allow' => true,
            // Allow moderators and admins to update
            'roles' => [
              User::ROLE_ADMIN
            ],
        ],
        [
          'actions' => ['delete'],
          'allow' => true,
          // Allow admins to delete
          'roles' => [
            User::ROLE_ADMIN
          ],
        ],
      ],
    ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post', 'get'],
        ],
      ],
    ];
  }

  //I do not remember. need to watch
  public function actions(){
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  //поиск почты
  protected function findModel($email){
    if (($model = User::findOne(['email' => $email])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }

  //base page
  public function actionIndex(){
    $discounts = (new Product())->getSale(); // модель продукта 
    return $this->render('index', 
      compact('discounts'));
  }

  //contact page
  public function actionContact(){
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');
      return $this->refresh();
    }
    return $this->render('contact', ['model' => $model]);
  }

  //Category page
  public function actionCategory($id) {
    $id = (int)$id; //получаем id категории
    $temp = new Category(); // модель категории
    $category = $temp->getCategory($id); //получаем данные о категории для баннера   
    list($products, $pages) = $temp->getCategoryProduct($id);

    return $this->render(
      'category',
      compact('category', 'products', 'pages'));
    }
  
  //поиск по названию товара
  public function actionSearch($query = '', $page = 1) {
    $page = (int)$page;
    // получаем результаты поиска с постраничной навигацией
    list($products, $pages) = (new Product())->getSearchResult($query, $page);

    return $this->render(
      'category',
      compact('products', 'pages')
    );
  }

  //Product page
  public function actionProduct($id) {
    $id = (int)$id; //получаем id товара
    $product = (new Product())->getProduct($id);  //данные о продукте
    $ingredients = Product::findOne($id)->items;  //данные о ингридентах товара
 
    $comments = Product::findOne($id)->comments;
    $commentForm = new CommentForm();
    /*
      echo "<pre>";
      print_r($comments);
      echo "</pre>";
    */
    /*
      $data = Yii::$app->cache->get('product-'.$id);  // пробуем извлечь данные продукта из кеша
      $ingredients = $product->ingredients;
      if ($data === false) {                          // данных нет в кеше, получаем их заново
        $data = [$product, $ingredients];                     // сохраняем список для кэша
        Yii::$app->cache->set('product-'.$id, $data);         // сохраняем полученные данные в кеше
      }
      list($product,$ingredients) = $data;          //подготавливаем данные
    */

    return $this->render(
      'product',
      compact('product','ingredients', 'comments', 'commentForm')
    );
  }

  //Registration page
  public $Password;
  public function actionRegistration() {
    if (!Yii::$app->user->isGuest) { //авторизовался ли уже пользователь
      return $this->goHome();
    }

    $registration = new User(); //создаем модель из бд
    $registration->scenario = 'registration'; //проводит по сценарию

    if ($registration->load(Yii::$app->request->post())) { //проверка на отправку данных

      $query = (new User())->findByUsername($registration['email']); //ищем такого пользователя в бд
      if(empty($query))
      {
        $this->Password = $registration->password;
        $registration->password = Yii::$app->security->generatePasswordHash($registration->password);
        if ($registration->save()) {
          Yii::$app->session->setFlash('success','Вы внесены в систему');
          return $this->goHome();
        }
        else {
          $registration->password = $this->password;
          Yii::$app->session->setFlash('dismissible','Произошла ошибка');
          return $this->render('regist', compact('registration'));
        }
        
      }else {
        Yii::$app->session->setFlash('info','Такой пользователь существует!');
        return $this->refresh();
      }
      
    }
    return $this->render('regist', compact('registration'));
  }


  //страница авторизации
  public function actionLogin(){
    if (!Yii::$app->user->isGuest) {
      Yii::$app->session->setFlash('info', "Вы и так авторизованны!");
      return $this->goHome();
    }
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      Yii::$app->session->setFlash('success', "С возвращением!");
      return $this->goBack();
    }
    $model->password = '';
    return $this->render('login', ['model' => $model,]);
  }


  //страница секретного вопроса
  public function actionRecovery(){
    if (!Yii::$app->user->isGuest) { //пользователь в системе
      Yii::$app->session->setFlash('info', "Вы и так авторизованны!");
      return $this->goHome();
    }

    $model = new QuestionForm();
    if ($model->load(Yii::$app->request->post())  && $model->check() ) {  
      /*
        echo "<pre>";
        print_r($model->email);
        echo "</pre>";
      */
      return $this->redirect(['answer', 'email' => $model->email]);
    }

    return $this->render('recovery', ['model' => $model]);
  }

    //страница ввода секретного вопроса
  public function actionAnswer($email){
    if (!Yii::$app->user->isGuest) { //пользователь в системе
      Yii::$app->session->setFlash('info', "Вы и так авторизованны!");
      return $this->goHome();
    }
      $model = new QuestionForm();
      $query = (new User())->findByUsername($email);
      $model->secret_question = $query->secret_question; 
      $model->email = $query->email;; 

    if ($model->load(Yii::$app->request->post()) && !empty($model->answer) && $model->login()  ) {
      Yii::$app->session->setFlash('info', "Вы успешно смогли войти в свой профиль");

      return $this->render('profile', ['model' => $this->findModel($email)]);

    }

    return $this->render('answer', ['model' => $model]);
  }  

  //страница профиля
  public function actionProfileView($email){
    if (Yii::$app->user->identity->role_id > 0) {
      return $this->render('profile', ['model' => $this->findModel($email)]);
    }else {
      Yii::$app->session->setFlash('info', "Сначала войдите в профиль!");
      return $this->render('index', compact('saleProducts'));
    }
  }

  //страница обновления данных Профиля
  public function actionProfileUpdate($email){
    if (Yii::$app->user->identity->role_id >0) {
      $model = $this->findModel($email);
      if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', "Данные успешно обновленны");
        return $this->redirect(['profile-view', 'email' => $model->email]);
      }
      return $this->render('update', ['model' => $model,]);
    }
  }

  //выход из профиля
  public function actionLogout(){
    Yii::$app->user->logout();
    return $this->goHome();
  }

  //administration panel
	public function actionTables(){
    return $this->render('tables');
  }

  //добавление комментариев
  public function actionComment($id){
    $model = new CommentForm();
    if(Yii::$app->request->isPost)
    {
      $model->load(Yii::$app->request->post());
      if($model->saveComment($id)){
        Yii::$app->session->setFlash('success', "Ваш отзыв отправлен");
        return $this->redirect(['site/product','id'=> $id]);
      }else{
        Yii::$app->session->setFlash('dismissible', "Что-то пошло не так!");
      }
    }
  }
}
