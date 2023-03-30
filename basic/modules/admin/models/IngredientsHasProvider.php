<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "ingredients_has_provider".
 *
 * @property int $ingredients_id id имеющегося у поставщика Ингредиента
 * @property int $provider_id
 * @property float $cost
 * @property string|null $comment комментарий о товаре у поставщика
 *
 * @property Ingredients $ingredients
 * @property Provider $provider
 * @property Purchases[] $purchases
 */
class Ingredientshasprovider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients_has_provider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_id', 'provider_id', 'cost'], 'required'],
            [['ingredients_id', 'provider_id'], 'integer'],
            [['cost'], 'number'],
            [['comment'], 'string', 'max' => 255],
            [['ingredients_id', 'provider_id'], 'unique', 'targetAttribute' => ['ingredients_id', 'provider_id']],
            [['ingredients_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredients_id' => 'id']],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ingredients_id' => 'Ингредиент',
            'provider_id' => 'Поставщик',
            'cost' => 'Цена',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredients_id']);
    }

    /**
     * Gets query for [[Provider]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::className(), ['ingredients_has_provider_ingredients_id' => 'ingredients_id', 'ingredients_has_provider_provider_id' => 'provider_id']);
    }
}
