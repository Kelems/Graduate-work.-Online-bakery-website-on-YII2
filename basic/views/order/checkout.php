<?php
/*
 * Страница оформления заказа, файл views/order/checkout.php
 */



use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use ruskid\stripe\StripeCheckout;
?>

<section class="background" style="padding-bottom: 1em;">

  <div class="container" style="padding-top:2%"> <!-- center white -->
    <div class="content-product row" style="border: 15px solid white; "> <!-- white part -->
      <div class="col-sm-2"></div>
      <div class="col-sm-8">

        <h1 style="text-align: center">Оформление заказа</h1>

        </div>
      </div>
    </div>
  </div>
  <!-- основная информация -->
  <div class="container" > <!-- center white -->
    <div class="content-product row" style="border: 15px solid white; "> <!-- white part -->
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <div id="checkout">
        <h2 style="text-align: center">Основная информация</h2>

          <?php $form = ActiveForm::begin(['id' => 'checkout-form', 'class' => 'form-horizontal']);?>
            <?= $form->field($order, 'name')->textInput(); ?>
            <?= $form->field($order, 'phone')->textInput(); ?>
            <?= $form->field($order, 'comment')->textarea(['rows' => 1]); ?>
            <?= $form->field($order, 'pickup')->radioList(
              [ 
                '0' => 'Самовывоз',
                '1' => 'Доставка'
              ], 
              [
                'value' => 0,
                'id' => 'ts-radio',
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                  return '<label class="btn btn-warning' . ($checked ? ' active' : '') . '">' .
                  Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                },
              ]);
            ?>

        </div>
      </div>
    </div>
  </div>
  <!-- блок доставки -->
  <div class="container" style="padding-top:0.5%"> <!-- center white -->
    <div class="content-product row" style="border: 15px solid white; "> <!-- white part -->
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <h2 style="text-align: center">Информация для доставки</h2>
        <div id="checkout">
            <?= $form->field($order, 'city')->dropDownList(
              [ 
                'Ростов-на-Дону' => 'Ростов-на-Дону (бесплатная доставка)',
                'Батайск' => 'Батайск (Доставка: 250 рублей)',
                'Аксай' => 'Аксай (Доставка: 500 рублей)',
                'Новочеркасск' => 'Новочеркасск (Доставка: 1000 рублей)',
                'Новошахтинск' => 'Новошахтинск (Доставка: 1150 рублей)',
                'Таганрог' => 'Таганрог (Доставка: 1250 рублей)',
                'Шахты' => 'Шахты (Доставка: 1500 рублей)',
              ])->label("Город доставки (оплата доставки осуществляется по получению заказа)"); ?>
            <?= $form->field($order, 'address')->textarea(['rows' => 1]); ?>
            <?= $form->field($order, 'time_delivery')->dropDownList(
              [ 
                'С 9:00 до 10:30' => 'С 9:00 до 10:30',
                'С 10:30 до 11:30' => 'С 10:30 до 12:00',
                'С 12:00 до 13:15' => 'С 12:00 до 13:15',
                'С 13:30 до 15:00' => 'С 13:30 до 15:00',
                'С 15:00 до 16:30' => 'С 15:00 до 16:30',
                'С 16:30 до 19:00' => 'С 16:30 до 19:00',
                'С 19:00 до 20:30' => 'С 19:00 до 20:30',
                'С 20:30 до 22:00' => 'С 20:30 до 22:00',
              ]); ?>
        </div>
      </div>
    </div>
  </div>
  <!-- кнопка -->
  <div class="container" style="padding-top:0.5%"> <!-- center white -->
    <div class="content-product row" style="border: 15px solid white; "> <!-- white part -->
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <h4 style="text-align: center">Напоминаем, что заказ, <b>время доставки которого будет менее 2 часов</b> - будет определяться на <b>следующий день!</b> </h4>
        <div id="checkout">
            <?= Html::submitButton('Завершить заказ', ['class' => 'btn btn-warning col-12', 'style' => "text-align: center"]); ?>
          <?php ActiveForm::end(); ?>

        </div>
      </div>
    </div>
  </div>

</section>