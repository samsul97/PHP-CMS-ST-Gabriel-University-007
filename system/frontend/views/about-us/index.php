<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AboutUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'About uses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-us-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create About Us'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'about_category_id',
            'content:ntext',
            'created_at',
            'updated_at',
            //'created_by',
            //'updated_by',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
