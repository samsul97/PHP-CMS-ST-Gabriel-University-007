<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Sliders');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="slider-index">
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

        <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Petunjuk Resolusi Gambar</h3>
                    </div>
                    <center>
                        <div class="card-body">
                            <label for="exampleInputEmail1">
                                <div> Resolusi Gambar : </div>
                                </br> Untuk Banner Gunakan Resolusi 1400px x 800px </br> 
                                </br> Untuk memastikan kompatibilitas, hindari penggunaan spasi, tanda kurung, simbol, atau karakter khusus lainnya dalam nama file. </br>
                                Sebagai contoh, gunakan format nama seperti <p style="color:blue">"ATHE_Award.png" atau "athenew.png"</p> 
                            </label>
                        </div>
                    </center>
                    <!-- /.card-body -->
                </div>
			</div>

            <p>
                <?= Html::a(Yii::t('backend', 'Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
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

                        [
                            'attribute' => 'banner',
                            'format' => 'raw',
                            'contentOptions' => ['style' => 'text-align:center'],
                            'headerOptions' => ['style' => 'text-align:center', 'width' => '20'],
                            'value' => function ($model)
                            {
                                $image = $model['banner'] && is_file(Yii::getAlias('@webroot') . $model['banner']) ? $model['banner'] : '../images/no_photo.jpg';
                                return Html::img(Url::base().$image, ['style'=>'height:70px', 'width:100%;']);
                            },   
                        ],
                        'small_title',
                        'big_title',
                        'content',
                        //'timestamp',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                    ['view', 'id' => $model['id']], 
                                    ['title' => 'View']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                    ['update', 'id' => $model['id']], 
                                    ['title' => 'Update']);
                            },
                            'delete' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                    ['delete', 'id' => $model['id']], 
                                    ['title' => 'Delete',
                                     'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                     'data-method'  => 'post']);
                                }
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