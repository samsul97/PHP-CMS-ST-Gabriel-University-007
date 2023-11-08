<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $timestamp
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'email', 'subject', 'message'], 'required'],
            ['email', 'email'],
            [['message'], 'string'],
            [['timestamp'], 'safe'],
            [['name', 'email', 'subject'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'name' => Yii::t('frontend', 'Name'),
            'email' => Yii::t('frontend', 'Email'),
            'subject' => Yii::t('frontend', 'Subject'),
            'message' => Yii::t('frontend', 'Message'),
            'timestamp' => Yii::t('frontend', 'Timestamp'),
        ];
    }
}
