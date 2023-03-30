<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\OnelForm;
use app\models\SignupForm;
use app\models\User;
use yii\data\Pagination;
use yii\db\Query;
// модели таблиц
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\IngredientsHasProvider;
use app\modules\admin\models\Provider;
use app\modules\admin\models\Purchases;
// модели поиска
use app\modules\admin\models\IngredientsSearch;
use app\modules\admin\models\IngredientshasproviderSearch;
use app\modules\admin\models\ProviderSearch;
use app\modules\admin\models\PurchasesSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	  /* debug(Yii::$app->request->post());
	   $model = new OnelForm();
	   if ($model->load(Yii::$app->request->post())) {
		   if ($model->validate()) {
			   Yii::$app->session->setFlash ('SUCCESS', 'Лабораторная работа №1');
		   }
		   else {
			   Yii::$app->session->setFlash ('error', 'Ошибка');
		   }
	   }*/
	   return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionBread()
    {
        return $this->render('bread');
    }

	public function actionPodbor()
    {
        return $this->render('podbor');
    }


	public function actionPies()
    {
        return $this->render('pies');
    }

	public function actionDesserts()
    {
        return $this->render('desserts');
    }

	public function actionSay ($message = 'Hello')
	{
		return $this->render('say', ['message' => $message]);
	}

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

	public function actionOnel()
    {
        $model = new OnelForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            // делаем что-то полезное с $model ...
             return $this->render('onel-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('onel', ['model' => $model]);
        }
    }

	//public function actionShowFlash() {
		//$session = Yii::$app->session;
		//$session->setFlash('greeting', 'Лабораторная работа №1');
		//return $this->render('showflash');
	//}

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

  public function actionIngredient() //запрос на ресурсы
  {
    $model = new Ingredients();
     if($model->load(Yii::$app->request->post()) ){
       if ($model->amount == '') {
         $query = Ingredients::find();
       }else {
         $query = Ingredients::find()
         ->where(['<=','amount',$model->amount]); //вывод данных на основе введенного слова в форму
       }
     }else {
       $query = Ingredients::find(); // если данных из формы нет, то базовый вывод
     }
    $ingredientz = $query->orderBy(['id' => SORT_ASC]) //сортировка по полю id
                   ->all();
    return $this->render('ingredient', [
      'model' => $model, //закругка model
      'ingredientz' => $ingredientz
    ]);
  }
  /*
    select *
    from ingredients
    where ingredients.amount < N
  */

  public function actionPredlojenie() //запрос на ресурсы
  {
    $model = new Ingredients();
    if($model->load(Yii::$app->request->post())) {
      if ($model->amount == '') {
        $query = (new Query())
        ->select    (['ingredients.id','ingredients.name','provider.name_provider','ingredients_has_provider.cost'])
        ->from      ('ingredients_has_provider')
        ->innerjoin ('ingredients','ingredients.id = ingredients_has_provider.ingredients_id')
        ->innerjoin ('provider'   ,'provider.id    = ingredients_has_provider.provider_id');
      }else {
        $query = (new Query())
        ->select    (['ingredients.id','ingredients.name','provider.name_provider','ingredients_has_provider.cost'])
        ->from      ('ingredients_has_provider')
        ->innerjoin ('ingredients','ingredients.id = ingredients_has_provider.ingredients_id')
        ->innerjoin ('provider'   ,'provider.id    = ingredients_has_provider.provider_id')
        ->where     (['<=','ingredients.amount',$model->amount]); //вывод данных на основе введенного слова в форму
        $model = new Ingredients();
      }
    }else{
      $query = (new Query())
      ->select    (['ingredients.id','ingredients.name','provider.name_provider','ingredients_has_provider.cost'])
      ->from      ('ingredients_has_provider')
      ->innerjoin ('ingredients','ingredients.id = ingredients_has_provider.ingredients_id')
      ->innerjoin ('provider'   ,'provider.id    = ingredients_has_provider.provider_id');
    }

      $predlojeniez = $query->orderBy(['ingredients.id' => SORT_ASC]) //сортировка по полю id
                            ->all();

      return $this->render('predlojenie', [
        'model' => $model,
        'predlojeniez' => $predlojeniez,
      ]);
  }
  /*
  select ingredients.name, ingredients.amount, provider.name_provider, ingredients_has_provider.cost
  from ingredients_has_provider
  left join ingredients on ingredients.id = ingredients_has_provider.ingredients_id
  right join provider on  provider.id = ingredients_has_provider.provider_id
  where  ingredients.amount <= 21
  */

  public function actionItogpostavchik() //запрос на ресурсы
  {
    $model = new Purchases();
    if($model->load(Yii::$app->request->post())) {
      if ($model->order_date == '') {
        $query = (new Query())
        ->select    (['purchases.order_date','provider.name_provider','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
        ->from      ('kris_site.purchases')
        ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
        ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
        ->groupBy   (['purchases.order_date','provider.name_provider']);
      }else {
        $query = (new Query())
        ->select    (['purchases.order_date','provider.name_provider','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
        ->from      ('kris_site.purchases')
        ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
        ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
        ->where     (['order_date'=> $model->order_date])
        ->groupBy   (['purchases.order_date','provider.name_provider']); //вывод данных на основе введенного слова в форму
        $model = new Purchases();
      }
    }else{
      $query = (new Query())
      ->select    (['purchases.order_date','provider.name_provider','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
      ->from      ('kris_site.purchases')
      ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
      ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
      ->groupBy   (['purchases.order_date','provider.name_provider']);
    }

      $itogpostavchikz = $query->orderBy(['provider.name_provider' => SORT_ASC]) //сортировка по полю id
                            ->all();

      return $this->render('itogpostavchik', [
        'model' => $model,
        'itogpostavchikz' => $itogpostavchikz,
      ]);
  }

  public function actionItogday() //запрос на ресурсы
  {
    $model = new Purchases();
    if($model->load(Yii::$app->request->post() )) {
      if ($model->order_date == '') {
        $query = (new Query())
        ->select    (['purchases.order_date','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
        ->from      ('kris_site.purchases')
        ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
        ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
        ->groupBy   (['purchases.order_date']);
      }else {
        $query = (new Query())
        ->select    (['purchases.order_date','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
        ->from      ('kris_site.purchases')
        ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
        ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
        ->where     (['order_date'=> $model->order_date])
        ->groupBy   (['purchases.order_date']); //вывод данных на основе введенного слова в форму
        $model = new Purchases();
      }
    }else{
      $query = (new Query())
      ->select    (['purchases.order_date','Sum(ingredients_has_provider.cost * purchases.amount) AS cost'])
      ->from      ('kris_site.purchases')
      ->innerjoin ('ingredients_has_provider','purchases.ingredients_has_provider_provider_id = ingredients_has_provider.provider_id')
      ->leftjoin  ('provider'   ,'provider.id = ingredients_has_provider.provider_id')
      ->groupBy   (['purchases.order_date']);
    }

      $itogdayz = $query->orderBy(['purchases.order_date' => SORT_ASC]) //сортировка по полю id
                            ->all();

      return $this->render('itogday', [
        'model' => $model,
        'itogdayz' => $itogdayz,
      ]);
  }
















/*
  public function actionPredlojenie() //запрос на ресурсы
  {
    //подзапрос
    $model = new Ingredients();
    if($model->load(Yii::$app->request->post()) ){
      $queryt = Ingredients::find()
      ->where(['<=','amount',$model->amount]); //вывод данных на основе введенного слова в форму
    }else {
      $queryt = Ingredients::find()->orderBy(['id' => SORT_ASC])->all();; // если данных из формы нет, то базовый вывод
    }

    //основной запрос
//      $queryt = Ingredients::find();//подзапрос
     if($model->load(Yii::$app->request->post()) ){
       //      $subquery = $queryt->select('name'); //подзапрос "SELECT employees_id FROM projectorg.departments"
       $query = Ingredientshasprovider::find()
       ->where(['name' => $queryt->name]);
//       ->where(['<=','amount',$model->amount]); //вывод данных на основе введенного слова в форму
     }else {
       $query = Ingredientshasprovider::find(); // если данных из формы нет, то базовый вывод
     }
    $predlojeniez = $query->orderBy(['ingredients_id' => SORT_ASC]) //сортировка по полю id
                   ->offset($pagination->offset) //отвечает за начало выводимых данных
                   ->limit($pagination->limit) // отвечает за количество выводимых от начала данных
//                     ->andWhere(['id' => $subquery ])
                   ->all();
    return $this->render('predlojenie', [
      'queryt' => $queryt, //закругка model
      'predlojeniez' => $predlojeniez
    ]);
  }
*/
}
