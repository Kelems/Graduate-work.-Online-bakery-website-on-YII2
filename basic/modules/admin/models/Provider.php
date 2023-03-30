<?php
namespace app\modules\admin\models;
use Yii;
/**
 * This is the model class for table "provider".
 *
 * @property int $id id поставщика
 * @property string $name_provider Название поставщика
 * @property string|null $phone_number Номер для связи
 * @property string|null $email Почта для связи
 * @property string|null $comment комментарий о поставщике
 *
 * @property Ingredients[] $ingredients
 * @property IngredientsHasProvider[] $ingredientsHasProviders
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provider';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_provider'], 'required'],
            [['name_provider', 'email', 'comment'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 18],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_provider' => 'Название',
            'phone_number' => 'Рабочий телефон',
            'email' => 'Рабочая почта',
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
        return $this->hasMany(Ingredients::className(), ['id' => 'ingredients_id'])->viaTable('ingredients_has_provider', ['provider_id' => 'id']);
    }
    /**
     * Gets query for [[IngredientsHasProviders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientsHasProviders()
    {
        return $this->hasMany(IngredientsHasProvider::className(), ['provider_id' => 'id']);
    }
}
