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
      

      $basket = new Basket();
      $content = $basket->getBasket();

      $total = Yii::$app->user->identity->total_of_all_order;
      //ищем наибольший процент
      $query = (new yii\db\Query())
      ->select('max(percent) AS perc')
      ->from('discount')
      ->where(['<=','required_value', $total])
      ->all();
      
      //сохраняем наибольший процент скидки пользователя в переменную
      $temp = $query[0];
      $disc = $temp['perc'];

      $order->cost = $content['amount'];

      if ($disc > 0) {
        $order->cost = $content['amount'] - ($content['amount'] * $disc);
      }

      /*      
        echo "<pre>";
        print_r($disc);
        print_r($order->cost);
        echo "</pre>";
      */    
      
      if ($order->load(Yii::$app->request->post())) {
        // проверяем эти данные
        if (!$order->validate()) {
          // данные не прошли валидацию, отмечаем этот факт
          Yii::$app->session->setFlash('checkout-success',false);
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
            ]
          );
          /*
            //  Сохраняем в сессии массив сообщений об ошибках. Массив имеет вид
            [
             'name' => [
               'Поле «Ваше имя» обязательно для заполнения',
             ],
             'email' => [
               'Поле «Ваш email» обязательно для заполнения',
               'Поле «Ваш email» должно быть адресом почты'
             ]
            ]
          */
          Yii::$app->session->setFlash(
            'checkout-errors',
            $order->getErrors()
          );
        } else {
    
          // Заполняем остальные поля модели — те которые приходят не из формы, а которые надо получить из корзины.
    
          $basket = new Basket();
          $content = $basket->getBasket();
          $order->cost = $content['amount'];

          if ($disc > 0) {
            $order->cost = $content['amount'] - ($content['amount'] * $disc);
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
            Yii::$app->session->setFlash(
              'checkout-success',
              true
            );
          }
          // выполняем отправку на главную страницу при успешном внесении данных
          return $this->goHome();
        }
      return $this->render('checkout', ['order' => $order]);
    }else{
    echo '<script> Alert("Сначала войдите в профиль!") </script>';
      return $this->redirect(['basket/index']);
   //   return $this->goBack();
    }
    $model->password = '';
    return $this->render('login', ['model' => $model,]);
  }

}
