<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\modules\admin\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="background" style="min-height: 80em;"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

    <div class="container">
    <?= Html::a('Внести продукт', ['create'], ['class' => 'btn btn-success']) ?>
  </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        'id',
//        'category_id',
        [
          'attribute' => 'category_id',
          'filter' => category::find()->select(['name','id'])->indexBy('id')->orderBy('id')->column(),
          'value' => function($data){
            return $data->category->name;
          },
        ],
        'name',
        'price',
        'old_price',
//        'content',
        'image',
//            'expiration_date',
//            'weight',
//            'protein',
//            'fat',
//            'carbohydrate',
//            'calorific',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ['class' => 'yii\grid\ActionColumn', 'template' => '{update}',],
      ],
    ]); ?>

  </div>
</div>
