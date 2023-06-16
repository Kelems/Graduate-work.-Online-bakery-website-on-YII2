<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="background" style="min-height: 80em;"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'role_id',
            [
              'attribute' => 'role_id',
              'filter' => Role::find()->select(['name', 'id'])->indexBy('id')->column(),
              'value' => function($data){
                return $data->role->name;
              },
            ],
            'phone',
            'email:email',
            //'password',
            'name',
            //'address:ntext',
            //'created_at',
            //'total_of_all_order',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}',],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',],
        ],
    ]); ?>
  </div>
</div>
