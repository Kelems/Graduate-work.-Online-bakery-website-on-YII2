<?php
namespace app\models;

use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Html;
//use yii2mod\cashier\Billable;
use Yii;

class User extends ActiveRecord implements IdentityInterface{

//  use Billable;
  /*
  public $id;
  public $role_id;
  public $auth_key;
  public $name;
  public $email;
  public $phone;
  public $password;
  public $address;
  public $created_at;
  public $total_of_all_order;
  public $secret_question;
  public $unswer;
  */


  const ROLE_USER = 1;
  const ROLE_ADMIN = 2;

  public $rememberMe = true;
  public $_user = false;

  public static function tableName()
    {
      return 'user';
    }

  function rules(){
    return [
      [['email','phone','password',], 'required', 'on' => 'registration'],
      [['id','auth_key','role_id','name','address','created_at','total_of_all_order', 'secret_question', 'answer'], 'safe','on' => 'registration'],

      [['id','role_id', 'total_of_all_order'], 'integer'],
      [['email','auth_key', 'password', 'name', 'address'], 'string', 'max' => 255],
      [['phone'], 'string', 'max' => 20],
      [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
    ];
  }
 /*
  public function sendCongrimilationLink(){
    $congrimilationLinkURL = URL::to(['site/confirmemail','email' => $this->email, $this->code])
  }
*/
  public function attributeLabels(){
    return [
      'email' => 'Email',
      'password' => 'Пароль',
      'phone' => 'Номер телефона',

      'secret_question' => 'Секретный вопрос',
      'answer' => 'Ответ',

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
      public function getOrders(){
          return $this->hasMany(Order::className(), ['user_id' => 'id']);
      }


    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */

     /*
      public function getRole(){
          return $this->hasOne(Role::className(), ['id' => 'role_id']);
      }
    */

    public static function findIdentity($id){
      return static ::findOne($id);
    }

    public static function findByUsername($email){
      return static ::findOne(['email' => $email]);
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getId(){
      return $this->id;
    }

    public function getAuthKey(){
      return $this->auth_key;
    }

    public function validateAuthKey($authKey){
      return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function generateAuthKey(){
      $this->auth_key = Yii::$app->security->generateRandomString();
    }


public function getUser(){
    if ($this->_user === false) {
        $this->_user = User::findByUsername($this->name);
    }
    return $this->_user;
}

    public function login()
    {
        if ($this->validate()) {
          if ($this->rememberMe)
          {
            $user = $this->getUser();
            $user->generateAuthKey();
            $user->save();
          }
          return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
/*
    public function getProfile($id) {
      return self::find()->where(['id' => $id])->asArray()->one();
    }
*/
}
