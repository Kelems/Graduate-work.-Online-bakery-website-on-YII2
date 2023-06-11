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


  //внесение заказа
  public function actionCheckout() {
    if (!Yii::$app->user->isGuest) { //авторизовался ли уже пользователь

      $order = new Order();
      //данные о текущем пользователе
      $model = Yii::$app->user->identity;
      //передача необходимых данных в заказ
      $order->name = $model->name;
      $order->user_id = $model->id;
      $order->email = $model->email;
      $order->phone = $model->phone;
      $order->address = $model->address;
      
      //данные о корзине заказа
      $basket = new Basket();
      $content = $basket->getBasket();

      //итоговая сумма пользователя для поиска процента скидки
      $total = Yii::$app->user->identity->total_of_all_order;
      $query = (new yii\db\Query())
      ->select('max(percent) AS perc')
      ->from('discount')
      ->where(['<=','required_value', $total])
      ->all();
      
      //сохраняем наибольший процент скидки пользователя в переменную
      $temp = $query[0];
      $disc = $temp['perc'];

      $order->cost = $content['amount'];
      //проверка на скдку
      if ($disc > 0) {
        $order->cost = $content['amount'] - ($content['amount'] * $disc);
      }
      
      if ($order->load(Yii::$app->request->post())) {
        // проверяем эти данные
        if (!$order->validate()) {

          // данные не прошли валидацию, отмечаем этот факт
          Yii::$app->session->setFlash('dismissible',"Данные некорректны!");
          // сохраняем в сессии введенные пользователем данные
          Yii::$app->session->setFlash(
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
          //  Сохраняем в сессии массив сообщений об ошибках. Массив имеет вид
          [
            'name' => [
              'Поле «Ваше имя» обязательно для заполнения',
            ],
            'email' => [
              'Поле «Ваш email» обязательно для заполнения',
              'Поле «Ваш email» должно быть адресом почты'
            ],
          ];
          
          Yii::$app->session->setFlash(
            'checkout-errors',
            $order->getErrors()
          );
        } else { // данные успешно прошли валидацию

            $basket = new Basket();
            $content = $basket->getBasket();
          
          if (!empty($content)) { //проверка контента на наличие данных в корзине
            
            // Заполняем остальные поля модели — те которые приходят не из формы, а которые надо получить из корзины.

            $order->cost = $content['amount'];

            if ($disc > 0) {
              $order->cost = $content['amount'] - ($content['amount'] * $disc);
            }
            
            // цена доставки по городу (можно реализовать через доп.таблцу в бд...)
            switch ($order->city) {
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
            
            // сохраняем заказ в базу данных
            $order->insert();
            $order->addItems($content);

            // обновляем данные о итоговых значениях пользователя
            $total = Yii::$app->user->identity->total_of_all_order;
            $total = $total + $order->cost;
            Yii::$app->user->identity->total_of_all_order = $total;

            Yii::$app->user->identity->save();

            /*
              // отправляем письмо покупателю
              $mail = Yii::$app->mailer->compose(
                'order',
                ['order' => $order]
              );
              //отправка почты
              $mail->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo($order->email)
                    ->setSubject('Заказ в магазине № ' . $order->id)
                    ->send();
            */

            // очищаем содержимое корзины
            $basket->clearBasket();
            // данные прошли валидацию, заказ успешно сохранен
            Yii::$app->session->setFlash('success', "Ваш заказ успешно сохранен");

          }else{ // корзина пользователя оказалась пуста (залез куда не надо)
            Yii::$app->session->setFlash('dismissible', "Ваша корзина пуста!");
            return $this->goBack();
          }
          
        }
          // выполняем отправку на главную страницу при успешном внесении данных
        return $this->goHome();
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
