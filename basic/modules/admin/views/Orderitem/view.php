<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderItem */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="background"> <!-- orange back -->
    <div class="container cont" style="text-align:center;"> <!-- center -->
        <div class="content-down container" style="border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Обновить', ['update', 'order_id' => $model->order_id, 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'order_id' => $model->order_id, 'product_id' => $model->product_id], [
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
            'order_id',
            'product_id',
            'count',
            'price',
            'cost',
        ],
    ]) ?>

</div>
