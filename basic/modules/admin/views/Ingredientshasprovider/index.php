<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\Provider;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\IngredientshasproviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        <h2 style="text-align: center;">Перечень предложений</h2>
      </div>
    </div>
    <!-- grow -->
    <div class="product">
      <div class="container">
    <!--       ^-не трогать  -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            'ingredients_id',
          [
            'attribute' => 'ingredients_id',
            'filter' => Ingredients::find()->select(['name', 'id'])->indexBy('id')->column(),
            'value' => function($data){
              return $data->ingredients->name;
            },
          ],
//            'provider_id',
          [
            'attribute' => 'provider_id',
            'filter' => Provider::find()->select(['name_provider', 'id'])->indexBy('id')->column(),
            'value' => function($data){
            return $data->provider->name_provider;
            },
          ],
          'cost',
          'comment',
        ],
    ]);
  ?>



    </div>
    <div class="clearfix"> </div>
    </div>
