<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * Class Comment
 * @package app\models
 *
 * $this is clas for table 'comment'
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $username
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return 'comment';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Автор',
            'text' => 'Коментарий',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        ];
    }

    public function rules()
    {
        return [
            [['username', 'text'], 'required', 'message' => 'Это поле должно быть заполнено'],

            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 100],

            ['text', 'string', 'min' => 5, 'max' => 500],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getCommentsByPostId($postId = null) {
        return static::find()
            ->where(['post_id' => $postId])
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public static function getCommentById($id = null) {
        if ($id != null) {
            return static::findOne(['id' => $id]);
        }
    }
}