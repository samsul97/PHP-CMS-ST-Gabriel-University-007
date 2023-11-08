<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property string $code
 * @property string $email
 * @property string $address
 * @property string $logo
 * @property string $our_culture
 * @property string $phone1
 * @property string $phone2
 * @property string $maps
 * @property string $instagram
 * @property string $facebook
 * @property string $whatsaap
 * @property string $youtube
 * @property string $youtube_api
 * @property string $timestamp
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'email', 'address', 'our_culture', 'phone1', 'phone2', 'maps', 'instagram', 'facebook', 'whatsaap', 'youtube', 'youtube_api'], 'required'],
            [['our_culture'], 'string'],
            [['timestamp'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['email', 'address', 'phone1', 'phone2', 'instagram', 'facebook', 'whatsaap', 'youtube'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('backend', 'Code'),
            'email' => Yii::t('backend', 'Email'),
            'address' => Yii::t('backend', 'Address'),
            'logo' => Yii::t('backend', 'Logo'),
            'our_culture' => Yii::t('backend', 'Our Culture'),
            'phone1' => Yii::t('backend', 'Phone1'),
            'phone2' => Yii::t('backend', 'Phone2'),
            'maps' => Yii::t('backend', 'Maps'),
            'instagram' => Yii::t('backend', 'Instagram'),
            'facebook' => Yii::t('backend', 'Facebook'),
            'whatsaap' => Yii::t('backend', 'Whatsaap'),
            'youtube' => Yii::t('backend', 'Youtube'),
            'youtube_api' => Yii::t('backend', 'Youtube Api'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
