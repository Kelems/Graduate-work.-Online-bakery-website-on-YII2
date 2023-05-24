<?php
/*
 * Страница корзины покупателя, файл views/basket/index.php
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="text-center">Корзина</h1>
        <div id="basket-content">
        <?php if (!empty($basket)): ?>
          <p  class="text-center">
            <a href="<?= Url::to(['basket/clear']); ?>" class="text-danger">
              Очистить корзину
            </a>
          </p>
          <div class="table-responsive">
            <form action="<?= Url::to(['basket/update']); ?>" method="post">
              <?=
                Html::hiddenInput(
                  Yii::$app->request->csrfParam,
                  Yii::$app->request->csrfToken
                );
              ?>
              <!-- таблица названий -->
              <table class="table table-bordered text-center">
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center">Наименование</th>
                  <th class="text-center">Количество, шт.</th>
                  <th class="text-center">Цена, руб.</th>
                  <th class="text-center">Сумма, руб.</th>
                  <th></th>
                </tr>
              <!-- наши данные в корзине -->
                <?php foreach ($basket['products'] as $id => $item): ?>
                <tr>
                  <td></td>
                  <td>
                    <a href="<?= Url::to(['/site/product', 'id' => $id]); ?>">
                      <?= Html::encode($item['name']); ?>
                    </a>
                  </td>
                  <td>
                    <?=
                      Html::input(
                        'text',
                        'count['.$id.']',
                        $item['count'],
                        ['style' => 'width: 50%; text-align: center;']
                      );
                    ?>
                  </td>
                  <td ><?= $item['price']; ?></td>
                  <td ><?= $item['price'] * $item['count']; ?></td>
                    <!-- кнопка удаления -->
                  <td>
                    <a href="<?= Url::to(['basket/remove', 'id' => $id]); ?>" class="text-danger">
                      <i class="fa fa-times" aria-hidden="true">Удалить</i>
                    </a>
                  </td>

                </tr>
                <?php endforeach; ?>
                <!-- перерасчет и итоги -->
                <tr>
                  <td>
                    <button type="submit"
                      class="btn btn-primary">
                      <i class="fa fa-refresh" aria-hidden="true"></i>
                      Пересчитать
                    </button>
                  </td>
                  <td colspan="3" >Итого</td>
                  <td ><?= $basket['amount']; ?></td>
                  <td></td>
                </tr>
              </table>
            </form>
          </div>
          <?php else: ?>
            <h1 class="text-center" style="padding:3em 1em 3em 1em">Ваша корзина ещё пуста</h1>
          <?php endif; ?>
        </div>
        <?php if (!empty($basket)): ?>
          <a href="<?= Url::to(['order/checkout']); ?>"
            class="btn btn-warning pull-right">
            Оформить заказ
          </a>
        <?php endif; ?>
        </div>
      </div>
    </div>
</section>
