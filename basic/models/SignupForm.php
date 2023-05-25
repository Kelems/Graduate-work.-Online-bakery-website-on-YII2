<?php

  namespace app\models;
  use yii\db\ActiveRecord;
//  use yii\base\Model;

  class SignupForm extends ActiveRecord{

    public function rules()
    {
        return [
            [['phone', 'email', 'password'], 'required', 'message' => 'Обязательно к заполнению'],
            [['role_id','created_at', 'total_of_all_order', 'created_at','name', 'address'], 'safe'],
            [['email', 'password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
        ];
    }
  }

 ?>
