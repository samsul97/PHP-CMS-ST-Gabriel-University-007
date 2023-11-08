<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int $gallery_category_id
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class Gallery extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_category_id', 'name', 'created_by', 'updated_by'], 'required'],
            [['gallery_category_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'maxFiles' => 6, 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'gallery_category_id' => Yii::t('backend', 'Gallery Category ID'),
            'image' => Yii::t('backend', 'Image'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }

    public static function getCount()
    {
        return static::find()->count();
    }

    public function getGalleryCategory()
    {
        return $this->hasOne(GalleryCategory::class, ['id' => 'gallery_category_id']);
    }
}
