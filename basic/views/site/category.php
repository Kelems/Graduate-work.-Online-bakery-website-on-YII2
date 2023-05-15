<?php

  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\models\Category;

  $this->title = $category['name'];
?>

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

<section class="banner1">
  <div class="container"> <!-- orange back -->
    <div class="cont">
      <div class="content"> <!-- white part -->
          <div class="row">
            <div class="col-sm-12 ">
              <?php if (!empty($products)): ?>
                <div class="row">
                  <?php foreach ($products as $product): ?>
                    <div class="col-sm-3" style="padding: 1em 1em 0em 1em;">
                      <div class="product-wrapper text-center"> <!-- white part -->
                        <!-- img -->
                        <?=
                          Html::img(
                            '@web/img/products/medium/'.$product['image'],
                            ['alt' => $product['name'], 'class' => 'img-responsive']
                          );
                        ?>
                        <!-- name -->
                        <h3>
                          <a href="<?= Url::to(['catalog/product', 'id' => $product['id']]); ?>">
                            <?= Html::encode($product['name']); ?>
                          </a>
                        </h3>
                        <!-- price -->
                        <h3><?= $product['price']; ?> руб.</h3>
                        <!-- button -->
                        <a href="#" class="btn btn-warning">
                          <i class="fa fa-shopping-cart"></i>
                            Добавить в корзину
                        </a>

                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p>Нет товаров в этой категории.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
