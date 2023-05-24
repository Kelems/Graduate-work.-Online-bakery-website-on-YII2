<?php
namespace app\models;


use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id id пользователя
 * @property int $role_id id роли пользователя
 * @property string $email почта/логин
 * @property string $password Пароль пользователя
 * @property string $name информация как к человеку обращаться
 * @property string $phone номер телефона
 * @property string $address адрес проживания
 * @property string $created_at дата создания аккаунта
 * @property int|null $total_of_all_order сколько было потрачено по итогу пользователем на нашу продукцию
 *
 * @property Order[] $orders
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'phone', 'password', 'created_at'], 'required'],
            [['role_id', 'total_of_all_order'], 'integer'],
            [['created_at'], 'safe'],
            [['email', 'password', 'name', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'ID роли',
            'email' => 'Email',
            'password' => 'Пароль',
            'name' => 'Имя обращения',
            'phone' => 'Номер телефона',
            'address' => 'Адрес',
            'created_at' => 'Дата создания',
            'total_of_all_order' => 'Сколько было потрачено пользователем',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
