<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\OrderitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Содержимое заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="background" style="min-height: 80em;"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
              //['class' => 'yii\grid\SerialColumn'],

              'order_id',
//              'product_id',
              [
              'attribute' => 'product_id',
              'filter' => Product::find()->select(['name', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->product->name;
              },
              'label' => "Продукт"
            ],
              'count',
              'price',
              'cost',
          ],
      ]); ?>
    </div>
</div>
</div>
</section>