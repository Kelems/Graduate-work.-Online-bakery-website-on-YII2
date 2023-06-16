<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Product;
use app\modules\admin\models\Ingredient;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\IngredienthasproductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиенты в продукции';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="background" style="min-height: 80em;"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

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

//            'ingredient_id',            
            [
              'attribute' => 'ingredient_id',
              'filter' => Ingredient::find()->select(['name', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->ingredient->name;
              },
            ],
//            'product_id',            
            [
              'attribute' => 'product_id',
              'filter' => Product::find()->select(['name', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->product->name;
              },
            ],
          ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',],

        ],
    ]); ?>
  </div>
</div></div></section>
