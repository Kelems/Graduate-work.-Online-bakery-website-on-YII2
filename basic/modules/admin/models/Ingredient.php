<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id id ингридиента в таблице ингридиента
 * @property string $name название ингридиента
 * @property string|null $description описание ингридиента
 *
 * @property Ingredienthasproduct[] $ingredientHasProducts
 * @property Product[] $products
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание ингридиента',
        ];
    }

    /**
     * Gets query for [[Ingredienthasproducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredienthasproducts()
    {
        return $this->hasMany(Ingredienthasproduct::className(), ['ingredient_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('ingredient_has_product', ['ingredient_id' => 'id']);
    }
}
