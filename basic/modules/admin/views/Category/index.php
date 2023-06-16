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
<section class="background" section class="background" style="min-height: 80em;"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

      <?= Html::a('Внести категорию', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',],
          ],
        ]); ?>
      </div>

    </div>
  </div>
</section>
