<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\Provider;
use app\modules\admin\models\Ingredientshasprovider;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PurchasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .lux{
    border-collapse: collapse;
    border-spacing: 0;
    text-align: center;
    margin: auto;
  }
  .lux td, .lux th{
    padding: 5px;
    border: 2px solid black;
  }
  .btno{
    background: black;
    color: orange;
    padding: 4px;
    text-decoration: none;
    text-transform: uppercase;
    float: left;
  }

 a:hover{
  	color:#fff;
  	text-decoration:none;

  }

  .btns{
    background: orange;
    color: black;
    padding: 1rem;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
  }

  .bt {
  text-align: center;
  margin-right: 70px;
  }

</style>
<div class="grow">
  <div class="container">
    <div class="btno">
      <a href="/basic/web/index.php?r=site%2Fpodbor" class="btno" target="_blank">  <b>Вернуться</b>   </a>
    </div>
    <h2 style="text-align: center;">Заказы</h2>
  </div>
</div>
<div class="product">
  <div class="container">
    <p>
        <?= Html::a('Внести заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
        'id',
//      'ingredients_has_provider_ingredients_id',
        [
          'attribute' => 'ingredients_has_provider_ingredients_id',
          'filter' => ingredients::find()->select(['name','id'])->indexBy('id')->orderBy('id')->column(),
          'value' => function($data){
            return $data->ingr->ingredients->name;
          },
        ],
//      'ingredients_has_provider_provider_id',
        [
          'attribute' => 'ingredients_has_provider_provider_id',
          'filter' => provider::find()->select(['name_provider','id'])->indexBy('id')->orderBy('id')->column(),
          'value' => function($data){
            return $data->prov->provider->name_provider;
          },
        ],
        'order_date',
        'amount',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
      ],
    ]); ?>
  </div>
  <div class="clearfix"> </div>
</div>
