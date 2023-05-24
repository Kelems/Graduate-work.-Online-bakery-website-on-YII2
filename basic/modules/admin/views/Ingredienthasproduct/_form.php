<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\IngredientHasProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-has-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredient_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
