<?php
namespace app\controllers;

use Yii;

use yii\db\Query;

use yii\web\Controller;
use yii\web\Response;

use app\models\Basket;
use app\models\Discount;

class BasketController extends Controller {
  //страница корзины
  public function actionIndex() {
    $basket = (new Basket())->getBasket();
    //проверка пустая ли корзина
    if(!empty($basket)){

      if (!Yii::$app->user->isGuest) {
        // раз в корзине что-то есть, то проверяем сколько у пользователя всего было потрачено
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

        if ($disc > 0) {
          $value['amount'] = $basket['amount'] - ($basket['amount'] * $disc);
          $basket['amount'] = $value['amount'];
        }
      }
    }
    
    /*
      echo "<pre>";
        print_r($basket);
      echo "</pre>";
    */
    
    return $this->render('index', [
      'basket' => $basket,
      'disc' => $disc
     ]);
  }

  //добавление в корзину
  public function actionAdd() {
    $basket = new Basket(); //создаем корзину
    if (!Yii::$app->request->isPost) { // Данные должны приходить методом POST; если это не так — просто показываем корзину
      return $this->redirect(['basket/index']);
    }

    $data = Yii::$app->request->post();
    if (!isset($data['id'])) {
      return $this->redirect(['basket/index']);
    }
    if (!isset($data['count'])) {
      $data['count'] = 1;
    }

    // добавляем товар в корзину и перенаправляем покупателя на страницу корзины
    $basket->addToBasket($data['id'], $data['count']);

    if (Yii::$app->request->isAjax) { // с использованием AJAX
      // layout-шаблон нам не нужен, только view-шаблон
      $this->layout = false;
      $content = $basket->getBasket();
      return $this->render('modal', ['basket' => $content]);
    } else { // без использования AJAX
            return $this->redirect(Yii::$app->request->referrer);
      //      return $this->redirect(['basket/index']);
      }
    }

  //очищаем корзину
  public function actionRemove($id) {
    $basket = new Basket();
    $basket->removeFromBasket($id);
    /* Тут возможны две ситуации: пришел просто GET-запрос или GET-запрос с использованием XmlHttpRequest */
    if (Yii::$app->request->isAjax) { // с использованием AJAX
      // layout-шаблон нам не нужен, только view-шаблон
      $this->layout = false;
      $content = $basket->getBasket();
      return $this->render('modal', ['basket' => $content]);
    } else { // без использования AJAX
      return $this->redirect(['basket/index']);
    }
  }

  //очистить от всех записей
  public function actionClear() {
    $basket = new Basket();
    $basket->clearBasket();
    /* Тут возможны две ситуации: пришел просто GET-запрос или GET-запрос с использованием XmlHttpRequest */
    if (Yii::$app->request->isAjax) { // с использованием AJAX
      // layout-шаблон нам не нужен, только view-шаблон
      $this->layout = false;
      $content = $basket->getBasket();
      return $this->render('modal', ['basket' => $content]);
    } else { // без использования AJAX
      return $this->redirect(['basket/index']);
    }
  }

  //обновление корзины
  public function actionUpdate() {
    $basket = new Basket();
    /* Данные должны приходить методом POST; если это не так — просто показываем корзину */

    // проверка вывода данных о товаре
     
    if (!Yii::$app->request->isPost) {
      return $this->redirect(['basket/index']);
    }

    $data = Yii::$app->request->post();
    if (!isset($data['count'])) {
      return $this->redirect(['basket/index']);
    }
    if (!is_array($data['count'])) {
      return $this->redirect(['basket/index']);
    }

    $basket->updateBasket($data);
    /* Тут возможны две ситуации: пришли просто данные POST или пришли данные POST с использованием XmlHttpRequest */
    if (Yii::$app->request->isAjax) { // с использованием AJAX
      // layout-шаблон нам не нужен, только view-шаблон
      $this->layout = false;
      $content = $basket->getBasket();
      return $this->render('modal', ['basket' => $content]);
    } else { // без использования AJAX
      return $this->redirect(['basket/index']);
    }
  }

}
