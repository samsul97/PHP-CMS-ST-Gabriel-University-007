<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'seo');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="seo-index">
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

        <p>
            <?= Html::a(Yii::t('app', 'create_or_update_seo'), ['create-update'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="table-responsive table-nowrap">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last'
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],

                    'controller',
                    'view',
                    'canonical',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{detail}',
                        'buttons' => [
                            'detail' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                    ['detail', 'id' => $model['id']], 
                                    ['title' => 'Detail', 'class' => 'seo-detail', 'data' => 
                                    ['method' => 'post', 'data-pjax' => '0']
                                ]);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</div>


<?php
$js = <<< JS
$(".seo-detail").on("click", function(e) {
    e.preventDefault();
    url = $(this).attr('href');
    console.log(url);
    $('#seoDetail')
        .modal('show')
        .find('.modal-body')
        .html('Loading ...')
        .load(url);
        return false;
});
JS;

$this->registerJs($js);

Modal::begin([
    'id' => 'seoDetail',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Detail SEO',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    'clientOptions' => [
        'backdrop' => false, 'keyboard' => true
    ]
]);

Modal::end();