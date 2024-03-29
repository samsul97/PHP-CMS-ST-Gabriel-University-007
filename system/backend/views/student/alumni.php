<?php

use yii\helpers\Html;
use kartik\editors\Summernote;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutUs */

$this->title = Yii::t('backend', 'Alumni');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Alumni'), 'url' => ['Alumni']];
$this->params['breadcrumbs'][] = $this->title;

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
			<div class="student-alumni">
                <?php $form = ActiveForm::begin(); ?>

                <div class="col-md-12">
                    <?= $form->field($model, 'content')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                        // other widget settings
                        'options' => ['placeholder' => 'Edit your blog content here...']
                    ]); ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('backend', 'save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>