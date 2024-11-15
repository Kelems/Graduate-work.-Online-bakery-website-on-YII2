<?php
  /** @var yii\web\View $this */
  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\models\Product;
  use yii\widgets\LinkPager;
  use yii\bootstrap4\Modal;
  use yii\bootstrap4\BootstrapWidgetTrait;
  use yii\bootstrap4\Carousel; // ДляКарусели
?>
<!-- Intro Section end -->
<section>
  <!-- Задний фон -->
  <section class="banner">
    <div class="container">
      <div class="callbacks_container" id="top"> <!-- the banner goes up a little bit -->
        <div class="carousel slide" id="slider" data-ride="carousel"> <!-- carousel slider  -->
          <div class="banner-text"> <!-- banner content -->
            <h3>Наша миссия</h3>
            <p>Возрождаем русские пекарные традиции, чтобы вы могли каждый день наслаждаться натуральным полезным вкусным хлебом</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--content-->
  <section class="background"> <!-- orange background -->
    <div class="container" style="margin-bottom: 40%;"> <!-- centering block and 50% for all site -->
      <div class="cont-index">  <!-- centering the block -->
        <div class="content"> <!-- highlighting a block on top of a white backdrop -->
          <article class="content-top-bottom">

            <!-- Карусель -->
            <h2>Специально для вас!</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($carouselItems); $i++): ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
                <?php endfor; ?>
              </ol>
              <div class="carousel-inner">
                <?php foreach ($carouselItems as $index => $item): ?>
                  <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                    <div class="row">
                      <?php foreach ($item as $product): ?>
                        <div class="col-md-4 text-center">
                          <h3 style="padding: 0em">
                            <a style="color: black;" href="<?= Url::to(['site/product', 'id' => $product['id']]) ?>">
                              <img src="<?= \Yii::getAlias('@web') . '/img/products/medium/' . $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid" style="max-width: 100%; height: auto;">
                              <?= Html::encode($product['name']); ?>
                            </a>
                          </h3>
                          <h3 style="color: black;" class="col-sm-15">
                            <?= $product['price'];  ?> р. <!-- now price -->
                            <?php
                              if ($product['old_price'] > '1') { // old price
                                echo Html::tag('s', $product['old_price'].' р.');
                              }
                            ?>
                          </h3>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

          <h2>О нас</h2>
          <div> <!-- block "О нас" -->
            <!-- left block -->
            <div class="col-md-5 men">
              <a href="http://yii-2-bakery/basic/web/index.php/site/category?id=1" class="b-link-stripe b-animate-go thickbox">
                <img class="img-responsive" src="img/products/medium/5.png" >
                  <div class="b-wrapper">
                    <h3 class="b-animate b-from-top top-in ">
                      <span>
                        <b>Хлеба</b>
                        <br>Мы печем по старым рецептам на закваске, артезианской воде и грубой муке</br>
                      </span>
                    </h3>
                  </div>
                </img>
              </a>
            </div>

            <!-- right block -->
            <div class="col-md-6 men">
              <!-- middle up image -->
              <div class="col-md">
                <a href="http://yii-2-bakery/basic/web/index.php/site/category?id=3" class="b-link-stripe b-animate-go  thickbox">
                  <img class="img-responsive" src="img/products/medium/t2.jpg" alt="">
                    <div class="b-wrapper">
                      <h3 class="b-animate b-from-top top-in1   b-delay03 ">
                        <span>
                          <b>Сладкие и сытные пироги</b>
                          <br>В наших пирогах всегда много начинки</br>
                        </span>
                      </h3>
                    </div>
                  </img>
                </a>
              </div>

              <!-- two small down image -->
              <div class="col-md2 men">
                <!-- small left image -->
                <div class="col-md-5 men1">
                  <a href="http://yii-2-bakery/basic/web/index.php/site/category?id=4" class="b-link-stripe b-animate-go  thickbox">
                    <img class="img-responsive" src="img/products/medium/33.png" alt="">
                      <div class="b-wrapper">
                        <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                          <span><b>Десерты</b></span>
                        </h3>
                      </div>
                    </img>
                  </a>
                </div>
                <div class="col-md-2"> </div>
                <!-- small right image -->
                <div class="col-md-5 men1">
                  <a href="http://yii-2-bakery/basic/web/index.php/site/category?id=2" class="b-link-stripe b-animate-go  thickbox">
                    <img class="img-responsive" src="img/products/medium/25.png" alt="">
                      <div class="b-wrapper">
                        <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                          <span>Багеты</span>
                        </h3>
                      </div>
                    </img>
                  </a>
                </div>
              </div>
            </div>
            <!-- end right block -->
          <div class="clearfix"> </div>
        </div>
        <!-- Конец блока "О нас"-->
        <!-- discount block -->
        <h2>Акции</h2>
        <div class="col-sm-12 ">
          <!-- список продуктов -->
          <?php if (!empty($discounts)): ?>
            <div class="row">
              <?php foreach ($discounts as $discount): ?>
                <div class="col-sm-4"> <!-- вид размещения товаров -->
                  <!-- type of one part of the product -->
                  <div class="product-wrapper text-center"> <!-- white part -->
                    <!-- img -->
                    <?=Html::img('@web/img/products/medium/'.$discount['image'],
                      ['alt' => $discount['name'], 'class' => 'img-responsive']
                    );
                    ?>
                    <!-- name -->
                    <h3 style="padding: 0em">
                      <a style="color: black;" href="<?= Url::to(['basic/web/index.php/site/product', 'id' => $discount['id']]); ?>">
                        <?= Html::encode($discount['name']); ?>
                      </a>
                    </h3>
                    <!-- price -->
                    <h3 style="color: black;" class="col-sm-15">
                      <?= $discount['price'];  ?> р. <!-- now price -->
                      <?php
                        if ($discount['old_price'] > '1') { // old price
                          echo Html::tag('s', $discount['old_price'].' р.');
                        }
                      ?>
                    </h3>
                    <!-- button -->
                    <form method="post" action="<?= Url::to(['basket/add']); ?>">
                      <input type="hidden" name="id" value="<?= $discount['id']; ?>">
                        <?= Html::hiddenInput(
                          Yii::$app->request->csrfParam,
                          Yii::$app->request->csrfToken
                        );?>
                      </input>
                      <button type="submit" class="btn btn-warning">
                        <i class="fa fa-shopping-cart"></i>
                        Добавить в корзину
                      </button>
                    </form>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p style="text-align: center;">Сейчас нет товаров со скидкой.</p>
          <?php endif; ?>
        </div>
      </article>
      <div class="clearfix"> </div>
    </div>
  </div>
  </div>
  </section>
</section>
