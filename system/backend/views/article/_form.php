<?php

use backend\models\ArticleCategory;
use kartik\editors\Summernote;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form yii\widgets\ActiveForm */

$select_category = ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_category_id')->widget(Select2::classname(),[
            'data' => $select_category,
            'options' => [
                'placeholder' => 'Select Category',
                'value' => $model->isNewRecord ? 1 : $model->article_category_id,
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]) ?>

    <?= $form->field($model, 'content')->widget(Summernote::class, [
            'useKrajeePresets' => true,
            // other widget settings
            'options' => [
                'placeholder' => 'Edit your article content here...',
                'id' => 'ysk-summernote',
            ]
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
