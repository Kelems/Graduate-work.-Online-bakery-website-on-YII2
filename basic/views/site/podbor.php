<?php

/** @var yii\web\View $this */
use yii\helpers\Url;

?>
<style media="screen">
	.btn{
		background: orange;
		color: black;
		padding: 1rem;
		text-decoration: none;
		font-weight: bold;
text-align: center;
		margin: 5px;
	}

.lux a{
	padding: 15px;
}

</style>
	<!-- grow -->
	<div class="grow">
		<div class="container">
			<h2>Подбор поставщиков</h2>
		</div>
	</div>
	<!-- grow -->
	<div class="product">
		<div class="container">
<!--       ^-не трогать  -->

		 <!--href="/admin/ingredients" -->
		 <table class="lux table table-hover table-bordered">
	   	<tr>
				<th>Базовые таблицы</th>
				<td><a href="/basic/web/index.php?r=admin/ingredients" class="btn" target="_blank">
				  Ингредиенты
				</a>
				<a href="/basic/web/index.php?r=admin/provider" class="btn" target="_blank">
				  Поставщики
				</a>
				<a href="/basic/web/index.php?r=admin/purchases" class="btn" target="_blank">
				  Заказы
				</a>
				<a href="/basic/web/index.php?r=admin/ingredientshasprovider" class="btn" target="_blank">
				  Предложения
				</a></td>
			</tr>
			<tr>
				<th>Таблицы поисков</th>
				<td><a href="/basic/web/index.php?r=site%2Fingredient" class="btn" target="_blank">
				  Таблица Ингредиентов с условием
				</a>
				<a href="/basic/web/index.php?r=site%2Fpredlojenie" class="btn" target="_blank">
				  Таблица Предложений с учетом условий
				</a>
			</tr>
				<tr>
					<th>Таблицы итогов</th>
					<td>
						<a href="/basic/web/index.php?r=site%2Fitogpostavchik" class="btn" target="_blank">
						  Итоговые закупки за день по поставщикам
						</a>
						<a href="/basic/web/index.php?r=site%2Fitogday" class="btn" target="_blank">
							Итоговые закупки за день
						</a>
					</td>
			</tr>
		</table>

		</div>
		<div class="clearfix"> </div>
	</div>
