<?php
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Provider;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\Ingredientshasprovider;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Purchases */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="purchases-form">
  <?php $date = date("Y-m-d"); ?>
  <?php if (empty($model->ingredients_has_provider_ingredients_id)): ?>
    <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'order_date')->textInput(['value'=>$date,'placeholder'=>'Введите дату "Год-Месяц-День"']) ?>
      <?= $form->field($model, 'ingredients_has_provider_ingredients_id')->textInput()->dropDownList(Ingredients::find()->select(['name', 'id'])->indexBy('id')->column()) ?>
      <?= $form->field($model, 'amount')->textInput() ?>
      <div class="form-group">
          <?= Html::submitButton('Выбрать ингредиент', ['class' => 'btn btn-success']) ?>
      </div>
    <?php ActiveForm::end(); ?>
  <?php else:?>
    <?=
      $quer = IngredientsHasProvider::find()
                  ->select('provider_id')
                  ->where(['ingredients_id' => $model->ingredients_has_provider_ingredients_id])
                  ->indexBy('provider_id')
                  ->column()
    ?>
    <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'order_date')->textInput(['value'=>$date,'placeholder'=>'Введите дату "Год-Месяц-День:']) ?>
      <?= $form->field($model, 'ingredients_has_provider_ingredients_id', ['template'=>"{label}\n{input}"])->hiddenInput()->label(false)?>
      <?= $form->field($model, 'ingredients_has_provider_provider_id')->textInput()
      ->dropDownList(Provider::find()
                    ->select(['name_provider', 'id'])
                    ->where(['id' => $quer])
                    ->indexBy('id')
                    ->column()
                    )
      ?>
      <?= $form->field($model, 'amount')->textInput() ?>
      <div class="form-group">
        <?= Html::a('Перевыбрать ингредиент',['create'], ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Сохранить поставщика', ['class' => 'btn btn-success']) ?>
      </div>
    <?php ActiveForm::end(); ?>
  <?php endif; ?>
</div>
