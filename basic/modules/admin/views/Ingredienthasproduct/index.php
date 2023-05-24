<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\IngredienthasproductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиенты в продукции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-has-product-index">

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

            'ingredient_id',
            'product_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, IngredientHasProduct $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ingredient_id' => $model->ingredient_id, 'product_id' => $model->product_id]);
                 }
            ],
        ],
    ]); ?>
  </div>
</div>
