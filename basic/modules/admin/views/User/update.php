<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = 'Обновить пользователя: ' . $model->email;

?>
<div class="user-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
