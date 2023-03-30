<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ingredientshasprovider */

$this->title = 'Create Ingredientshasprovider';
$this->params['breadcrumbs'][] = ['label' => 'Ingredientshasproviders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredientshasprovider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
