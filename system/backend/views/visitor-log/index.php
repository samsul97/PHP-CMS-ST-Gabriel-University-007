<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VisitorLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitor Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitor-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Visitor Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'unique_visitor_identifier:ntext',
            'os',
            'browser',
            'ip_address',
            //'geo_location:ntext',
            //'cookies',
            //'visit_time',
            //'language',
            //'referrer',
            //'visit_url:url',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
