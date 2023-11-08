<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $banner
 * @property string $small_title
 * @property string $big_title
 * @property string $content
 * @property string $timestamp
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['small_title', 'big_title', 'content'], 'required'],
            [['timestamp'], 'safe'],
            [['small_title', 'big_title', 'content'], 'string', 'max' => 255],
            [['banner'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'banner' => Yii::t('backend', 'Banner'),
            'small_title' => Yii::t('backend', 'Small Title'),
            'big_title' => Yii::t('backend', 'Big Title'),
            'content' => Yii::t('backend', 'Content'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }

    public static function getCount()
    {
        return static::find()->count();
    }
}
