<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\Provider;
use app\modules\admin\models\Ingredientshasprovider;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Purchases */
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//$model->cost =
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
    font-weight: bold;
  }

  .bt {
  text-align: center;
  margin-right: 70px;
  }

</style>

<div class="purchases-view">
  <div class="grow">
    <div class="container">
    <div class="btno">
        <p>
          <?= Html::a('Вернуться', ['index'], ['class' => 'btno']) ?>
      </p>
        </div>
      <div class="bt">
      <h2>Заказ</h2>
      </div>
</div>
</div>

<div class="product">
  <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?=
      DetailView::widget([
        'model' => $model,
        'attributes' => [
          'id',
          'order_date',
  //      'ingredients_has_provider_ingredients_id',
          [
            'attribute' => 'ingredients_has_provider_ingredients_id',
            'filter' => ingredients::find()->select(['name','id'])->indexBy('id')->orderBy('id')->column(),
            'value' => function($model){
              return $model->ingr->ingredients->name;
            },
          ],
  //      'ingredients_has_provider_provider_id',
          [
            'attribute' => 'ingredients_has_provider_provider_id',
            'filter' => provider::find()->select(['name_provider','id'])->indexBy('id')->orderBy('id')->column(),
            'value' => function($model){
              return $model->prov->provider->name_provider;
            },
          ],
          [
            'attribute' => 'ingredients_has_provider_provider_id',
            'filter' => Ingredientshasprovider::find()->select(['provider_id','cost'])->indexBy('provider_id')->orderBy('provider_id')->column(),
            'value' => function($model){
              return $model->prov->cost;
            },
            'label' => 'Цена'
          ],
          'amount',
          [
            'attribute' => 'ingredients_has_provider_provider_id',
            'filter' => Ingredientshasprovider::find()->select(['provider_id','comment'])->indexBy('provider_id')->orderBy('provider_id')->column(),
            'value' => function($model){
              return $model->prov->comment;
            },
            'label' => 'В чем измеряется'
          ],
        ],
    ]) ?>
  <form action="/basic/word.php" method="post"> <!-- hidden -->
    <input type="hidden" value="<?php echo $model->id ?>" name="id"  placeholder="Введите номер чека">
    <input type="hidden" value="<?php echo $model->order_date ?>" name="order_date"  placeholder="Введите дату">
    <input type="hidden" value="<?php echo $model->prov->provider->name_provider ?>" name="provider" placeholder="Введите поставщика">
    <input type="hidden" value="<?php echo $model->ingr->ingredients->name ?>" name="ingredient" placeholder="Введите ингредиент" required>
    <input type="hidden" value="<?php echo $model->prov->comment ?>" name="comment" placeholder="Введите кг или литр">
    <input type="hidden" value="<?php echo $model->prov->cost ?>" name="cost" placeholder="Введите цену">
    <input type="hidden" value="<?php echo $model->amount ?>" name="num" placeholder="Введите сколько">
    <button type="submit" class="btn btn-warning">Создать чек закупки</button>
  </form>
</div>
</div>
</div>
