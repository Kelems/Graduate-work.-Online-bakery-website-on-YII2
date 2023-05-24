<?php
namespace app\controllers;

use Yii;

use yii\db\Query;

use yii\web\Controller;
use yii\web\Response;

use yii\data\Pagination;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

//use app\models\User;
use app\models\Category;
use app\models\Product;
use app\models\Ingredient;
use app\models\IngredientHasProduct;

//Controller
class SiteController extends Controller{

  //work behaviors
  public function behaviors(){
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
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

  //base page
  public function actionIndex(){
    // получаем товары по скидке. доработать
    $saleProducts = Yii::$app->cache->get('sale-products');
    if ($saleProducts === false) {
      $saleProducts = Product::find()->where(['old_price'] > '1')->limit(3)->asArray()->all();
      Yii::$app->cache->set('sale-products', $saleProducts);
    }

    return $this->render('index', compact('saleProducts'));
  }

  //Category page
  public function actionCategory($id) {
    $id = (int)$id; //получаем id категории
    $temp = new Category(); // категори
    list($products, $pages) = $temp->getCategoryProduct($id);

    $category = $temp->getCategory($id); //получаем данные о категории
    return $this->render(
      'category',
      compact('category', 'products', 'pages')
    );
  }

  //Product page
  public function actionProduct($id) {
    $id = (int)$id; //получаем id товара

    $data = Yii::$app->cache->get('product-'.$id);  // пробуем извлечь данные продукта из кеша
    if ($data === false) {                          // данных нет в кеше, получаем их заново
      $product = (new Product())->getProduct($id);  //данные о продукте

      //list($ingredients) = $temp->getIngredientproduct($id);//допилить
      //$ingredients = (new Ingredient())->getIngredientproduct($id);

      $data = [$product, $ingredients];                     // сохраняем список для кэша
      Yii::$app->cache->set('product-'.$id, $data);         // сохраняем полученные данные в кеше
    }
    list($product,$ingredients) = $data; //подготавливаем данные

    return $this->render(
      'product',
      //'ingredients', //доделать вывод ингредиентов используемых в товаре
      compact('product','ingredients')
    );
  }

  //log in to your account
  public function actionLogin(){
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    $model->password = '';
    return $this->render('login', ['model' => $model,]);
  }

  //log out of your account
  public function actionLogout(){
    Yii::$app->user->logout();
    return $this->goHome();
  }

  //contact page
  public function actionContact(){
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');
      return $this->refresh();
    }
    return $this->render('contact', ['model' => $model,]);
  }

  //administration panel
	public function actionTables(){
    return $this->render('tables');
  }

//entry.. page? I do not remember. need to watch
/*
	public function actionEntry()
    {
        $model = new EntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            // делаем что-то полезное с $model ...
             return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('entry', ['model' => $model]);
        }
    }
*/

//Signup page
/*
  public function actionSignup() {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new SignupForm();
    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
      $user = new User();
      $user->username = $model->username;
      $user->password = \Yii::$app->security->generatePasswordHash($model->password);
      if ($user->save()) {
        return $this->goHome();
      }
    }
    return $this->render('signup', compact('model'));
  }
*/
}
