<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\IngredientHasProduct */

$this->title = 'Создать связь';
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Has Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-has-product-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
