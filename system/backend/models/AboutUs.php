<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "about_us".
 *
 * @property int $id
 * @property int $about_category_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class AboutUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_category_id', 'content', 'created_by', 'updated_by'], 'required'],
            [['about_category_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
            [['content'], 'string'],
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
            'about_category_id' => Yii::t('backend', 'About Category ID'),
            'content' => Yii::t('backend', 'Content'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
