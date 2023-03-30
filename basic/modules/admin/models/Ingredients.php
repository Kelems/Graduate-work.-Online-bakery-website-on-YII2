<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $name Название Ингредиента
 * @property string|null $shelf_life Сколько может хранится вид этого Ингредиента
 * @property int $amount Сколько хранится
 * @property string $unit_of_measurement единица измерения
 *
 * @property IngredientsHasProvider[] $ingredientsHasProviders
 * @property Provider[] $providers
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'unit_of_measurement'], 'required'],
            [['amount'], 'integer'],
            [['name', 'unit_of_measurement'], 'string', 'max' => 255],
            [['shelf_life'], 'string', 'max' => 30],
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
            'shelf_life' => 'Срок годности',
            'amount' => 'Сколько на складе',
            'unit_of_measurement' => 'Единица измерения',
        ];
    }

    /**
     * Gets query for [[IngredientsHasProviders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientsHasProviders()
    {
        return $this->hasMany(IngredientsHasProvider::className(), ['ingredients_id' => 'id']);
    }

    /**
     * Gets query for [[Providers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProviders()
    {
        return $this->hasMany(Provider::className(), ['id' => 'provider_id'])->viaTable('ingredients_has_provider', ['ingredients_id' => 'id']);
    }
}
