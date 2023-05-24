<?php
namespace app\models;


use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $order_id id заказа по таблице заказа для заказа
 * @property int $product_id id продукта по таблице продуктов для заказа
 * @property int $count количество товара для заказа
 * @property float $price цена товара на момент заказа
 * @property float $cost итоговая цена товара в заказе
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'price', 'cost'], 'required'],
            [['order_id', 'product_id', 'count'], 'integer'],
            [['price', 'cost'], 'number'],
            [['order_id', 'product_id'], 'unique', 'targetAttribute' => ['order_id', 'product_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'ID заказа',
            'product_id' => 'ID продукции',
            'count' => 'Количество',
            'price' => 'Цена',
            'cost' => 'Цена всего',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    

}
