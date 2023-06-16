<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Product;
use app\modules\admin\models\Ingredient;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\IngredientHasProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="background"> <!-- orange back -->
    <div class="container cont" style="text-align:center; width: 40%; margin-left: auto; margin-right: auto;"> <!-- center -->
        <div class="content-down " style="border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredient_id')->textInput()->dropDownList(Ingredient::find()->select(['name', 'id'])->indexBy('id')->column())->label("Ингредиент") ?>

    <?= $form->field($model, 'product_id')->textInput()->dropDownList(Product::find()->select(['name', 'id'])->indexBy('id')->column())->label("Продукт") ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</section>