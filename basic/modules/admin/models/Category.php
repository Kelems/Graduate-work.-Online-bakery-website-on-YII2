<?php

namespace app\modules\admin\models;

use Yii;
/**
 * This is the model class for table "category".
 *
 * @property int $id ID категории в таблице категорий
 * @property string $name название категории
 * @property string|null $description описание категории
 * @property string|null $image место хранения изображения категории
 *
 * @property Product[] $products
 */

class Category extends \yii\db\ActiveRecord
{
    public static function tableName(){
        return 'category';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['description', 'image'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'image' => 'Путь к фото',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function getCategory($id)
    {
        return $this->hasOne($id);
    }

}
