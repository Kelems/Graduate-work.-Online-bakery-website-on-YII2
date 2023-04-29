<?php
/** @var yii\web\View $this */
/** @var string $content */
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\modules\admin;
use yii\bootstrap4\NavBar;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="zxx">
<head>
	<title>Хлебная душа</title>
	<meta charset="UTF-8">
  <!--	<meta name="description" content="Real estate HTML Template">
	<meta name="keywords" content="real estate, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Favicon-->
	<link href="img/bread.png" rel="shortcut icon"/>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php $this->registerCsrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<?php
		NavBar::begin([ // отрываем виджет
			'brandLabel' => 'Хлебная Душа',//Yii::$app->homeUrl, // название организации
			'brandUrl' => Yii::$app->homeUrl,
			'options' => ['class' => 'head-top',], // стили главной панели.
		]);
		echo Nav::widget([
//			'options' => ['class' => 'skyblue mepanel'], // стили ul
			'options' => ['class' => 'nav-custom'], // стили ul
			'items' => [
				['label' => 'ГЛАВНАЯ', 'url' => ['/site/index']],
				['label' => 'ПРОДУКЦИЯ', 'items' => [
	 				['label' => 'ХЛЕБА', 'url' => '#'],
					['label' => 'ПИРОГИ', 'url' => '#'],
					['label' => 'ДЕСЕРТЫ', 'url' => '#'],
					['label' => 'ТОРТЫ', 'url' => '#'],
        ],],
				['label' => 'КОНТАКТЫ', 'url' => ['/site/contact']],
//				['label' => 'Таблицы', 'url' => ['/site/contact']], //доступ при правах.
				Yii::$app->user->isGuest ? // Если пользователь гость, показыаем ссылку "Вход", если он авторизовался "Выход"
	        ['label' => 'Вход', 'url' => ['/site/login']] :
          ['label' => 'Профиль (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/profile'],],
					['label' => Html::img('@web/img/cart-1.png'),'url' => ['/site/cart'], 'encode' => false], //оформить в виде кнопки с иконкой
			],
		  'encodeLabels' =>false,
		]);
		NavBar::end();
  ?>

	<!-- content Section -->
<section class="">

		<?= $content ?>

</section>

	<!-- Footer Section -->
  <footer class="footer w3layouts">
		<div class="container">
	<div class="footer-top-at w3">

		<div class="col-md-3 amet-sed w3l">
		<h4>Адрес</h4>
		<ul class="nav-bottom">
				<li>ДГТУ</li>
				<li>+7 (800) 100-19-30</li>
				<li>Сайт: www.donstu.ru</li>
				<li>площадь Гагарина, 1</li>
			</ul>
		</div>
		<div class="col-md-3 amet-sed w3ls">
			<h4>НАТУРАЛЬНЫЙ ВКУСНЫЙ ХЛЕБ</h4>
			<h4>Честность</h4>
				<h4>ручная работа</h4>
			<ul class="nav-bottom">


			</ul>

		</div>

		<div class="social">
			<ul>
				<li><a href="#"><i class="facebok"> </i></a></li>
				<li><a href="#"><i class="twiter"> </i></a></li>
				<li><a href="#"><i class="inst"> </i></a></li>
				<li><a href="#"><i class="goog"> </i></a></li>
					<div class="clearfix"></div>
			</ul>
		</div>

		<div class="clearfix"> </div>
  </footer>
  <!-- Footer Section end -->


<?php $this->endBody() ?>

	</body>
</html>

<?php $this->endPage() ?>
