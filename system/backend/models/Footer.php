<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "footer".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $timestamp
 */
class Footer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'footer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['timestamp'], 'safe'],
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
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
