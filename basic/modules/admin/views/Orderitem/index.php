<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\OrderitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Содержимое заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-index">

  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>

    <div class="container">
      <?= Html::a('Внести связь', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
              //['class' => 'yii\grid\SerialColumn'],

              'order_id',
              'product_id',
              'count',
              'price',
              'cost',
              [
                  'class' => ActionColumn::className(),
                  'urlCreator' => function ($action, OrderItem $model, $key, $index, $column) {
                      return Url::toRoute([$action, 'order_id' => $model->order_id, 'product_id' => $model->product_id]);
                   }
              ],
          ],
      ]); ?>
    </div>
</div>
