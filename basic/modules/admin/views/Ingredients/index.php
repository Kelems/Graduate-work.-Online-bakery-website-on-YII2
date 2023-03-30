<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\IngredientsSearch */
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

<head>
  <title>Ингредиенты</title>
</head>
<div class="grow">
  <div class="container">
    <div class="btno">
        <a href="/basic/web/index.php?r=site%2Fpodbor" class="btno" target="_blank"><b>Вернуться</b>  </a>
    </div>

    <div class="bt">
    <h2>Ингредиенты</h2>
    </div>
  </div>
</div>
<!-- grow -->

<div class="product">

  <div class="container">


    <p>
        <?= Html::a('Внести ингредиент', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="ingredients-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'shelf_life',
            'amount',
            'unit_of_measurement',
        ],
    ]); ?>


</div>


</div>
			<div class="clearfix"> </div>
		</div>
