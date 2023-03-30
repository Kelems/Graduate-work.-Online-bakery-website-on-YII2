<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ingredientshasprovider */

$this->title = 'Update Ingredientshasprovider: ' . $model->ingredients_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredientshasproviders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingredients_id, 'url' => ['view', 'ingredients_id' => $model->ingredients_id, 'provider_id' => $model->provider_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredientshasprovider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
