<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "about_us".
 *
 * @property int $id
 * @property int $about_category_id
 * @property string|null $content
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
            [['about_category_id', 'created_by', 'updated_by'], 'required'],
            [['about_category_id', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'about_category_id' => Yii::t('frontend', 'About Category ID'),
            'content' => Yii::t('frontend', 'Content'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'timestamp' => Yii::t('frontend', 'Timestamp'),
        ];
    }
}
