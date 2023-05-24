<?php
namespace app\models;


use Yii;

/**
 * This is the model class for table "ingredient_has_product".
 *
 * @property int $ingredient_id id ингридиента в связи ингридиентов и продуктов
 * @property int $product_id id продукта  в связи ингридиентов и продуктов
 *
 * @property Ingredient $ingredient
 * @property Product $product
 */
class IngredientHasProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(){
        return 'ingredient_has_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
{
        return [
            [['ingredient_id', 'product_id'], 'required'],
            [['ingredient_id', 'product_id'], 'integer'],
            [['ingredient_id', 'product_id'], 'unique', 'targetAttribute' => ['ingredient_id', 'product_id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
      return [
        'ingredient_id' => 'ID ингредиента',
        'product_id' => 'ID продукции',
      ];
    }

    /**
     * Gets query for [[Ingredient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient(){
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct(){
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }


}
