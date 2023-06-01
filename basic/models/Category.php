<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

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
class Category extends ActiveRecord
{
  public static function tableName(){
    return 'category';
  }

  public function rules(){
    return [
      [['name'], 'required'],
      [['name'], 'string', 'max' => 100],
      [['description', 'image'], 'string', 'max' => 255],
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'name' => 'Название',
      'description' => 'Описание',
      'image' => 'Путь к фото',
    ];
  }

  public function getProducts(){
    return $this->hasMany(Product::class, ['category_id' => 'id']);
  }

  public function getCategory($id) {
    return self::findOne($id);
  }

  public function getCategoryproduct($id) {
    $query = Product::find()->where(['in', 'category_id', $id]);
    $pages = new Pagination([
      'totalCount' => $query->count(),
      'pageSize' => 4,//Yii::$app->params['pageSize'],  // кол-во товаров на странице
      'forcePageParam' => false,
      'pageSizeParam' => false
    ]);
    $products = $query
      ->offset($pages->offset)
      ->limit($pages->limit)
      ->asArray()
      ->all();
    return [$products, $pages];
  }

  public function getSearchproducts($id, $search) {
    $query = Product::find()->where(['in', 'category_id', $id])
                            ->andWhere(['in', 'name', $search]);
    $pages = new Pagination([
      'totalCount' => $query->count(),
      'pageSize' => 4,//Yii::$app->params['pageSize'],  // кол-во товаров на странице
      'forcePageParam' => false,
      'pageSizeParam' => false
    ]);
    $products = $query
      ->offset($pages->offset)
      ->limit($pages->limit)
      ->asArray()
      ->all();
    return [$products, $pages];
  }

}
