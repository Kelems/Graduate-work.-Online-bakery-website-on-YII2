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

//use app\models\User;
use app\models\Category;
use app\models\Product;
use app\models\Ingredient;
use app\models\IngredientHasProduct;
use app\models\User;


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

  //поиск по модели
  protected function findModel($email){
    if (($model = User::findOne(['email' => $email])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }

  //base page
  public function actionIndex(){
    // получаем товары по скидке. доработать
    $discounts = (new Product())->getSale(); // модель продукта
  // $searchModel = new ProductSearch();
    /*
      // проверка вывода данных о товаре
      echo "<pre>";
      print_r($temp);
      echo "</pre>";
      //    echo "эх.. = $ingredients";
    */    
    return $this->render('index', 
  //    ['searchModel' => $searchModel],
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
      compact('product','ingredients')
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
    /*
      $login = new User(); //создаем модель из бд
      $login->scenario = 'login'; //проводит по сценарию
      if ($login->load(Yii::$app->request->post()) && $login->login() ) {
        return $this->goHome();
      }
    */
    if ($registration->load(Yii::$app->request->post())) { //проверка на отправку данных
      //        if(!find()->where(['email'=>$registration->email])->limit(1)->all()){
      $this->Password = $registration->password;
      $registration->password = Yii::$app->security->generatePasswordHash($registration->password);
      if ($registration->save()) {
        Yii::$app->session->setFlash('success','Вы внесены в систему');
        return $this->goHome();
      }
      else {
        $registration->password = $this->password;
        //  Yii::$app->session->setFlash('dismissible','Произошла ошибка');
        return $this->render('regist', compact('registration'));
      }
        /*
      }else {
        Yii::$app->session->setFlash('info','Такой пользователь существует!');
        return $this->goHome();
      }
      */
    }
    return $this->render('regist', compact('registration'));
  }

  //страница авторизации
  public function actionLogin(){
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    $model->password = '';
    return $this->render('login', ['model' => $model,]);
  }

  //страница профиля
  public function actionProfileView($email){
    if (Yii::$app->user->identity->role_id >0) {
      return $this->render('profile', ['model' => $this->findModel($email)]);
    }else {
      return $this->render('index', compact('saleProducts'));
    }
  }

  //страница обновления данных Профиля
  public function actionProfileUpdate($email){
    if (Yii::$app->user->identity->role_id >0) {
      $model = $this->findModel($email);
      if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['profile-view', 'email' => $model->email]);
      }
      return $this->render('update', ['model' => $model,]);
    }
  }


  public function actionLogout(){
    Yii::$app->user->logout();
    return $this->goHome();
  }

  //administration panel
	public function actionTables(){
    return $this->render('tables');
  }


}
