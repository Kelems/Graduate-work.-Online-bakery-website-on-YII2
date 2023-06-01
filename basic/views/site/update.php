<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = 'Обнновление данных аккаунта: ' . $model->email;
?>

<section class="background"> <!-- orange background -->

    <div class="container"> <!-- centering block and 50% for all site -->
        <div class="cont-index">  <!-- centering the block -->
            <div class="content"> <!-- white part -->

                <h1><?= Html::encode($this->title) ?></h1>

                    <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
                        <div class="form-group" style="text-align: center;">
                            <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
