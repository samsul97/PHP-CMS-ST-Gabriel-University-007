<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutUs */

$this->title = Yii::t('backend', 'Programs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Programs'), 'url' => ['programs']];
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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Petunjuk Resolusi Gambar</h3>
                    </div>
                    <center>
                        <div class="card-body">
                            <label for="exampleInputEmail1">
                                <div> Resolusi Gambar : </div>
                                </br> Min Width : 1800 px </br>
                                Height : Optional </br>
                                </br>
                            Ideal : 1800x1000</br> 
                            </label>
                        </div>
                    </center>
                    <!-- /.card-body -->
                </div>
			</div>
			<div class="about-us-profile">
                <?php $form = ActiveForm::begin(); ?>

                    <?php  $image = $model->image && is_file(Yii::getAlias('@webroot') . $model->image) ? $model->image : '/images/no_background.jpg'; ?>

                    <?= $form->field($model, 'image', [
                            'template' => '
                            {label}
                            <div id="preview">
                            <img id="img-preview" src="'. Url::base() . $image .'" alt="programs" />
                            </div>
                            {input}
                            {error}',
                        ])->fileInput(['accept' => 'image/*'])
                    ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('backend', 'save'), ['class' => 'btn btn-success']) ?>
                    </div>
                
                <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>


<?php

$js = <<< JS
$('#aboutus-image').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview').attr('src', '$image');
    }
}
JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 290px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);