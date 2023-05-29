<?php
/*
 * Страница товара, файл views/catalog/product.php
 */

use yii\helpers\Url;
use yii\helpers\Html;

  $this->title = $product['name'];

?>
<!-- баннер -->
<section class="small-banner">
  <div class="container">
    <div  id="top" class="callbacks_container"> <!-- the banner goes up a little bit -->
        <div class="banner-text-center" style="padding: 2em 0px 0px 0px;"> <!-- banner content -->
          <h3><?= Html::encode($product['name']); ?></h3>
      </div >
    </div>
  </div>
</section>
<!-- котент -->
<section class="background">
  <div class="container"> <!-- center white -->
    <div class="cont">
      <div class="content" style="border: 15px solid white"> <!-- white part -->
        <div class="row">
          <div class="col-sm-9">
              <div class="row">
                <!-- изображение -->
                <div class="col-sm-5" style="padding: 0px 1px 20px 0px;">
                  <?=
                    Html::img(
                      '@web/img/products/medium/'.$product['image'], //сделать большим
                      ['alt' => $product['name'], 'class' => 'img-responsive']
                    );
                  ?>
                </div>
                <!-- контент -->
              <div class="col-sm-7" >

                <!-- состав -->
                <div style="padding: 0px 0px 20px 0px;" >
                  <div class="row">Состав:</div>
                  <?php if (!empty($ingredients)): ?>

                    <?php foreach ($ingredients as $ingredient): ?>
                      <a>  <?= Html::encode($ingredient['name'].', '); ?> </a>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p>Состав товара, на данный момент, не внесен.</p>
                  <?php endif; ?>
                </div>

                <!-- данные из самой таблицы товара -->
                <p> Цена: <span><?= $product['price']; ?></span> </p>
                <p> Вес: <span><?= $product['weight']; ?></span> </p>
                <p> Срок годности: <span><?= $product['expiration_date']; ?></span>  </p>
                <p> Протеинов в 100 граммах: <span><?= $product['protein']; ?></span> </p>
                <p> Жиров в 100 граммах: <span><?= $product['fat']; ?></span> </p>
                <p> Углеводы в 100 граммах: <span><?= $product['carbohydrate']; ?></span> </p>
                <p> кКал в 100 граммах: <span><?= $product['calorific']; ?></span> </p>

                <!-- форма заказа -->
                <form
                method="post"
                action="<?= Url::to(['basket/add']); ?>"
                class="add-to-basket">
                  <label>Количество</label>
                  <input name="count" type="text" value="1" />
                  <input type="hidden" name="id" value="<?= $product['id']; ?>">
                    <?=
                      Html::hiddenInput(
                        Yii::$app->request->csrfParam,
                        Yii::$app->request->csrfToken
                      );
                    ?>
                  <button type="submit"
                  class="btn btn-warning"
                  >
                    Добавить в корзину
                  </button>
                </form>

              </div>

            <!-- описание товара -->
          </div>
          <div class="product-descr">
            <?= $product['content']; ?>
          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
