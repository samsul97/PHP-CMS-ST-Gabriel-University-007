<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "testimonys".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class Testimonys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testimonys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('backend', 'Name'),
            'image' => Yii::t('backend', 'Image'),
            'content' => Yii::t('backend', 'Content'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
