<?php

use backend\models\GalleryCategory;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */
/* @var $form yii\widgets\ActiveForm */

$select_type = ArrayHelper::map(GalleryCategory::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);

?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'gallery_category_id')->widget(Select2::classname(),[
            'data' => $select_type,
            'options' => [
                'placeholder' => 'Select Category',
                'value' => $model->isNewRecord ? 1 : $model->gallery_category_id,
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
    ?>

    <?php if (!$model->isNewRecord): ?>

        <?php
            $img = [];
            $image = $model['image'] && is_file(Yii::getAlias('@webroot') . $model['image']) ? $existingGallery : '../images/no_photo.jpg';

            if (!empty($model->image)) {
                $img[] = Html::img(Url::base(). $image, ['style'=>'height:60%', 'width:80%;']);
            }
        ?>

        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => $existingGallery ? $img : null,
                'showUpload' => false,
            ]
        ]) ?>
                
    <?php else : ?>
    
        <?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => 'true'],
        ]) ?>

    <?php endif; ?>

    <?php // $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <?php // $form->field($model, 'created_by')->textInput() ?>

    <?php // $form->field($model, 'updated_by')->textInput() ?>

    <?php // $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
