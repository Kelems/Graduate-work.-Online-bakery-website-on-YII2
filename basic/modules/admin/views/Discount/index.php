<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\DiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скидки';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>
<!-- grow --> 

  <div class="container">
        <?= Html::a('Создать скидку', ['create'], ['class' => 'btn btn-success']) ?>
  </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="container">
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
      //      ['class' => 'yii\grid\SerialColumn'],

            'id',
            'percent',
            'required_value',
            [
                'class' => ActionColumn::className(),
             /*
                'urlCreator' => function ($action, Discount $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            */
            ],
        ],
    ]); ?>
</div>


</div>