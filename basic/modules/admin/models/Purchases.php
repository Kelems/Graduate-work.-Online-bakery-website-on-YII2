<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "purchases".
 *
 * @property int $id номер закупки
 * @property int $ingredients_has_provider_ingredients_id
 * @property int $ingredients_has_provider_provider_id
 * @property string $order_date Дата заказа
 * @property int $amount сколько Ингредиента заказано
 *
 * @property IngredientsHasProvider $ingredientsHasProviderIngredients
 */
class Purchases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_has_provider_ingredients_id', 'ingredients_has_provider_provider_id','order_date', 'amount'], 'required'],
            [['ingredients_has_provider_ingredients_id', 'ingredients_has_provider_provider_id', 'amount'], 'integer'],
            [['order_date'],'safe'],
            [['order_date'],'date','format' => 'php:Y-m-d'],
            [['ingredients_has_provider_ingredients_id', 'ingredients_has_provider_provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => IngredientsHasProvider::className(), 'targetAttribute' => ['ingredients_has_provider_ingredients_id' => 'ingredients_id', 'ingredients_has_provider_provider_id' => 'provider_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID заказа',
            'ingredients_has_provider_ingredients_id' => 'Ингредиент',
            'ingredients_has_provider_provider_id' => 'Поставщик',
            'order_date' => 'Дата заказа',
            'amount' => 'Сколько заказывается',
        ];
    }

    /**
     * Gets query for [[IngredientsHasProviderIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
     /*
    public function getIngredientsHasProviderIngredients()
    {
        return $this->hasOne(IngredientsHasProvider::className(), ['ingredients_id' => 'ingredients_has_provider_ingredients_id', 'provider_id' => 'ingredients_has_provider_provider_id']);
    }
*/
    public function getIngr()
    {
        return $this->hasOne(IngredientsHasProvider::className(), ['ingredients_id' => 'ingredients_has_provider_ingredients_id', ]);
    }

    public function getProv()
    {
        return $this->hasOne(IngredientsHasProvider::className(), [ 'provider_id' => 'ingredients_has_provider_provider_id']);
    }

}
