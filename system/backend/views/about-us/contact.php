<?php

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$image = $model['logo'] && is_file(Yii::getAlias('@webroot') . $model['logo']) ? $existingLogo : '../images/no_photo.jpg';

?>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="contact">
                
                <div class="col-md-12">
					<div class="card card-primary">
					    <div class="card-header">
						    <h3 class="card-title">Petunjuk Resolusi Gambar</h3>
					    </div>
                        <center>
                            <div class="card-body">
                                <label for="exampleInputEmail1">
                                    <div> Width = Panjang </br> Height = Lebar </br>Resolusi = W x H </div>
                                    </br> Untuk Logo Gunakan Resolusi 430px x 400px
                                </label>
                            </div>
                        </center>
						<!-- /.card-body -->
					</div>
				</div>
                
                <div class="contact-form">

                    <?php $form = ActiveForm::begin([
                        'options'=>[
                            'enctype'=>'multipart/form-data'
                        ]
                    ]); ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'whatsaap')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'youtube_api')->textarea(['maxlength' => false, 'rows' => 6, 'cols' => 6]) ?>

                    <?= $form->field($model, 'maps')->textarea(['maxlength' => false, 'rows' => 6, 'cols' => 6]) ?>
                    

                    <?= $form->field($model, 'our_culture')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                        // other widget settings
                        'options' => ['placeholder' => 'Edit your blog content here...']
                    ]); ?>

                    <?php if (!$model->isNewRecord): ?>
                    
                    <?php
                        $img = [];

                        if (!empty($model->logo)) {
                            $img[] = Html::img(Url::base(). $image, ['style'=>'height:60%', 'width:80%;']);
                        }
                    ?>

                    

                    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                        'model' => $model->logo,
                        'attribute' => 'logo',
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'initialPreview' => $existingLogo ? $img : null,
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

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
			</div>
		</div>
	</div>
</div>