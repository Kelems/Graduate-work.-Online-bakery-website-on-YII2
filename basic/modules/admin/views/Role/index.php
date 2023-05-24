<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Роль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>

    <div class="container">
      <?= Html::a('Внести роль', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'description',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}',],
        ],
    ]); ?>
  </div>
</div>
