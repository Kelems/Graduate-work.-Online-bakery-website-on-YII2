<?php
namespace app\controllers;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\Basket;
use app\models\Discount;

class BasketController extends Controller {
  public function actionIndex() {         //страница корзины
    $basket = (new Basket())->getBasket();
    if(!empty($basket)){                  //проверка пустая ли корзина
      if (!Yii::$app->user->isGuest) {    // раз в корзине что-то есть, то проверяем сколько у пользователя всего было потрачено
        $total = Yii::$app->user->identity->total_of_all_order;
        $query = (new yii\db\Query())->select('max(percent) AS perc')->from('discount')->where(['<=','required_value', $total])->all();   
        $temp = $query[0];         //сохраняем наибольший процент скидки пользователя в переменную
        $disc = $temp['perc'];
        if ($disc > 0) {
          $value['amount'] = $basket['amount'] - ($basket['amount'] * $disc);
          $basket['amount'] = $value['amount'];
        }
      }
    }
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
    if (!isset($data['id'])) { return $this->redirect(['basket/index']); }
    if (!isset($data['count'])) { $data['count'] = 1; }
    $basket->addToBasket($data['id'], $data['count']);     // добавляем товар в корзину и перенаправляем покупателя на страницу корзины
      Yii::$app->session->setFlash('info', "Товар внесен в корзину");
      return $this->redirect(Yii::$app->request->referrer);
    }

  //очищаем корзину
  public function actionRemove($id) {
    $basket = new Basket();
    $basket->removeFromBasket($id);
    return $this->redirect(['basket/index']);
  }

  //очистить от всех записей
  public function actionClear() {
    $basket = new Basket();
    $basket->clearBasket();
    return $this->redirect(['basket/index']);
  }

  //обновление корзины
  public function actionUpdate() {
    $basket = new Basket();
    if (!Yii::$app->request->isPost) { return $this->redirect(['basket/index']); } // проверка вывода данных о товаре
    $data = Yii::$app->request->post();
    if (!isset($data['count'])) { return $this->redirect(['basket/index']); }
    if (!is_array($data['count'])) { return $this->redirect(['basket/index']); }
    $basket->updateBasket($data);
    return $this->redirect(['basket/index']);
  }
}