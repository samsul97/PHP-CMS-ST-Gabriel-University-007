<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student_category".
 *
 * @property int $id
 * @property string $name
 * @property string $timestamp
 */
class StudentCategory extends \yii\db\ActiveRecord
{
    const WHY = 1;
    const SCS = 2;
    const ALUMNI = 3;
    const PASTORAL = 4;
    const HANDBOOK = 5;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_category';
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
