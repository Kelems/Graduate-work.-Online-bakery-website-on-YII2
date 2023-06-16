<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\searchs\DiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скидки';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="background"> <!-- orange back -->
    <div class="container cont" style="text-align:center; width: 50%; margin-left: auto; margin-right: auto;"> <!-- center -->
    <div class="content-down " style="border-radius: 25px"> <!-- white back -->
      <h1 class=" border-bottom pb-3"><?= Html::encode($this->title) ?></h1>

            <?= Html::a('Создать скидку', ['create'], ['class' => 'btn btn-success']) ?>

                <?= GridView::widget([ 
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                        'columns' => [
                        'id',
                        'percent',
                        'required_value',
                        [
                            'class' => ActionColumn::className(),
                        ],
                    ],
    ]); ?>
        </div>
    </div>
</section>
