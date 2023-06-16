<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="background"> <!-- orange back -->
    <div class="container cont" style="text-align:center;"> <!-- center -->
        <div class="content-down container" style="border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3">Заказ №<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'user_id' => $model->user_id], [
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
            'user_id',
            'name',
            'email:email',
            'cost',
            'phone',
            'address',
            'comment',
            'date_order:datetime',

            'order_status',
            /*
            ['attribute' => 'order_status', 

                'format' => 
                [ ''
                    '0' => 'Заказ принят',
                    '1' => 'Заказ выполняется',
                    '2' => 'Заказ ожидает покупателя/курьера',
                    '3' => 'Заказ в пути',
                    '4' => 'Заказ доставлен',
                ],
                'filterInputOptions' => ['prompt'=> 'all educations']
            ],
            */
            'date_status:datetime',
            'pickup',
            'city',
            'city_cost',
            'time_delivery',
        ],
    ]) ?>

</div>
