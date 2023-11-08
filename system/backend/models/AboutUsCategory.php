<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "about_us_category".
 *
 * @property int $id
 * @property string $name
 * @property string $timestamp
 */
class AboutUsCategory extends \yii\db\ActiveRecord
{

    const PROFILE = 1;
    const MANAGEMENT = 2;
    const LECTURER = 3;
    const CEO_MESSAGES = 4;
    const PROGRAMS = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_us_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'timestamp'], 'required'],
            [['timestamp'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
