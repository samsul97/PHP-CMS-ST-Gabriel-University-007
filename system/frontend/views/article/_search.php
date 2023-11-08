<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'article_category_id') ?>

    <?php // $form->field($model, 'title') ?>

    <?php // $form->field($model, 'image') ?>

    <?php // $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <?= $form->field($model, 'globalSearch') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
