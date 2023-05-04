<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */


$this->title = 'Изменение категории: ' . $model->name;
?>
<div class="container" style="text-align:center">
  <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="container">
  <div class="category-update">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
  </div>
</div
