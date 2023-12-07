<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VisitorLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitor-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'unique_visitor_identifier') ?>

    <?= $form->field($model, 'os') ?>

    <?= $form->field($model, 'browser') ?>

    <?= $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'geo_location') ?>

    <?php // echo $form->field($model, 'cookies') ?>

    <?php // echo $form->field($model, 'visit_time') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'referrer') ?>

    <?php // echo $form->field($model, 'visit_url') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
