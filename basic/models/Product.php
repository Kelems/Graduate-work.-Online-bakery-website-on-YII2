<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id id продукта в таблице продуктов
 * @property int $category_id id категории продукта в таблице продуктов
 * @property string $name Название продукта
 * @property string $content Описание товара на карточке товара
 * @property float $price Цена продукта
 * @property float $old_price Старая цена продукта (для скидок)
 * @property string|null $image Имя пути к изображению продукта
 * @property string|null $weight Вес продукта в граммах
 * @property string|null $expiration_date срок годности продукта в днях
 * @property string|null $protein белки в продукте в граммах на 100 г
 * @property string|null $fat жиры в продукте в граммах на 100 г
 * @property string|null $carbohydrate углеводы в продукте в граммах  на 100 г
 * @property string|null $calorific калорийность в продукте в кКал на 100 г
 *
 * @property Category $category
 * @property Ingredienthasproduct[] $ingredientHasProducts
 * @property Ingredient[] $ingredients
 * @property OrderItem[] $orderItems
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    public static function tableName(){
        return 'product';
    }

    public function rules()
    {
        return [
            [['category_id', 'name', 'content', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['price', 'old_price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['content', 'image'], 'string', 'max' => 255],
            [['weight', 'expiration_date', 'protein', 'fat', 'carbohydrate', 'calorific'], 'string', 'max' => 15],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    function attributeLabels()
    {
      return [
        'id' => 'ID',
        'category_id' => 'ID категории',
        'name' => 'Название продукта',
        'content' => 'Описание',
        'price' => 'Цена',
        'old_price' => 'Старая цена',
        'image' => 'Путь к изображению',
        'weight' => 'Вес',
        'expiration_date' => 'Срок хранения',
        'protein' => 'Белки на 100 гр',
        'fat' => 'Жиры на 100 гр',
        'carbohydrate' => 'Углеводы на 100 гр',
        'calorific' => 'кКал на 100 гр',
      ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getIngredienthasproducts()
    {
        return $this->hasMany(Ingredienthasproduct::className(), ['product_id' => 'id']);
    }

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])->viaTable('ingredient_has_product', ['product_id' => 'id']);
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_item', ['product_id' => 'id']);
    }
}
