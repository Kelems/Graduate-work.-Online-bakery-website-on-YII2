<?php

  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\models\Category;
  use yii\widgets\LinkPager;

  //$this->title = 'Интернет-магазин';
  $this->title = $category['name'];
?>
<!-- баннер -->
<section class="small-banner">
  <div class="container">
    <div  id="top" class="callbacks_container"> <!-- the banner goes up a little bit -->
        <div class="banner-text-center"> <!-- banner content -->
          <h3><?= Html::encode($category['name']); ?></h3>
          <p><?= Html::encode($category['description']); ?></p>
      </div >
    </div>
  </div>
</section>

<!-- контент -->
<section class="banner1"> <!-- orange back -->
  <div class="container"> <!-- orange back -->
    <div class="cont">

      <div class="content" style="border: 15px solid white"> <!-- white part -->
        <div class="row">
          <div class="col-sm-12 ">
            <!-- список продуктов -->
            <?php if (!empty($products)): ?>
              <div class="row">
                <?php foreach ($products as $product): ?>
                  <div class="col-sm-3" style="padding: 1em 1em 0em 1em;"> <!-- вид размещения товаров -->
                    <!-- img -->
                    <div class="product-wrapper text-center"> <!-- white part -->
                      <?=
                        Html::img(
                          '@web/img/products/medium/'.$product['image'],
                          ['alt' => $product['name'], 'class' => 'img-responsive']
                        );
                      ?>

                      <!-- name -->
                      <h3 style="padding: 0em">
                        <a style="color: black;" href="<?= Url::to(['basic/web/index.php/site/product', 'id' => $product['id']]); ?>">
                          <?= Html::encode($product['name']); ?>
                        </a>
                      </h3>

                        <!-- price -->
                      <h3 style="color: black;" class="col-sm-15">
                        <?= $product['price'];  ?> р. <!-- now price -->
                        <?php
                          if ($product['old_price'] > '1') { // old price
                            Html::removeCssClass($options,'btn-default');
                            Html::addCssClass($options,'style="grey";');
                            echo Html::tag('s', $product['old_price'].' р.', $options);
                          }
                        ?>
                      </h3>

                      <form method="post"
                      action="<?= Url::to(['basket/add']); ?>">
                        <input type="hidden" name="id"
                        value="<?= $product['id']; ?>">
                          <?=
                            Html::hiddenInput(
                              Yii::$app->request->csrfParam,
                              Yii::$app->request->csrfToken
                            );
                          ?>
                          <button type="submit" class="btn btn-warning">
                            <i class="fa fa-shopping-cart"></i>
                            Добавить в корзину
                          </button>
                        </form>
                        
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <?= LinkPager::widget(
                  /* постраничная навигация */
                  ['pagination' => $pages,
                  //'options' => [],
                  //'linkOptions' => ['class' => 'page-link']
                ]
                ); ?>
              <?php else: ?>
                <p>Нет товаров в этой категории.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
