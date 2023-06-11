<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
    public function rules()  {
        return [
            [['user_id', 'name', 'email', 'phone', 'pickup'], 'required'],
            [['user_id', 'order_status', 'pickup'], 'integer'],
            [['cost'], 'number'],
/*
            [
              'phone',
              'match',
              'pattern' => '~^\+7\s\[0-9]{10}$~',
              'message' => 'Введите номер телефона для связи +7 1234567890'
            ],
*/
            [['date_order', 'date_status','date_order', 'comment','address', 'date_status', 'time_delivery', 'city', 'city_cost'], 'safe'],
            [['name', 'email', 'address', 'comment'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

  public function behaviors(){
    return [
      [
        'class' => TimestampBehavior::class,
        'attributes' => [
        // при вставке новой записи присвоить атрибутам created и updated значение метки времени UNIX
          ActiveRecord::EVENT_BEFORE_INSERT => ['date_order', 'date_status'],
          // при обновлении существующей записи  присвоить атрибуту updated значение метки времени UNIX
          ActiveRecord::EVENT_BEFORE_UPDATE => ['date_status'],
        ],
        // если вместо метки времени UNIX используется DATETIME
        'value' => new Expression('NOW()'),
      ],
    ];
  }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес доставки',
            'comment' => 'Комментарий к заказу',
            'cost' => 'Итоговая цена',
            'date_order' => 'Дата заказа',
            'order_status' => 'Статус заказа',
            'date_status' => 'Время обновления заказа',
            'pickup' => 'Самовывоз?',
            'city' => 'Город доставки',
            'city_cost' => 'Стоимость доставки',
            'time_delivery' => 'Часы приема доставки',
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

    public function addItems($basket) {
      // получаем товары в корзине
      $products = $basket['products'];
      // добавляем товары по одному
      foreach ($products as $product_id => $product) {
        $item = new OrderItem();
        $item->order_id = $this->id;
        $item->product_id = $product_id;
        $item->count = $product['count'];
//        $item->name = $product['name'];
        $item->price = $product['price'];
        $item->cost = $product['price'] * $product['count'];
        $item->insert();
      }
    }

}
