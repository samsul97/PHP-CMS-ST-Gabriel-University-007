<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Seo */
/* @var $form yii\widgets\ActiveForm */

/* ------------------------------- FRONTEND CONTROLLERS ------------------------------- */

$frontend_fulllist = [];
$frontend_fulllist2 = [];
$frontend_controllerlist = [];

if ($frontend_handle = opendir(Yii::getAlias('@frontend/controllers')))
{
    while (false !== ($frontend_file = readdir($frontend_handle))) 
    {
        if ($frontend_file != "." && $frontend_file != ".." && substr($frontend_file, strrpos($frontend_file, '.') - 10) == 'Controller.php') 
        {
            $frontend_controllerlist[] = $frontend_file;
        }
    }

    closedir($frontend_handle);
}

asort($frontend_controllerlist);

foreach ($frontend_controllerlist as $frontend_controller)
{
    $frontend_handle = fopen(Yii::getAlias('@frontend/controllers') . '/' . $frontend_controller, "r");

    if ($frontend_handle) 
    {
        while (($frontend_line = fgets($frontend_handle)) !== false) 
        {
            if (preg_match('/public function action(.*?)\(/', $frontend_line, $frontend_action))
            {
                if (strlen($frontend_action[1]) > 2)
                {
                    $frontend_controller_fix = preg_replace('/Controller.php/', '', $frontend_controller);
                    $frontend_controller_divide = preg_split('/(?=[A-Z])/', $frontend_controller_fix, -1, PREG_SPLIT_NO_EMPTY);
                    $frontend_controller_lowletter = strtolower(implode('-', $frontend_controller_divide));
                    $frontend_action_divide = preg_split('/(?=[A-Z])/', trim($frontend_action[1]), -1, PREG_SPLIT_NO_EMPTY);
                    $frontend_action_lowletter = strtolower(implode('-', $frontend_action_divide));
                    $frontend_fulllist[] = ['key' => $frontend_controller_lowletter, 'val' => $frontend_action_lowletter];
                    $frontend_fulllist2[$frontend_controller_lowletter][] = $frontend_action_lowletter;
                }
            }
        }
    }

    fclose($frontend_handle);
}

?>

<div class="seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'controller')->widget(Select2::classname(),[
                    'data' => ArrayHelper::map($frontend_fulllist, 'key', 'key'),
                    'options' => [
                        'placeholder' => 'Select Controller',
                        'value' => $model->isNewRecord ? 'L' : $model->controller,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'view')->widget(Select2::classname(),[
                    'data' => $model->isNewRecord ? null : [$model->view => $model->view],
                    'options' => [
                        'placeholder' => 'Select View',
                        'value' => $model->isNewRecord ? null : $model->view,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Enter a concise and descriptive title for the page']) ?>
        
            <?= $form->field($model, 'keywords')->textarea([
                'rows' => 6, 
                'placeholder' => 'Enter keywords or phrases separated by commas that represent the main topics of your content.' . PHP_EOL . PHP_EOL . 'Example: technology, innovation, gadgets', 
                'class' => 'form-control auto-resize-textarea'
            ]) ?>
        
            <?= $form->field($model, 'description')->textarea([
                'rows' => 6, 
                'placeholder' => 'Provide a brief and informative description of the page content. This will be displayed in search engine results.' . PHP_EOL . PHP_EOL . 'Example: Explore the latest in technology and innovation with our cutting-edge gadgets', 
                'class' => 'form-control auto-resize-textarea'
            ]) ?>
        
            <?= $form->field($model, 'canonical')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter the canonical URL of this page (e.g., https://www.example.com/page)'
            ]) ?>

            <?= $form->field($model, 'heading_1')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>
        
            <?= $form->field($model, 'heading_2')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>
        
            <?= $form->field($model, 'heading_3')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>
        
            <?= $form->field($model, 'heading_4')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>
        
            <?= $form->field($model, 'heading_5')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>
        
            <?= $form->field($model, 'heading_6')->textInput(['maxlength' => true, 'placeholder' => 'Optional']) ?>

            <?= $form->field($model, 'robots')->textInput([
                'maxlength' => true,
                'placeholder' => 'Specify directives for search engine robots (e.g., "index, follow" or "noindex, nofollow")'
            ])
            ->hint('For more information, refer to the <a href="https://developers.google.com/search/docs/crawling-indexing/robots-meta-tag" target="_blank">Robots Meta Tag documentation</a>.') ?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'schema_properties')->textarea([
                'rows' => 57, 
                'placeholder' => 'Enter structured data properties using Schema.org vocabulary to enhance search engine understanding.'
            ]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$list_search2  = json_encode($frontend_fulllist2);
$list_frontend = json_encode(ArrayHelper::map($frontend_fulllist, 'key', 'key'));
$urlCheckExistence = Url::to(['seo/check-existence']);

$js = <<< JS
$('#seo-controller').on('change', function(e) {
	var data = '$list_search2';
	var controllerVal = this.value;
	what = JSON.parse(data);
	html = '<option></option>';
	$.each(what[controllerVal], function(i, val) {
		html+= '<option value="' + val.toString().toLowerCase() + '">' + val.toString().toLowerCase() + '</option>';
	});
	$("#seo-view").html(html);

    $('#seo-view').on('change', function(e) {
        let viewVal = this.value;

        $.ajax({
            url: '$urlCheckExistence',
            method: 'POST',
            data: {
                controller: controllerVal,
                view: viewVal
            },
            success: function(response) {
                if (response.exists) {
                    // Data exists, autofill the form
                    $("#seo-title").val(response.data.title);
                    $("#seo-keywords").val(response.data.keywords);
                    $("#seo-description").val(response.data.description);
                    $("#seo-canonical").val(response.data.canonical);
                    $("#seo-heading_1").val(response.data.heading_1);
                    $("#seo-heading_2").val(response.data.heading_2);
                    $("#seo-heading_3").val(response.data.heading_3);
                    $("#seo-heading_4").val(response.data.heading_4);
                    $("#seo-heading_5").val(response.data.heading_5);
                    $("#seo-heading_6").val(response.data.heading_6);
                    $("#seo-robots").val(response.data.robots);
                    $("#seo-schema_properties").val(response.data.schema_properties);
                } else {
                    // Data doesn't exist, leave the form fields as they are
                    $("#seo-title").val('');
                    $("#seo-keywords").val('');
                    $("#seo-description").val('');
                    $("#seo-canonical").val('');
                    $("#seo-heading_1").val('');
                    $("#seo-heading_2").val('');
                    $("#seo-heading_3").val('');
                    $("#seo-heading_4").val('');
                    $("#seo-heading_5").val('');
                    $("#seo-heading_6").val('');
                    $("#seo-robots").val('');
                    $("#seo-schema_properties").val('');
                }
            },
            error: function(error) {
                console.error('Error checking data existence:', error);
            }
        });
    });
});

// auto resize textarea
const tx = document.getElementsByClassName("auto-resize-textarea");
for (let i = 0; i < tx.length; i++) {
    tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
    tx[i].addEventListener("input", OnInput, false);
}

function OnInput() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
}
JS;

$this->registerJs($js);
