<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Product;
use app\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
?>
<section class="background"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

      <div class="container">
        <?= Html::a('Создать комментарий', ['create'], ['class' => 'btn btn-success']) ?>
      </div>

      <div class="container">
        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
            //'product_id',

            [
              'attribute' => 'product_id',
              'filter' => Product::find()->select(['name', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->product->name;
              },
            ],

            //'user_id',
            [
              'attribute' => 'user_id',
              'filter' => User::find()->select(['email', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->user->email;
              },
            ],
            'message',
            'date_message',
          ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
          ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',],
          ],
        ]); ?>
      </div>
    </div>
  </div>
</section>
