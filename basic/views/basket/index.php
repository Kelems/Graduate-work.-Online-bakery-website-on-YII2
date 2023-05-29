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

          <?php echo "<pre>";
          print_r($basket);
          echo "</pre>";?>

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
                  <th class="text-center">Изображение</th>
                  <th class="text-center">Наименование</th>
                  <th class="text-center">Количество, шт.</th>
                  <th class="text-center">Цена, руб.</th>
                  <th class="text-center">Сумма, руб.</th>
                  <th></th>
                </tr>
              <!-- наши данные в корзине -->
                <?php foreach ($basket['products'] as $id => $item): ?>
                <tr>
                  <!-- Изображение -->
                  <td></td>
                  <!-- название товара с ссылкой -->
                  <td>
                    <a href="<?= Url::to(['/site/product', 'id' => $id]); ?>">
                      <?= Html::encode($item['name']); ?>
                    </a>
                  </td>
                  <!-- количество -->
                  <td>
                    <?=Html::input(
                      'text',
                      'count['.$id.']',
                      $item['count'],
                      ['style' => 'width: 50%; text-align: center;']
                    );?>
                  </td>
                  <!-- цена за штуку -->
                  <td ><?= $item['price']; ?></td>
                  <!-- цена всего -->
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
                  <!-- перерасчет -->
                  <td>
                    <button type="submit"
                      class="btn btn-primary">
                      <i class="fa fa-refresh" aria-hidden="true"></i>
                      Изменить данные
                    </button>
                  </td>
                   <!-- слово "итого" -->
                  <td colspan="3">Итого</td>
                  <!-- итоговое значение всего-->
                  <td ><?= $basket['amount']; ?></td>
                  <td>
                    <a href="<?= Url::to(['basket/clear']); ?>" class="text-danger">
                      Очистить корзину
                    </a>
                  </td>
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
