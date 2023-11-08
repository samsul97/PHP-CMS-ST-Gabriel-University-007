<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */

$this->title = Yii::t('backend', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    <div class="card">
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
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</div>