<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="background"> <!-- orange back -->
    <div class="container cont" style="text-align:center; width: 25%; margin-left: auto; margin-right: auto;"> <!-- center -->
        <div class="content-down " style="border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'product_id')->textInput() ?>
            <?= $form->field($model, 'user_id')->textInput() ?>
            <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'date_message')->textInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</section>
