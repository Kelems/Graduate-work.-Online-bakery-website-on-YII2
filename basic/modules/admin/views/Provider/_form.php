<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Provider */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="provider-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name_provider')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
