<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Partners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]) ?>

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
