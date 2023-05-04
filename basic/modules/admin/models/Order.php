<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id id заказа
 * @property int $user_id id пользователя
 * @property string $name Имя клиента на момент заказа фиксирующееся в нем
 * @property string $email mail клиента на момент заказа фиксирующийся в нем
 * @property string $phone номер телефона клиента на момент заказа фиксирующееся в нем
 * @property string $address место доставки клиенту на момент заказа фиксирующееся в нем
 * @property string $comment комментарий клиента
 * @property float $cost итоговая цена заказа
 * @property string $date_order Дата заказа
 * @property int $order_status Статус заказа 0 - Заказ добавлен 1 - Заказ принят к исполнению 2 - Заказ ожидает 3 - Заказ доставляется 4 - Заказ вручен клиенту
 * @property string $date_status дата обновления заказа
 * @property int $pickup самовывоз товаров. 1 - товар с самовывозом. 0 - доставка.
 *
 * @property OrderItem[] $orderItems
 * @property Product[] $products
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address', 'comment', 'date_order', 'date_status'], 'required'],
            [['user_id', 'order_status', 'pickup'], 'integer'],
            [['cost'], 'number'],
            [['date_order', 'date_status'], 'safe'],
            [['name', 'email', 'address', 'comment'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'name' => 'Название',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адресс',
            'comment' => 'Комментарий для заказа',
            'cost' => 'Цена',
            'date_order' => 'Дата заказа',
            'order_status' => 'Статус заказа',
            'date_status' => 'Время обновления заказа',
            'pickup' => 'Самовывоз?',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('order_item', ['order_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
