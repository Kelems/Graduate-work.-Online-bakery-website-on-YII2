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
class CommentForm extends \yii\db\ActiveRecord
{

        public static function tableName()
    {
        return 'comment';
    }
    public $Comment;

    public function rules()
    {
        return [
            [['message'], 'required'],
            [['message'], 'string', 'max' => 255]
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

  public function saveComment($product_id){
    $comment = new Comment;
    $comment->message = $this->message;
    $comment->user_id = Yii::$app->user->id;
    $comment->product_id = $product_id;
    return $comment->save();
  }


}
