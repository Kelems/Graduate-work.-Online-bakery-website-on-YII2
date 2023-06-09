<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $product_id id комментируемого продукта
 * @property int $user_id id комментирующего пользователя
 * @property string $message содержимое комментария
 * @property string|null $date_message
 *
 * @property Product $product
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'message'], 'required'],
            [['product_id', 'user_id'], 'integer'],
            [['date_message'], 'safe'],
            [['message'], 'string', 'max' => 255],
            [['product_id', 'user_id'], 'unique', 'targetAttribute' => ['product_id', 'user_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Продукт',
            'user_id' => 'Пользователь',
            'message' => 'Комментарий',
            'date_message' => 'Дата комментария',
        ];
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCommentuser($user_id, $product_id){
        $query = Comment::find()
        ->where(['=', 'user_id', $user_id])
        ->andWhere(['=', 'product_id', $product_id])
        ->all();
        return $query;
    } 
}
