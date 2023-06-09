<?php
/*
 * Страница товара, файл views/catalog/product.php
 */

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\CommentForm;
use app\models\Comment;
use yii\imagine\Image;

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

<!-- контент -->
<section class="background" style="padding-bottom: 1em;">
  <div class="container"> <!-- center white -->
    <div class="content-product row" style="border: 15px solid white"> <!-- white part -->
      <div class="col-sm-12 row">
        <!-- контент -->
        <div class="col-sm-7" >
          <!-- состав -->
          <div style="padding: 0px 0px 20px 0px;" >
            <p><b>Состав:</b></p>
            <?php if (!empty($ingredients)): ?>
              <?php foreach ($ingredients as $ingredient): ?>
                <a>  <?= Html::encode($ingredient['name'].', '); ?> </a>
              <?php endforeach; ?>
            <?php else: ?>
              <b>Состав товара, на данный момент, не внесен.</b>
            <?php endif; ?>
          </div>

          <!-- данные из самой таблицы товара -->
          <p><b>Цена: </b><span><?= $product['price'] . " рублей" ?></span> </p>

          <!-- форма заказа -->
          <form style="padding-bottom:30px;"
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
              class="btn btn-warning">
              Добавить в корзину
            </button>
          </form>
          <p><b>Вес: </b><span><?= $product['weight'] ." грамм." ?></span> </p>
          <p><b>Срок годности: </b><span><?= $product['expiration_date'] ." дня."; ?></span>  </p>
          <p><b>Белков в 100 граммах: </b><span><?= $product['protein'] ." гр."; ?></span> </p>
          <p><b>Жиров в 100 граммах: </b><span><?= $product['fat'] ." гр."; ?></span> </p>
          <p><b>Углеводы в 100 граммах: </b><span><?= $product['carbohydrate'] ." гр."; ?></span> </p>
          <p><b>кКал в 100 граммах: </b><span><?= $product['calorific'] ." кДж."; ?></span> </p>
        <!-- описание товара -->
          <p><b> Описание: </b><span><?= $product['content']; ?></span> </p>     


        </div>
        <!-- изображение -->
        <div class="col-sm-5" style="padding: 0px 20px 0px 0px;">
          <?=
          //          $image = Yii::getAlias('@web/img/products/medium/'.$product['image']);,

            Html::img(
            '@web/img/products/medium/'.$product['image'],
            ['alt' => $product['name'], 'class' => 'img-responsive']
            );
          ?>
        </div>
      
      </div>
    </div>
  </div>

  <?php if (!Yii::$app->user->isGuest) :  ?> <!-- авторизовался ли пользователь -->

    <?php $query = (new Comment())->getCommentuser(Yii::$app->user->id, $product['id']); ?>
    <?php if (empty($query)): ?> <!-- писал ли он отзыв данному товару? -->

      <div class="container" style=" padding: 0px 0% 0px 0%;  border: 10px inset grey;"> <!-- center white -->
        <div class="content-product"> <!-- white part -->

            <!-- форма для комментариев-->
            <?php $form = \yii\widgets\ActiveForm::begin([
              'action' => ['site/comment', 'id'=>$product['id']],
              'options' => [ 'role'=>'form']]) ?>

              <div class="form-group" style="padding: 5px 5px 0px 5px">
                  <?= $form->field($commentForm, 'message')->textarea(['class'=>'form-control', 'style'=>'display:inlinflex','placeholder'=> 'Место под ваш комментарий!'])->label(false) ?>
              </div>
            <button type="submit" class="btn btn-warning" style='margin-left:40%; margin-bottom: 1em;'>Сохранить комментарий</button>
            <?php \yii\widgets\ActiveForm::end() ?>

        </div>
      </div>

    <?php endif; ?>
  <?php endif; ?>

  <!-- отзывы -->
  <?php if(!empty($comments)): ?>
    <?php foreach($comments as $comment): ?>
      <div class="content-product container" style=" padding: 0px 0% 0px 0%;  border: 10px inset grey;"> <!-- center white -->
        <p>
          <h5 style="padding: 0px 0px 0px 10px"><b><?= $comment->user['name']; ?></b></h5> 
            <span style="color: grey; padding: 0px 0px 0px 10px"><?= substr($comment['date_message'],0, 10); ?></span>
          </p>
        <p><span style="padding: 0px 0px 0px 30px"><?= $comment['message']; ?></span>  </p>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
</section>
