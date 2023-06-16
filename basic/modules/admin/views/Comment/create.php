<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Comment */

$this->title = 'Внести отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
