<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property int $id
 * @property float $percent процентное значение скидки, где 1 - это 100%, а 0 - 0%
 * @property int $required_value значение после которого пользователь начнет получать скидку
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['percent', 'required_value'], 'required'],
            [['percent'], 'number'],
            [['required_value'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id скидки',
            'percent' => 'Процент скидки',
            'required_value' => 'минимальная сумма скидки',
        ];
    }

    //вывод подходящей скидки
    public function getDisc($total){
        return self::find()
                    ->select('percent')
                    ->where(['<=','required_value', $total])
                    ->all();
    }



}
