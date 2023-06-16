<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\modules\admin\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="background" style="min-height: 80em;">  <!-- orange back -->
    <div class="container cont" style="text-align:center;"> <!-- center -->
        <div class="content-down container" style="border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id, 'category_id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'category_id' => $model->category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'category_id',
            [
              'attribute' => 'category_id',
              'filter' => category::find()->select(['name','id'])->indexBy('id')->orderBy('id')->column(),
              'value' => function($data){
                return $data->category->name;
              },
            ],
            'name',
            'content',
            'price',
            'old_price',
            'image',
            'weight',
            'expiration_date',
            'protein',
            'fat',
            'carbohydrate',
            'calorific',
        ],
    ]) ?>
  </div>
</div>
