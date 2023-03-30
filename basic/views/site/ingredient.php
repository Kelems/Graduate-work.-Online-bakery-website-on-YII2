<?php
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;
use yii\widgets\ActiveForm;

use app\modules\admin\models\Ingredients;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
  }

  .bt {
  text-align: center;
  margin-right: 70px;
  }

</style>
<div class="provider-index">

  <div class="grow">
    <div class="container">
      <div class="btno">
          <a href="/basic/web/index.php?r=site%2Fpodbor" class="btno" target="_blank"><b>Вернуться</b>  </a>
      </div>
    <h2 style="text-align: center;">Перечень остатков ресурсов</h2>
  </div>
</div>
<!-- grow -->
<div class="product">
  <div class="container">
<!--       ^-не трогать  -->

<?php $form = ActiveForm::begin(); ?>
  <?=
    $form->field($model, 'amount')->label('Количество')->textInput()
  ?>
	<div class="form-group">
		<?= Html::submitButton('Отправить', ['class' => 'btn btn-warning']) ?>
	</div>
<?php ActiveForm::end(); ?>

<ul>
  <table class="table table-hover table-bordered">
    <thead class="">
    <tr>
      <th scope="col"><b>Название</b></th>
      <th><b>Срок годности</b></th>
      <th><b>Сколько на складе</b></th>
      <th><b>Единица измерения</b></th>
    </tr>
 </thead>
    <?php foreach ($ingredientz as $result): ?>
      <tr>
        <td><?= Html::encode("{$result->name}") ?></td>
        <td><?= Html::encode("{$result->shelf_life}") ?></td>
        <td><?= Html::encode("{$result->amount}") ?></td> <!-- id_category -->
        <td><?= Html::encode("{$result->unit_of_measurement}") ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</ul>


</div>
<div class="clearfix"> </div>
</div>
