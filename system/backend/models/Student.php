<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $student_category_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_category_id', 'content', 'created_by', 'updated_by'], 'required'],
            [['student_category_id', 'created_by', 'updated_by'], 'integer'],
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
            'id' => Yii::t('backend', 'ID'),
            'student_category_id' => Yii::t('backend', 'Student Category ID'),
            'content' => Yii::t('backend', 'Content'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'timestamp' => Yii::t('backend', 'Timestamp'),
        ];
    }
}
