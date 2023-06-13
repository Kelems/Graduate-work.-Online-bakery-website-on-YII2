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
        <h3>Ваша почта:</h3>
        <h4> <?php echo $model->email; ?> </h4>

        <h3> <?php echo $model->secret_question; ?>: </h3>
        <h4><?= $form->field($model, 'answer')->label("") ?></h4>

          <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
          </div>
        <?php ActiveForm::end(); ?>
      
      </div>
    </div>
  </div>
</section>
