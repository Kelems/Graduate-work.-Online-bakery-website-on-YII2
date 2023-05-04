<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\IngredientHasProduct */

$this->title = 'Update Ingredient Has Product: ' . $model->ingredient_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Has Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingredient_id, 'url' => ['view', 'ingredient_id' => $model->ingredient_id, 'product_id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredient-has-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
