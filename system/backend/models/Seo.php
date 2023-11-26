<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string|null $controller
 * @property string|null $view
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $canonical
 * @property string|null $heading_1
 * @property string|null $heading_2
 * @property string|null $heading_3
 * @property string|null $heading_4
 * @property string|null $heading_5
 * @property string|null $heading_6
 * @property string|null $robots
 * @property string|null $schema_properties
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $timestamp
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keywords', 'description', 'schema_properties'], 'string'],
            [['created_at', 'updated_at', 'timestamp'], 'safe'],
            [[
                'created_by', 'updated_by', 'controller', 'view', 'title', 'keywords', 'description', 'canonical', 'robots',
            ], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['controller', 'view', 'title', 'canonical', 'heading_1', 'heading_2', 'heading_3', 'heading_4', 'heading_5', 'heading_6', 'robots'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'controller' => Yii::t('app', 'Controller'),
            'view' => Yii::t('app', 'View'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'canonical' => Yii::t('app', 'Canonical'),
            'heading_1' => Yii::t('app', 'Heading 1'),
            'heading_2' => Yii::t('app', 'Heading 2'),
            'heading_3' => Yii::t('app', 'Heading 3'),
            'heading_4' => Yii::t('app', 'Heading 4'),
            'heading_5' => Yii::t('app', 'Heading 5'),
            'heading_6' => Yii::t('app', 'Heading 6'),
            'robots' => Yii::t('app', 'Robots'),
            'schema_properties' => Yii::t('app', 'Schema Properties'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }

    public static function findByControllerAndView($controller, $view)
    {
        return self::findOne(['controller' => $controller, 'view' => $view]);
    }

    public static function updateOrCreate($attributes)
    {
        $model = self::findByControllerAndView($attributes['controller'], $attributes['view']);

        if ($model === null) {
            $model = new self();
        }

        $model->attributes = $attributes;

        return $model->save();
    }
}
