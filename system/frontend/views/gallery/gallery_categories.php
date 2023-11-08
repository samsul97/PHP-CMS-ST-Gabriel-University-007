<?php

use yii\bootstrap4\LinkPager as Bootstrap4LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;


$this->title = 'List Gallery - ST Gabriel Pre University';
$this->params['breadcrumbs'][] = ['label' => 'List Gallery', 'url' => ['/gallery/gallery-categories']];
$this->params['breadcrumbs'][] = $this->title;

// seo page
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => '
        a level,
        athe,
        college,
        college in indonesia,
        college jakarta,
        fast track,
        ib diploma,
        indonesia college, 
        international college jakarta,
        international school di jakarta,
        international university indonesia,
        international university jakarta,
        jakarta international college,
        kuliah cepat ijazah international,
        kuliah di luar negeri,
        o level,
        ofqual accreditation,
        pathway,
        preuniversity,
        preuniversity indonesia,
        preuniversity jakarta,
        school of business,
        school of business jakarta,
        sekolah fast track,
        sekolah fast track program,
        sekolah pathway luar negeri,
        study abroad,
        study business management,
        study diploma fast track,
        study in australia,
        study in singapore,
        study in uk,
        distance learning',
], 'keywords');

// seo page description
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Welcome to gallery, I hope you enjoy seeing our activities.',
], 'description');
?>

<!-- Gallery section -->
<section class="about-section spad pt-0">
    <div class="container">
        <div class="section-title text-center">
            <h3>Gallery</h3>
            <h5>St. Gabriel's Pre-University Gallery</h5>
        </div>
        <div class="row">
            <?php foreach ($model->getModels() as $value) {?> 
                <div class="col-md-4 event-item">
                    <div class="event-thumb">
                        <?php $image = $value->cover && is_file(Yii::getAlias('@webroot') . '/backend' . $value->cover) ? $value->cover : ''; ?>
                        <?php $image = Url::base(). '/backend' . $image ?>
                        <?= Html::a("<img src='$image' alt='Gallery ST Gabriel Pre University'>", ['/gallery/gallery', 'id'=> $value->id], ['style'=> ""]) ?>
                        <div class="event-date">
                            <span><?= $value->name ?></span>
                        </div>
                    </div>
                    <!-- <div class="event-info">
                        <h4> // $value->name </h4>
                    </div> -->
                </div>
            <?php } ?>
        </div>

        <div class="section-title text-center">
            <h3>Youtube Video</h3>
            <h5>St. Gabriel's Pre-University Gallery</h5>
        </div>
        
        <div class="row">
            <?php foreach($youtubeVideo as $video): ?>
                <div class="col-md-4 event-item">
                        <div class="event-thumb">
                            <!-- <div class="video"> -->
                                <iframe width="360" height="215" src="https://www.youtube.com/embed/<?= $video['id']['videoId'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <center><h6><?= $video['snippet']['title'] ?></h6></center>
                            <!-- </div> -->
                        </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <center>
                <?= Bootstrap4LinkPager::widget([
                    'pagination' => $model->pagination,
                ]);
                ?>
            </center>
        </div>
    </div>
</section>
<!-- Gallery section end-->

<?php
$js = <<< JS

JS;

$this->registerJs($js);
?>