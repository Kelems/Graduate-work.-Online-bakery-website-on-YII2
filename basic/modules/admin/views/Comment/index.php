<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>
<!-- grow --> 

  <div class="container">
        <?= Html::a('Создать комментарий', ['create'], ['class' => 'btn btn-success']) ?>
  </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
   //         ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'user_id',
            'message',
            'date_message',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Comment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
