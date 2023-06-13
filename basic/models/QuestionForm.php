<?php

namespace app\models;

use Yii;
use yii\base\Model;


class QuestionForm extends Model
{
    public $email;    //почта
    public $secret_question; //вопрос
    public $answer;   //ответ
    public $rememberMe = true;

    private $_user = false; //поиск по почте



    public function rules()
    {
          return [
            [['email'], 'required'],
            [['answer'], 'safe'],
            ['rememberMe', 'boolean'],
            [['email'], 'validateUser'],
            [['answer'], 'validateAnswer'],
          ];
    }


    //находим пользователя по введенной почте
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }

    // проверяем есть ли такой пользователь в базе
    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (empty($user->email)) {
                $this->addError($attribute, 'Такого пользователя нет в системе.');
            }
        }
    }

    // Validates the password. This method serves as the inline validation for password.
    public function validateAnswer($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !($user->answer == $this->answer)) {
                $this->addError($attribute, 'Неправильный ответ.');
            }
        }
    }

    //вход в систему
    public function check()
    {
        if ($this->validate()) { // проверяет по rules
            return $model = $this->_user;
        }
        return false;
    }


        public function login()
    {
        if ($this->validate()) { // проверяет по rules
            if($this->rememberMe)
            {
                $myuser = $this->getUser();
                $myuser->generateAuthKey();
                $myuser->save();
            }

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            return $model = $this->_user;
        }
        return false;
    }



}
