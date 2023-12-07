<?php

use backend\models\Gallery;
use backend\models\Article;
use backend\models\Slider;
use backend\models\VisitorLog;
use miloschuman\highcharts\Highcharts;

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
\yii\web\YiiAsset::register($this);

/* @var $this yii\web\View */

$this->title = 'St Gabriel Apps';
$this->params['page_title'] = 'Dashboard';
$this->params['page_desc'] = 'St Gabriel University';
$this->params['title_card'] = 'Information';

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                    <h3><?= Yii::$app->formatter->asInteger(Slider::getCount()); ?></h3>
                    <p>Banner Total</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= Yii::$app->formatter->asInteger(Article::getCount()); ?><sup style="font-size: 20px"></sup></h3>
                        <p>Article Total</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                    <h3><?= Yii::$app->formatter->asInteger(Gallery::getCount()); ?></h3>
                    <p>Gallery Total</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?= Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Count by operating system'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Total',
                            'data' => VisitorLog::getGrafikTotalOs(),
                            ],
                        ],
                        ],
                ]); ?>
            </div>
            <div class="col-sm-6">
                <?= Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Count by browser'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Total',
                            'data' => VisitorLog::getGrafikTotalBrowser(),
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?= Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Count by country'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Total',
                            'data' => VisitorLog::getGrafikTotalGeoLocation(),
                            ],
                        ],
                    ],
                ]); ?>
            </div>
            <div class="col-sm-6">
                <?= Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Count by language'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Total',
                            'data' => VisitorLog::getGrafikTotalLanguage(),
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5>Count Visitor By Page</h5>
                <div class="table-responsive table-nowrap">
                    <table class="table table-bordered table-nowrap table-visit-count-ip-url">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>IP Address</th>
                                <th>Page</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $visitCounts = VisitorLog::getVisitCountByIpAndUrl();
                                    $no = 1;
                                    foreach ($visitCounts as $data):
                                ?>
                                <tr>
                                    <td>
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $data['ip_address']; ?>
                                    </td>
                                    <td><?= $data['visit_url']; ?></td>
                                    <td><?= $data['visit_count']; ?> kali</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
        <div class="col-md-12">
                <h5>Summary Count Visitor</h5>
                <div class="table-responsive table-nowrap">
                    <table class="table table-bordered table-nowrap">
                        <?php
                            $countToday = VisitorLog::getCountByDate(date('Y-m-d'));
                            $countYesterday = VisitorLog::getCountByDate(date('Y-m-d', strtotime('-1 day')));
                            $countThisWeek = VisitorLog::getCountByWeek();
                            $countThisMonth = VisitorLog::getCountByMonth();
                            $countLastMonth = VisitorLog::getCountByLastMonth();
                            $countTotal = VisitorLog::getTotalCount();                    
                        ?>
                        <tbody>
                            <tr>
                                <td><strong>Today :</strong></td>
                                <td>
                                    <?= $countToday ?>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Yesterday :</strong></td>
                                <td>
                                    <?= $countYesterday ?>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>This week :</strong></td>
                                <td>
                                    <?= $countThisWeek ?>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>This month :</strong></td>
                                <td>
                                    <?= $countThisMonth ?>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Last month :</strong></td>
                                <td>
                                    <?= $countLastMonth ?>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Total :</strong></td>
                                <td>
                                    <?= $countTotal ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$js = <<< JS
var t = $('.table-visit-count-ip-url').DataTable({
    "order": [[ 0, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();
JS;

$css = <<< CSS

CSS;

$this->registerJs($js);
$this->registerCss($css);

?>
