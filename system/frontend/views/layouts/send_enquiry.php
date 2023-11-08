<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['action' => ['site/send-enquiry']]); ?>

<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
<?= $form->field($model, 'subject')->textInput() ?>
<?= $form->field($model, 'message')->textarea() ?>

<div class="form-group">
	<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'background-color:#800000']) ?>
</div>

<?php ActiveForm::end(); ?>