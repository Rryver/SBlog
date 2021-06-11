<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * Class Post
 * @package app\models
 *
 * This is table for class 'post'
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 *
 *
 * @property Comment[] $comments
 */
class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID автора',
            'title' => 'Заголовок статьи',
            'content' => 'Текст статьи',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required', 'message' => 'Это поле должно быть заполнено'],
            [['title', 'content'], 'string'],
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

    public static function getPostById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function getPostTitleById($id)
    {
        return static::findOne(['id' => $id])->title;
    }

    public static function getAll()
    {
        return static::find()->all();
    }

    public static function getAllOrderByIdDESC()
    {
        return static::find()
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public static function getAllOrderByDateDESC()
    {
        return static::find()
            ->orderBy(['updated_at' => SORT_DESC])
            ->all();
    }

    public function getShortTextOfContent() {
        return substr($this->content, 0, 400);
    }
}