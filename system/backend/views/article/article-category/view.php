<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Article Categories'), 'url' => ['article-index-category']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-category-view">


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
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'name',
                    'timestamp',
                ],
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
