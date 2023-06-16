<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="background" style="min-height: 80em;"> <!-- orange back -->
    <div class="container cont" style="text-align:center; width: 40%; margin-left: auto; margin-right: auto;"> <!-- center -->
        <div class="content-down " style="width: 60em; border-radius: 25px"> <!-- white back -->
            <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->dropDownList(User::find()->select(['email', 'id'])->indexBy('id')->column())->label("Пользователь")  ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'order_status')->textInput()->dropDownList(
                            [ 
                                '0' => 'Заказ принят',
                                '1' => 'Заказ выполняется',
                                '2' => 'Заказ ожидает покупателя/курьера',
                                '3' => 'Заказ в пути',
                                '4' => 'Заказ доставлен',
                            ]); ?>


    <?= $form->field($model, 'pickup')->dropDownList(
                            [ 
                                '0' => 'Нет',
                                '1' => 'Да',
                            ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</section>
