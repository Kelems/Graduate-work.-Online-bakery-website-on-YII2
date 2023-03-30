<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ingredientshasprovider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredientshasprovider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredients_id')->textInput() ?>

    <?= $form->field($model, 'provider_id')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
