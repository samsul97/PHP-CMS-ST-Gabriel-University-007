<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VisitorLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitor-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unique_visitor_identifier')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'os')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_location')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cookies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visit_time')->textInput() ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visit_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
