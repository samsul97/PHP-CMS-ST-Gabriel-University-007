<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gallery_category".
 *
 * @property int $id
 * @property string $name
 * @property string $cover
 * @property string $timestamp
 */
class GalleryCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['timestamp'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['cover'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
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
            'cover' => Yii::t('backend', 'Cover'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }

    public function getGallery()
    {
        return $this->hasMany(Gallery::class, ['gallery_category_id' => 'id']);
    }
}
