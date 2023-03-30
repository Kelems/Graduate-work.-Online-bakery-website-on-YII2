<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Purchases */
?>
<style>
  .lux{
    border-collapse: collapse;
    border-spacing: 0;
    text-align: center;
    margin: auto;
  }
  .lux td, .lux th{
    padding: 5px;
    border: 2px solid black;
  }
  .btno{
    background: black;
    color: orange;
    padding: 4px;
    text-decoration: none;
    text-transform: uppercase;
    float: left;
    font-weight: bold;
  }

 a:hover{
  	color:#fff;
  	text-decoration:none;

  }

  .btns{
    background: orange;
    color: black;
    padding: 1rem;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
  }

  .bt {
  text-align: center;
  margin-right: 70px;
  }

</style>
<div class="grow">
  <div class="container">
    <div class="btno">
    <p>
        <?= Html::a('Вернуться', ['index'], ['class' => 'btno']) ?>
    </p></div>
    <h2 style="text-align: center;">Заказ</h2>
  </div>
</div>
<!-- grow -->

<div class="product">
  <div class="container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
