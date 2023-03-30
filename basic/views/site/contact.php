<?php
/** @var yii\web\View $this */
?>
	<!-- grow -->
	<section class="banner">
		<div class="container">
			<script src="js/responsiveslides.min.js"></script>
			<script>
				$(function () {
					$("#slider").responsiveSlides({
						auto: true,
						nav: true,
						speed: 200,
						namespace: "callbacks",
						pager: true,
					});
				});
			</script>
	    <div  id="top" class="callbacks_container">
				<ul class="rslides" id="slider">
					<li>
						<div class="banner-text">
							<h3>Контакты</h3>
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
					<div class="contact">
						<div class="container">
							<div class="contact-form">
									<div class="col-md-8 contact-grid">
										<form action="#" method="post" style="text-align:center; "> <!-- центрировать -->
											<input type="text" value="ФИО" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}">
											<input type="text" value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}">
											<input type="text" value="Тема" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Subject';}">
											<textarea cols="77" rows="6" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Сообщение</textarea>
											<div class="send">
												<input type="submit" value="Отправить">
											</div>
										</form>
									</div>
									<!--
									<div class="col-md-4 contact-in">
										<div class="address-more">
											<h4>Адрес</h4>
											<p>ДГТУ</p>
											<p>+7 (800) 100-19-30</p>
											<p>Сайт: www.donstu.ru</p>
											<p>площадь Гагарина, 1, Ростов-на-Дону</p>
										</div>
									</div>
								-->
									<div class="clearfix"> </div>
								</div>
								<div class="map">
									<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A9e36973c89542bbeb6ecddc76039bdc5673fac85a1781130112d1015123710c3&amp;source=constructor" width="1145" height="455" frameborder="0"></iframe>
								</div>
							</div>

					</div>
				</div>
			</div>
		</div>
	</section>
