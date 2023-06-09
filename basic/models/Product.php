<?php

namespace app\models;
use yii\data\Pagination;
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

    public function getSale(){
      return self::find()->where(['>','old_price', 0])
                        ->limit(3)
                        ->asArray()
                        ->all();
    }

    public function getCategory(){
      return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getIngredienthasproducts()
    {
      return $this->hasMany(Ingredienthasproduct::className(), ['product_id' => 'id']);
    }

    public function getIngredientItems()
    {
      return $this->hasMany(Ingredient::className(),['id' => 'ingredient_id'])
            ->viaTable('ingredient_has_product', ['product_id' => 'id']);
    }

    public function getItems()
    {
      return $this->hasMany(Ingredient::className(),['id' => 'ingredient_id'])
            ->via('ingredienthasproducts');
    }

    public function getOrderItems()
    {
      return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    public function getOrders(){
      return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_item', ['product_id' => 'id']);
    }

    public function getProduct($id) {
        return self::find()->where(['id' => $id])->asArray()->one();
    }

    public function getComments(){
        return $this->hasMany(Comment::className(),['product_id' => 'id']);
    }

    public function getSearchResult($search, $page) {
        $search = $this->cleanSearchString($search);
        if (empty($search)) {
          return [null, null];
        }

        // пробуем извлечь данные из кеша
        $key = 'search-'.md5($search).'-page-'.$page;
        $data = Yii::$app->cache->get($key);

        if ($data === false) {
            // данных нет в кеше, получаем их заново
            $query = self::find()->where(['like', 'name', $search]);
            // постраничная навигация
            $pages = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => Yii::$app->params['pageSize'],
                'forcePageParam' => false,
                'pageSizeParam' => false
            ]);
            $products = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
            // сохраняем полученные данные в кеше
            $data = [$products, $pages];
            Yii::$app->cache->set($key, $data);
        }

        return $data;
    }

    /**
     * Вспомогательная функция, очищает строку поискового запроса с сайта
     * от всякого мусора
     */
    protected function cleanSearchString($search) {
        $search = iconv_substr($search, 0, 64);
        // удаляем все, кроме букв и цифр
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        // сжимаем двойные пробелы
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);
        return $search;
    }


}
