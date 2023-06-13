<?php

/** @var yii\web\View $this */
use yii\helpers\Url;

?>
<section class="background"> <!-- orange back -->
	<div class="container cont" style="text-align:center;"> <!-- center -->
    	<div class="content-down container" style="border-radius: 25px"> <!-- white back -->
			<h1 class=" border-bottom pb-3">Таблицы</h1>
				<!-- grow -->
				<div class="container row" style="text-align:center">
					<div class="generator col-lg-4">
						<h3>Category</h3>
						<p>Таблица содержит информацию по категориям</p>
						<p>
							<a class="btn btn-warning" href="/admin/category"> К таблице »</a>
						</p>
					</div>

					<div class="generator col-lg-4">
						<h3>Product</h3>
						<p>Таблица содержит данные о продукции</p>
						<p>
							<a class="btn btn-warning" href="/admin/product"> К таблице »</a>
						</p>
					</div>

					<div class="generator col-lg-4">
						<h3>Ingredient</h3>
						<p>Таблица содержит информацию о ингридиентах</p>
						<p>
							<a class="btn btn-warning" href="/admin/ingredient"> К таблице »</a>
						</p>
					</div>

					<div class="generator col-lg-4">
						<h3>comment</h3>
						<p>Таблица содержит данные о отзывах сделанных пользователями</p>
						<p>
							<a class="btn btn-warning" href="/admin/comment"> К таблице »</a>
						</p>
					</div>
					
					<div class="generator col-lg-4">
						<h3>Ingredient Has Product</h3>
						<p>Таблица содержит информацию о наличии ингредиентов в продуктах</p>
						<p>
							<a class="btn btn-warning" href="/admin/ingredienthasproduct"> К таблице »</a>
						</p>
					</div>

					<div class="generator col-lg-4">
						<h3>Order</h3>
						<p>Таблица содержит данные о произведенных заказах</p>
						<p>
							<a class="btn btn-warning" href="/admin/order"> К таблице »</a>
						</p>
					</div>

					<div class="generator col-lg-4">
						<h3>Order Item</h3>
						<p>Таблица содержит связи заказов и входящих в них товаров</p>
						<p>
							<a class="btn btn-warning" href="/admin/orderitem"> К таблице »</a>
						</p>
					</div>


					<div class="generator col-lg-4">
						<h3>Role</h3>
						<p>Таблица содержит данные о ролях в системе</p>
						<p>
							<a class="btn btn-warning" href="/admin/role"> К таблице »</a>
						</p>
					</div>
					
					<div class="generator col-lg-4">
						<h3>Discount</h3>
						<p>Таблица содержит данные о скидках</p>
						<p>
							<a class="btn btn-warning" href="/admin/discount"> К таблице »</a>
						</p>
					</div>


					<div class="generator col-lg-4"></div>

					<div class="generator col-lg-4">
						<h3>User</h3>
						<p>Таблица содержит данные о клиентах интернет-магазина</p>
						<p>
							<a class="btn btn-warning" href="/admin/user"> К таблице »</a>
						</p>
					</div>

				</div>
			</div>
		<div class="clearfix"> </div>
	</div>
</section> 