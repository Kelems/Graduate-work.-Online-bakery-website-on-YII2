<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\grid\ActionColumn;
  use yii\grid\GridView;

  /* @var $this yii\web\View */
  /* @var $dataProvider yii\data\ActiveDataProvider */
  $this->title = 'Категории';
//  $this->params['breadcrumbs'][] = $this->title;
?>
  <div class="container" style="text-align:center">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>
<!-- grow --> 

  <div class="container">
    <?= Html::a('Внести категорию', ['create'], ['class' => 'btn btn-success']) ?>
  </div>

  <div class="container">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
    //            //['class' => 'yii\grid\SerialColumn'],
      'id',
      'name',
      'description',
      ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
      ['class' => 'yii\grid\ActionColumn', 'template' => '{update}',],
        /*
        'image',
        [
          'class' => ActionColumn::className(),
          'urlCreator' => function ($action, Category $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
          }
        ],
        */
      ],
    ]); ?>
  </div>
</div>
