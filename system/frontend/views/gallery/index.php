<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Gallery'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gallery_category_id',
            'image',
            'created_at',
            'updated_at',
            //'created_by',
            //'updated_by',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
