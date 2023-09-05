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

            <?= $form->field($model, 'city')->dropDownList(
              [ 
                'Ростов-на-Дону' => 'Ростов-на-Дону (бесплатная доставка)',
                'Батайск' => 'Батайск (Доставка: 250 рублей)',
                'Аксай' => 'Аксай (Доставка: 500 рублей)',
                'Новочеркасск' => 'Новочеркасск (Доставка: 1000 рублей)',
                'Новошахтинск' => 'Новошахтинск (Доставка: 1150 рублей)',
                'Таганрог' => 'Таганрог (Доставка: 1250 рублей)',
                'Шахты' => 'Шахты (Доставка: 1500 рублей)',
              ])->label("Город (оплата доставки осуществляется по получению заказа)"); ?>
    
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_cost')->textInput(['maxlength' => true])->label('Цена доставки') ?>

            <?= $form->field($model, 'time_delivery')->dropDownList(
              [ 
                'С 9:00 до 10:30' => 'С 9:00 до 10:30',
                'С 10:30 до 11:30' => 'С 10:30 до 12:00',
                'С 12:00 до 13:15' => 'С 12:00 до 13:15',
                'С 13:30 до 15:00' => 'С 13:30 до 15:00',
                'С 15:00 до 16:30' => 'С 15:00 до 16:30',
                'С 16:30 до 19:00' => 'С 16:30 до 19:00',
                'С 19:00 до 20:30' => 'С 19:00 до 20:30',
                'С 20:30 до 22:00' => 'С 20:30 до 22:00',
              ])->label("Часы доставки"); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</section>
