<?php
namespace app\controllers;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Response;
use app\models\Order;
use app\models\OrderItem;
use app\models\User;
use app\models\Basket;
use app\models\SignupForm;
use app\controllers\Alert;
class OrderController extends Controller {
  public $defaultAction = 'checkout';
  public function actionCheckout() {        //внесение заказа
    if (!Yii::$app->user->isGuest) {        //авторизовался ли уже пользователь
      $order = new Order();
      $model = Yii::$app->user->identity;   //данные о текущем пользователе
      $order->name = $model->name;          //передача необходимых данных в заказ
      $order->user_id = $model->id;
      $order->email = $model->email;
      $order->phone = $model->phone;
      $order->address = $model->address;
      $basket = new Basket();       //данные о корзине заказа
      $content = $basket->getBasket();
      $total = Yii::$app->user->identity->total_of_all_order; //итоговая сумма пользователя для поиска процента скидки
      $query = (new yii\db\Query())->select('max(percent) AS perc')->from('discount')->where(['<=','required_value', $total])->all();
      $temp = $query[0]; //сохраняем наибольший процент скидки пользователя в переменную
      $disc = $temp['perc'];
      $order->cost = $content['amount'];
      if ($disc > 0) { $order->cost = $content['amount'] - ($content['amount'] * $disc); } //проверка на скдку
      if ($order->load(Yii::$app->request->post())) { 
        if (!$order->validate()) { // проверяем данные
          Yii::$app->session->setFlash('dismissible',"Данные некорректны!"); // данные не прошли валидацию, отмечаем этот факт
          Yii::$app->session->setFlash( // сохраняем в сессии введенные пользователем данные
            'checkout-data',
            [
              'name' => $order->name,
              'email' => $order->email,
              'phone' => $order->phone,
              'address' => $order->address,
              'pickup' => $order->pickup,
              'address' => $order->address,
              'comment' => $order->comment,
              'city' => $order->city,
              'city_cost' => $order->city_cost,
              'time_delivery' => $order->time_delivery,
            ]
          );
          [ //  Сохраняем в сессии массив сообщений об ошибках
            'name' => ['Поле «Ваше имя» обязательно для заполнения'],
            'email' => [
              'Поле «Ваш email» обязательно для заполнения',
              'Поле «Ваш email» должно быть адресом почты'
            ],
          ];
          Yii::$app->session->setFlash( 'checkout-errors', $order->getErrors() );
        } else { // данные успешно прошли валидацию
            $basket = new Basket();
            $content = $basket->getBasket();
          if (!empty($content)) { //проверка контента на наличие данных в корзине
            $order->cost = $content['amount']; // Заполняем остальные поля модели — те которые приходят не из формы, а которые надо получить из корзины.
            if ($disc > 0) { $order->cost = $content['amount'] - ($content['amount'] * $disc); }
            switch ($order->city) { // цена доставки по городу
              case 'Ростов-на-Дону':
                $order->city_cost = 0;
                break;
              case 'Батайск':
                $order->city_cost = 250; 
                break;
              case 'Аксай':
                $order->city_cost = 500;
                break;
              case 'Новочеркасск':
                $order->city_cost = 1000;
                break;
              case 'Новошахтинск':
                $order->city_cost = 1150;
                break;
              case 'Таганрог':
                $order->city_cost = 1250;
                break;
              case 'Шахты':
                $order->city_cost = 1500;
                break;
            }
            $order->insert(); // сохраняем заказ в базу данных
            $order->addItems($content);
            $total = Yii::$app->user->identity->total_of_all_order; // обновляем данные о итоговых значениях пользователя
            $total = $total + $order->cost;
            Yii::$app->user->identity->total_of_all_order = $total;
            Yii::$app->user->identity->save();
            $basket->clearBasket(); // очищаем содержимое корзины
            Yii::$app->session->setFlash('success', "Ваш заказ успешно сохранен"); // данные прошли валидацию, заказ успешно сохранен
          }else{ // корзина пользователя оказалась пуста (залез куда не надо)
            Yii::$app->session->setFlash('dismissible', "Ваша корзина пуста!");
            return $this->goBack();
          }
        } 
        return $this->goHome(); // выполняем отправку на главную страницу при успешном внесении данных
      }
      return $this->render('checkout', ['order' => $order]);
    }else{ //пользователь не авторизовался
      Yii::$app->session->setFlash('dismissible', "сначала войдите в профиль!");
      $model = new SignupForm();
      $model->password = '';
      return $this->render('/site/login', ['model' => $model,]);
    }
  }
}