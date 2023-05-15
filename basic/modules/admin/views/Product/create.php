<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = 'Внести продукт';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>
<div class="container">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
