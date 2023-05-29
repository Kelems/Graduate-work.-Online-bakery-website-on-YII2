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


class OrderController extends Controller {
    public $defaultAction = 'checkout';

    public function actionCheckout() {
      $order = new Order();
      //данные о текущем пользователе
      $model = Yii::$app->user->identity;
      //передача необходимых данных в заказ
      $order->name = $model->name;
      $order->user_id = $model->id;
      $order->email = $model->email;
      $order->phone = $model->phone;
      $order->address = $model->address;
/*
      echo "<pre>";
      print_r($model);
      echo "</pre>";
*/

      if ($order->load(Yii::$app->request->post())) {
        // проверяем эти данные
        if ( ! $order->validate()) {
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
                 * Сохраняем в сессии массив сообщений об ошибках. Массив имеет вид
                 * [
                 *     'name' => [
                 *         'Поле «Ваше имя» обязательно для заполнения',
                 *     ],
                 *     'email' => [
                 *         'Поле «Ваш email» обязательно для заполнения',
                 *         'Поле «Ваш email» должно быть адресом почты'
                 *     ]
                 * ]
                 */
          Yii::$app->session->setFlash(
            'checkout-errors',
            $order->getErrors()
          );
        } else {
                /*
                 * Заполняем остальные поля модели — те которые приходят
                 * не из формы, а которые надо получить из корзины. Кроме
                 * того, поля created и updated будут заполнены с помощью
                 * метода Order::behaviors().
                 */
          $basket = new Basket();
          $content = $basket->getBasket();
          $order->cost = $content['amount'];
          // сохраняем заказ в базу данных
          $order->insert();
          $order->addItems($content);
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
  }

}
