<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>

      <div class="container">
        <?= Html::a('Внести пользователя', ['create'], ['class' => 'btn btn-success']) ?>
      </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'role_id',
            'email:email',
            'password',
            'name',
            //'phone',
            //'address:ntext',
            //'created_at',
            //'total_of_all_order',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}',],
        ],
    ]); ?>
  </div>
</div>
