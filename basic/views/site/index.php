<?php

/** @var yii\web\View $this */

?>
<!-- Intro Section end -->
<section class="banner">
  <div class="container">
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
    <div  id="top" class="callbacks_container">
      <ul class="rslides" id="slider">
        <li>
          <div class="banner-text">
            <h3>Наша миссия</h3>
            <p>Возрождаем русские пекарные традиции, чтобы вы могли каждый день наслаждаться натуральным полезным вкусным хлебом</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<!--content-->
<section class="banner1">
  <div class="container">
    <div class="cont">
      <div class="content">
        <div class="content-top-bottom">
          <h2>О нас</h2>
          <!-- left block -->
          <div class="col-md-6 men">
            <a href="#" class="b-link-stripe b-animate-go  thickbox">
              <img class="img-responsive" src="img/t1.jpg" alt="">
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
                  <img class="img-responsive" src="img/t2.jpg" alt="">
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
                    <img class="img-responsive" src="img/t3.jpg" alt="">
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
                    <img class="img-responsive" src="img/t4.jpg" alt="">
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
            <div class="grid-in">
              <div class="col-md-3 grid-top simpleCart_shelfItem">
            <!-- 1 small block -->
                <a href="#" class="b-link-stripe b-animate-go  thickbox">
                  <img class="img-responsive" src="img/pi.jpg"></img>
                </a>
              <p>Наполеон</p>

            <!-- 2 small block -->
              <a href="#" class="item_add">
                <p class="number item_price"><i></i>$000.00</p>
              </a>
            </div>
            <div class="col-md-3 grid-top simpleCart_shelfItem">
              <a href="#" class="b-link-stripe b-animate-go  thickbox">
                <img class="img-responsive" src="img/pi1.jpg" alt="">

<!-- animated panel
                <div class="b-wrapper">
                  <h3 class="b-animate b-from-left b-delay03 ">
                    <span>Ручная работа</span>
                  </h3>
                </div>
-->
                </img>
              </a>
              <p>Меренговый рулет</p>
              <a href="#" class="item_add">
                <p class="number item_price"><i> </i>$000.00</p>
              </a>
            </div>
          <!-- 3 small block -->

            <div class="col-md-3 grid-top simpleCart_shelfItem">
              <a href="#" class="b-link-stripe b-animate-go  thickbox">
                <img class="img-responsive" src="img/pi2.jpg" alt="">
<!--
                <div class="b-wrapper">
                  <h3 class="b-animate b-from-left    b-delay03 ">
                    <span>Бездрожжевой</span>
                  </h3>
                </div>
-->
                </img>
              </a>
                <p>Пшенично - ржаной</p>
              <a href="#" class="item_add"><p class="number item_price"><i> </i>$000.00</p></a>
            </div>
          <!-- 4 small block -->
            <div class="col-md-3 grid-top">
              <a href="#" class="b-link-stripe b-animate-go  thickbox">
                <img class="img-responsive" src="img/pi4.jpg" alt="">
<!--
                <div class="b-wrapper">
                  <h3 class="b-animate b-from-left    b-delay03 ">
                    <span>С нежным сладковатым вкусом</span>
                  </h3>
                </div>
-->
                </img>
              </a>
              <p>ВЕНСКИЙ батон</p>
              <a href="#" class="item_add"><p class="number item_price"><i> </i>$000.00</p></a>
            </div>
          <div class="clearfix"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
