<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Provider */
?>
<div class="provider-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
