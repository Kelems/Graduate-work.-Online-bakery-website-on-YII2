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
use app\models\User;

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
        return $this->render('login', ['model' => $model,]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
          Yii::$app->session->setFlash('contactFormSubmitted');
          return $this->refresh();
        }
        return $this->render('contact', ['model' => $model,]);
    }

	public function actionTables()
    {
        return $this->render('tables');
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

}
