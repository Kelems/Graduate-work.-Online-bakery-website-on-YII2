<?php
  /** @var yii\web\View $this */
  use yii\bootstrap4\Modal;
  use yii\bootstrap4\BootstrapWidgetTrait;
?>
<!-- Intro Section end -->
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
<section class="banner1"> <!-- orange background -->
  <div class="container"> <!-- centering the block -->
    <div class="cont">  <!-- centering the block -->
      <div class="content"> <!-- highlighting a block on top of a backdrop -->
        <div class="content-top-bottom">
          <h2>О нас</h2>
          <!-- left block -->
          <div class="col-md-6 men">
            <a href="#" class="b-link-stripe b-animate-go thickbox">
              <img class="img-responsive" src="img/products/medium/t1.jpg" >
                <div class="b-wrapper">
                  <h3 class="b-animate b-from-top top-in   b-delay03 ">
                    <span>
                      <b>Традиции</b>
                      <br>Мы печем по старым рецептам на закваске, артезианской воде и грубой муке</br>
                    </span>
                  </h3>
                </div>
              </img>
            </a>
          </div>
          <!-- right block -->
            <div class="col-md-6">
            <!-- middle up image -->
              <div class="col-md1 ">
                <a href="#" class="b-link-stripe b-animate-go  thickbox">
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
            <!-- small left image -->
              <div class="col-md2">
                <div class="col-md-6 men1">
                  <a href="#" class="b-link-stripe b-animate-go  thickbox">
                    <img class="img-responsive" src="img/products/medium/t3.jpg" alt="">
                      <div class="b-wrapper">
                        <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                          <span><b>Торты и десерты</b></span>
                        </h3>
                      </div>
                    </img>
                  </a>
                </div>
              <!-- small right image -->
                <div class="col-md-6 men2">
                  <a href="#" class="b-link-stripe b-animate-go  thickbox">
                    <img class="img-responsive" src="img/products/medium/t4.jpg" alt="">
                      <div class="b-wrapper">
                        <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                          <span>Сытные</span>
                        </h3>
                      </div>
                    </img>
                  </a>
                </div>
              <div class="clearfix"> </div>
              </div>
            </div>
          <div class="clearfix"> </div>
          </div>
      <!-- lower block -->
          <div class="content-top">
            <h1>Акции</h1>

            <!--
              вставить модуль с акциями -V
           -->
           <div class="col-sm-9">
             <?php if (!empty($hits)): ?>
               <h2>Лидеры продаж</h2>
                <div class="row">
                  <?php foreach ($hits as $hit): ?>
                    <div class="col-sm-4">
                      <div class="product-wrapper text-center">
                        <?=
                          Html::img(
                            '@web/img/products/medium/'.$hit['image'],
                            ['alt' => $hit['name'], 'class' => 'img-responsive']
                          );
                        ?>
                        <h2><?= $hit['price']; ?> руб.</h2>
                        <p>
                          <a href="<?= Url::to(['catalog/product', 'id' => $hit['id']]); ?>">
                            <?= Html::encode($hit['name']); ?>
                          </a>
                        </p>
                        <a href="#" class="btn btn-warning">
                         <i class="fa fa-shopping-cart"></i>
                         Добавить в корзину
                        </a>
                        <?php
                          if ($hit['sale']) { // распродажа?
                            echo Html::img(
                              '@web/images/home/sale.png',
                              ['alt' => 'Распродажа', 'class' => 'sale']
                            );
                          }
                        ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>

<?php
Modal::begin([
  'title' => '<h2>Hello world</h2>',
  'footer' => 'Низ окна',
]);
 ?>

          <!-- -->

        </div>
      </div>
    </div>
  </div>
</section>
