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
            <div class="content-profile"> <!-- white part -->

                <h1><?= Html::encode($this->title) ?></h1>

                    <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
                        <?= $form->field($model, 'secret_question')->dropDownList(
                            [ 
                                'Ваше любимое блюдо' => 'Ваше любимое блюдо',
                                'Как зовут ваше домашнее животное' => 'Как зовут ваше домашнее животное',
                                'Как зовут вашего первого домашнего друга' => 'Как зовут вашего первого домашнего друга',
                                'Название вашего любимого мультфильма' => 'Название вашего любимого мультфильма',
                                'Отчество вашей бабушки' => 'Отчество вашей бабушки',
                                'Название вашей любимой книги' => 'Название вашей любимой книги',
                                'Профессия вашего дедушки' => 'Профессия вашего дедушки
                                ',
                            ]); ?>
                        <?= $form->field($model, 'answer')->textarea(['rows' => 2]) ?>
                        <div class="form-group" style="text-align: center;">
                            <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
