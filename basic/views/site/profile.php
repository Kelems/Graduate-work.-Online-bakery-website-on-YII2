<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Профиль пользователя: '.$model->email;
\yii\web\YiiAsset::register($this);
?>
<div>

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

</div>
