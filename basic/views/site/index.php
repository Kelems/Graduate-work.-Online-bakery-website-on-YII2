<?php
  /** @var yii\web\View $this */
  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\models\Product;
  use yii\widgets\LinkPager;
  use yii\bootstrap4\Modal;
  use yii\bootstrap4\BootstrapWidgetTrait;
?>
<!-- Intro Section end -->
<section>
  <!-- карусель -->
  <section class="banner">
    <div class="container">
      <!--
        <script src="js/responsiveslides.min.js"></script>
        <script>
          $(function () {
            $("#slider").responsiveSlides({
              auto: true,
              nav: true,
              speed: 500,
              namespace: "callbacks",
              pager: true,
            });
          });
        </script>
      -->
      <div class="callbacks_container" id="top"> <!-- the banner goes up a little bit -->
        <div class="carousel slide" id="slider" data-ride="carousel"> <!-- carousel slider  -->
          <div class="banner-text"> <!-- banner content -->
            <h3>Наша миссия</h3>
            <p>Возрождаем русские пекарные традиции, чтобы вы могли каждый день наслаждаться натуральным полезным вкусным хлебом</p>
          </div>
        </div >
      </div>
    </div>
  </section>

  <!--content-->
  <section class="background"> <!-- orange background -->
    <div class="container"> <!-- centering block and 50% for all site -->
      <div class="cont-index">  <!-- centering the block -->
      
        <div class="content"> <!-- highlighting a block on top of a white backdrop -->

          <article class="content-top-bottom">
            <h2>О нас</h2>
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
          </article>

          <div class="clearfix"> </div>

          <!-- discount block -->
          <article class="content-top-bottom">
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
