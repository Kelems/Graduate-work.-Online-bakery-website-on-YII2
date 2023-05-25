<?php
namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord{

  public $id;
  public $role_id;
  public $name;
/*
  public $email;
  public $phone;
  public $password;
  */
  public $address;
  public $created_at;
  public $total_of_all_order;

  public static function tableName()
    {
      return 'user';
    }

  public function validatePassword($password){
      return $this->password === $password;
  }

  function rules(){
    return [
      [['email','phone','password',], 'required', 'on' => 'registration'],
      [['id','role_id', 'total_of_all_order'], 'integer'],
      [['id','role_id','name','address','created_at','total_of_all_order'], 'safe'],
      [['email', 'password', 'name', 'address'], 'string', 'max' => 255],
      [['phone'], 'string', 'max' => 20],
      [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
    ];
  }

  public function attributeLabels(){
    return [
      'email' => 'Email',
      'password' => 'Пароль',
      'phone' => 'Номер телефона',

      'name' => 'Ваше имя',
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
