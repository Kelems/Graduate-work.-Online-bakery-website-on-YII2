<?php
	/** @var yii\web\View $this */
	$this->title = "Контакты";
?>
	
<!-- grow -->
<section class="small-banner-contact">
	<div class="container">
	  	<div  id="top" class="callbacks_container">
			<li>
				<div class="banner-text-center"> <h3>Контакты</h3> </div>
			</li>
		</div>
	</div>
</section>

	<!--content-->
 <section class="background"> <!-- orange background -->

	<div class="container"> <!-- centering block and 50% for all site -->
    	<div class="cont-index">  <!-- centering the block -->

      		<div class="content" style="border: 15px solid white"> <!-- white part -->
				<h2 style="text-align: center;">CВЯЖИТЕСЬ С НАМИ</h2>
				<div class="contact-form">
					<div class="col-md-7 contact-grid">
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
					<div class="col-md-4 contact-in">
						<div class="address-more">
							<h4>Контактные данные</h4>
							<p>BreadSoul@mail.ru</p>
							<p>+7 (952) 163-07-38</p>
							<p>Кузнечная ул., 8, Ростов-на-Дону</p>
						</div>
					</div>

					<div class="clearfix"> </div>
				</div>
		
				<div class="map">
					<iframe src="https://yandex.ru/map-widget/v1/?ll=39.624148%2C47.193784&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgoxOTM0ODE4MTMxEkrQoNC-0YHRgdC40Y8sINCg0L7RgdGC0L7Qsi3QvdCwLdCU0L7QvdGDLCDQmtGD0LfQvdC10YfQvdCw0Y8g0YPQu9C40YbQsCwgOCIKDSF_HkIVcMY8Qg%2C%2C&z=16.64" width="1145" height="455" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
</section>
