<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Discount */

$this->title = 'Обновить скидку: ' . $model->required_value;
?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

