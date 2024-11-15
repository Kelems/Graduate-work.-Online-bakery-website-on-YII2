<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Профиль пользователя: ' . $model->email;
\yii\web\YiiAsset::register($this);
?>

<section class="background"> <!-- orange background -->
    <div class="container"> <!-- centering block and 50% for all site -->
        <div class="cont-index">  <!-- centering the block -->
            <div class="content-profile"> <!-- white part -->
                <h1 style="text-align: center;"> <?= Html::encode($this->title) ?></h1>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'email',
                        'name',
                        'phone',
                        'address',
                    ],
                ]) ?>

                <p style="text-align: center;">
                    <?= Html::a('Обновить данные', ['profile-update', 'email' => $model->email], ['class' => 'btn btn-success']) ?>
                </p>

                <h3>Общая стоимость всех заказов: <?= $totalCost ?> р.</h3>

                <h2>Ваши заказы</h2>
                <?php if (!empty($orders)): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Дата заказа</th>
                                <th>Стоимость заказа</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $order->date_order ?></td>
                                    <td><?= $order->cost ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= LinkPager::widget(['pagination' => $pages]); ?>
                <?php else: ?>
                    <p>У вас пока нет заказов.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
