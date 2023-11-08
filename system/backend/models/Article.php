<?php

namespace backend\models;

use Yii;
use backend\models\ArticleCategory;
use common\models\User;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $article_category_id
 * @property string $title
 * @property string $image
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_category_id', 'title', 'content', 'created_by', 'updated_by'], 'required'],
            [['article_category_id', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'article_category_id' => Yii::t('backend', 'Article Category ID'),
            'title' => Yii::t('backend', 'Title'),
            'image' => Yii::t('backend', 'Image'),
            'content' => Yii::t('backend', 'Content'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }

    public function getArticleType()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'article_category_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'article_category_id']);
    }

    public static function getCount()
    {
        return static::find()->count();
    }
}
