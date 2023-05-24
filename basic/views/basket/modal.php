<?php
/*
 * Корзина покупателя в модальном окне, файл views/basket/modal.php
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if (!empty($basket)): ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена, руб.</th>
                <th>Сумма, руб.</th>
            </tr>
            <?php foreach ($basket['products'] as $item): ?>
                <tr>
                    <td><?= $item['name']; ?></td>
                    <td class="text-right"><?= $item['count']; ?></td>
                    <td class="text-right"><?= $item['price']; ?></td>
                    <td class="text-right"><?= $item['price'] * $item['count']; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-right">Итого</td>
                <td class="text-right"><?= $basket['amount']; ?></td>
            </tr>
        </table>
    </div>
<?php else: ?>
    <p>Ваша корзина пуста</p>
<?php endif; ?>
