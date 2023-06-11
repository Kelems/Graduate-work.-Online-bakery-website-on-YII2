<?php

  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\models\Category;
  use yii\widgets\LinkPager;
  use yii\bootstrap4\ActiveForm;

  //$this->title = 'Интернет-магазин';
  $this->title = $category['name'];
?>
<!-- баннер -->
<section class="small-banner-category">
  <div class="container">
    <div  id="top" class="callbacks_container"> <!-- the banner goes up a little bit -->
        <div class="banner-text-center"> <!-- banner content -->
          <h3><?= Html::encode($category['name']); ?></h3>
          <p><?= Html::encode($category['description']); ?></p>
      </div >
    </div>
  </div>
</section>

  <!--content-->
  <section class="background"> <!-- orange background -->

    <div class="container"> <!-- centering block and 50% for all site -->
      <div class="cont-index">  <!-- centering the block -->

      <div class="content" style="border: 15px solid white"> <!-- white part -->
        <article class="row">

          <!-- Поиск -->
          <div class="col-3"></div>
          
          <div class="col-6">
            <form method="get" action="<?= Url::to(['basic/web/index.php/site/search']); ?>" >
              <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Найти по названию">
                  <div class="input-group-btn">
                  </div>
              </div>
            </form>
          </div>
          
          <div class="col-3"></div>

          <div class="col-12 ">

            <!-- список продуктов -->
            <?php if (!empty($products)): ?>
              
              <div class="row">
                <?php foreach ($products as $product): ?>
                  <div class="col-3" style="padding: 1em 0.5em 0em 0.5em;"> <!-- вид размещения товаров -->
                    
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
                        <a style="color: black;" href="<?= Url::to(['basic/web/index.php/site/product', 'id' => $product['id']]); ?>">
                          <?= Html::encode($product['name']); ?>
                        </a>
                      </h3>

                      <!-- price -->
                      <h3 style="color: black;" class="col-sm-18">
                        <!-- now price -->
                        <?= $product['price'];  ?> р. 
                        <!-- old price -->
                        <?php
                          if ($product['old_price'] > '1') { 
                            echo Html::tag('s', $product['old_price'].' р.');
                          }
                        ?>
                      </h3>

                      <form method="post" action="<?= Url::to(['basket/add']); ?>">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                          <?=
                            Html::hiddenInput(
                              Yii::$app->request->csrfParam,
                              Yii::$app->request->csrfToken
                            );
                          ?>
                        <button type="submit" class="btn btn-warning">
                          Добавить в корзину
                        </button>
                      </form>

                    </div>

                  </div>
                <?php endforeach; ?>
              </div>
              
              <!-- постраничная навигация -->
              <?= LinkPager::widget(
                ['pagination' => $pages,
                  'options' => [
                    'class' => 'pagination mb-0'
                  ],
                ]
              ); ?>
    
              <?php else: ?> <!-- если ничего нет -->
                <p>Нет товаров в этой категории.</p>
              <?php endif; ?>

              <div class="clearfix"> </div>
            </article>

          </div>

        </div>
      </div>
    
    </div>

    <div class="clearfix"> </div>

</section>
