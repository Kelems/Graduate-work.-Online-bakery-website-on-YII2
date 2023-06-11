<?php
	use app\assets\AppAsset;
	use yii\helpers\Url;
	//use app\widgets\Alert;
	//use yii\bootstrap4\Breadcrumbs;
	use yii\bootstrap4\Html;
	use yii\bootstrap4\Nav;
	use yii\bootstrap4\NavBar;
	use yii\bootstrap4\Modal;
	use yii\bootstrap4\BootstrapWidgetTrait;

	use yii\modules\admin;
	use yii\widgets\Menu;

	AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <!--
		<meta name="description" content="Real estate HTML Template">
		<meta name="keywords" content="real estate, html">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		-->
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Favicon / Logo -->
		<link href="img/Favicon.ico" rel="shortcut icon"/>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php $this->registerCsrfMetaTags() ?>

		<title>
			<?= Html::encode($this->title) ?>
		</title>

		<?php $this->head() ?>
		<!-- переменная для ссылки на профиль-->
		<?php $user = Yii::$app->user->identity->email; ?>
		<?php $role_id = Yii::$app->user->identity->role_id; ?>
	</head>

	<body>
		<?php $this->beginBody() ?>

		<!-- page header -->
		<header>
			<nav id="w1" class="navbar navbar-fixed navbar" role="navigation">
				<a class="navbar-brand" href="/">Хлебная Душа</a>
				<div id="w1-collapse">
					<ul id="w2" class="navbar-right nav">
						<li class="nav-item">
							<a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/contact">КОНТАКТЫ</a>
						</li>
						<li class="dropdown nav-item">
							<a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">ПРОДУКЦИЯ</a>
							<div id="w3" class="dropdown-menu">
								<a class="dropdown-item" href="http://192.168.1.39/basic/web/index.php/site/category?id=1">
									ХЛЕБА
								</a>
								<a class="dropdown-item" href="http://192.168.1.39/basic/web/index.php/site/category?id=2">
									БАГЕТЫ
								</a>
								<a class="dropdown-item" href="http://192.168.1.39/basic/web/index.php/site/category?id=3">
									ПИРОГИ
								</a>
								<a class="dropdown-item" href="http://192.168.1.39/basic/web/index.php/site/category?id=4">
									ДЕСЕРТЫ
								</a>
							</div>
						</li>
							<?php if (!Yii::$app->user->isGuest): ?> <!--!Yii::$app->user->isGuest не гость -->
								<li class="nav-item">
									<a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/profile-view?email=<?php echo "$user"?>">
										КАБИНЕТ (<?php echo "$user"?>)
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/logout">
										ВЫЙТИ
									</a>
								</li>
							<?php else: ?>
								<li class="nav-item">
									<a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/login">
										ВОЙТИ
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/registration">
										РЕГИСТРАЦИЯ
									</a>
								</li>
							<?php endif; ?>
						<li class="nav-item"><a class="nav-link" href="http://192.168.1.39/basket/index"><img src="/img/cart.png" alt=""></a></li>
						<?php if (Yii::$app->user->identity->role_id === 2): ?>
							<li class="nav-item"><a class="nav-link" href="http://192.168.1.39/basic/web/index.php/site/tables"><img src="/img/tick1.png" alt=""></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</nav>
		</header>

		<!-- content Section -->
		<section>
			<?php if( Yii::$app->session->hasFlash('success') ): ?>
			    <div class="alert text-center alert-success " role="alert" style="margin: 0px; margin-bottom: 0px;">
	        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<?php echo Yii::$app->session->getFlash('success'); ?>
	    		</div>
			<?php endif;?>

			<?php if( Yii::$app->session->hasFlash('info') ): ?>
			    <div class="alert text-center alert-info" role="alert" style="margin: 0px; margin-bottom: 0px;">
	        		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<?php echo Yii::$app->session->getFlash('info'); ?>
	    		</div>
			<?php endif;?>

			<?php if( Yii::$app->session->hasFlash('dismissible') ): ?>
			    <div class="alert text-center alert-dismissible" role="alert" style="margin: 0px; margin-bottom: 0px;">
	        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<?php echo Yii::$app->session->getFlash('dismissible'); ?>
	    		</div>
			<?php endif;?>
			<?= $content ?>

		</section>

		<!-- Footer Section -->
		<footer class="footer">
			<div class="container">
				<div class="footer-top-at w3">
					<div class="col-md-3 amet-sed w3l">  <!-- Первая колонка подвала-->
						<h4>Адрес</h4>
						<ul class="nav-bottom">
							<li>ДГТУ</li>
							<li>+7 (800) 100-19-30</li>
							<li>Сайт: www.donstu.ru</li>
							<li>площадь Гагарина, 1</li>
						</ul>
					</div>
					<div class="col-md-3 amet-sed w3ls"> <!-- вторая колонка подвала-->
						<h4>НАТУРАЛЬНЫЙ ВКУСНЫЙ ХЛЕБ</h4>
						<h4>Честность</h4>
						<h4>ручная работа</h4>
						<ul class="nav-bottom">	</ul>
					</div>
					<div class="social"> <!-- соц.сети -->
						<ul>
							<li><a href="#"><i class="facebok"> </i></a></li>
							<li><a href="#"><i class="twiter"> </i></a></li>
							<li><a href="#"><i class="inst"> </i></a></li>
							<li><a href="#"><i class="goog"> </i></a></li>
							<div class="clearfix"></div>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</footer>
	  <!-- Footer Section end -->

		<?php $this->endBody() ?>
	</body>
</html>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

<?php $this->endPage() ?>
