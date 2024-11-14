<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

<section class="background"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down container"> <!-- white back -->
      <div class="col-md-3"></div>
      <div class="col-md-6" >
        <h1> Авторизация</h1>
        <?php $form = ActiveForm::begin(); ?>
          <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Почта') ?>
          <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
          <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
          </div>
        <?php ActiveForm::end(); ?>
      <div class="border-bottom pb-3 mb-3 text-center">
        <a  href="http://yii-2-bakery/basic/web/index.php/site/recovery">Восстановить доступ</a>
      </div>
        <a  href="http://yii-2-bakery/basic/web/index.php/site/registration">Создать аккаунт</a>
      </div>
    </div>
  </div>
</section>
