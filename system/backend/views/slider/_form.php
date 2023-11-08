<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord): ?>
                        
        <?php
            $img = [];
            $image = $model['banner'] && is_file(Yii::getAlias('@webroot') . $model['banner']) ? $existingBanner : '../images/no_photo.jpg';

            if (!empty($model->banner)) {
                $img[] = Html::img(Url::base(). $image, ['style'=>'height:60%', 'width:80%;']);
            }
        ?>

        

        <?= $form->field($model, 'banner')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => $existingBanner ? $img : null,
                'showUpload' => false,
                // 'uploadAsync'=> true,
                // 'showRemove'=> false,
                // 'showCancel' => false,
                // 'overwriteInitial' => false,
                // 'previewFileType' => 'image',
                // 'showPreview' => false,
                // 'showCaption' => false,
                // 'initialPreviewConfig' => $json,
                // 'maxFileSize' => 3*1024*1024,
                // 'deleteUrl' => Url::to(['/file/delete-upload']),
                // 'allowedExtensions' => ['jpg','png','jpeg'],
            ]
        ]) ?>

    <?php else : ?>
            
            <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            ]) ?>

    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'small_title')->textInput(['maxlength' => true]) ?>
        
        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'big_title')->textInput(['maxlength' => true]) ?>
            
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['maxlength' => false, 'rows' => 6, 'cols' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
