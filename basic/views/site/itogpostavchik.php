<?php
use yii\helpers\Html;
use yii\bootstrap\LinkPager;
use yii\widgets\ActiveForm;

use app\modules\admin\models\Ingredients;
use app\modules\admin\models\Provider;
use app\modules\admin\models\Purchases;

/** @var  app\modules\admin\models\Purchases $model */
/** @var yii\bootstrap4\ActiveForm $for */
/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

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
    text-decoration: none;
    text-transform: uppercase;
    font-weight: bold;
  }

  .bt {
  text-align: center;
  margin-right: 70px;
  }

</style>

<div class="grow">
  <div class="container">
    <div class="btno">
        <a href="/basic/web/index.php?r=site%2Fpodbor" class="btno" target="_blank"><b>Вернуться</b>  </a>
    </div>
    <h2 style="text-align: center;">Закупка по дням у поставщиков</h2>
  </div>
</div>
<!-- grow -->
<div class="product">
  <div class="container">
<!--       ^-не трогать  -->

<?php $form = ActiveForm::begin(); ?>
  <?=
    $form->field($model, 'order_date')->label('Дата:')->textInput()
  ?>
	<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-warning']) ?>
	</div>
<?php ActiveForm::end(); ?>

<ul>
  <table class="table table-hover table-bordered">
    <thead class="">
    <tr>
      <th><b>Дата</b></th>
      <th><b>Поставщик</b></th>
      <th><b>Итоговая цена закупки за день</b></th>
    </tr>
    </thead>
      <?php foreach ($itogpostavchikz as $result): ?>
      <tr>
        <td><?= Html::encode("{$result['order_date']}") ?></td>
        <td><?= Html::encode("{$result['name_provider']}") ?></td>
        <td><?= Html::encode("{$result['cost']}") ?></td> <!-- id_category -->
      </tr>
    <?php endforeach; ?>
  </table>
</ul>


</div>
<div class="clearfix"> </div>
</div>
