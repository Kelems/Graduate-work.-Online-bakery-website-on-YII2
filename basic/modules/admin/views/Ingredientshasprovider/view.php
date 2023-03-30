<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ingredientshasprovider */

$this->title = $model->ingredients_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredientshasproviders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ingredientshasprovider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ingredients_id' => $model->ingredients_id, 'provider_id' => $model->provider_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ingredients_id' => $model->ingredients_id, 'provider_id' => $model->provider_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ingredients_id',
            'provider_id',
            'cost',
            'comment',
        ],
    ]) ?>

</div>
