<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\LinkPager;
use app\modules\admin\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput()->dropDownList(Category::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expiration_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protein')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carbohydrate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calorific')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>