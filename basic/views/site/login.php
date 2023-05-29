<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

<section class="background"> <!-- orange back -->
  <div class="container"> <!-- center -->
    <div class="cont"> <!-- -->
      <div class="content-down"> <!-- white back -->
        <div class="container">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <h1 style="text-align:center;"> Авторизация</h1>
            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
              <div class="offset-lg-1 col-lg-11" style="text-align:center;">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
              </div>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
          <div class="col-md-3"></div>
      </div>
    </div>
  </div>
</section>
