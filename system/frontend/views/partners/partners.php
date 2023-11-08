<?php

use yii\helpers\Url;

$this->title = 'Partners';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['/partners/partners']];
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
        distance learning,
        MDIS Singapore,
        Southern Cross University,
        University of Hertfordshire,
        Kaplan Business School,
        University of Bolton',
], 'keywords');

// seo page description
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Our partners',
], 'description');

?>

<!-- Education section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
    <div class="section-title text-center">
            <h3>Education Partners</h3>
            <p> </p>
        </div>
        <div class="row text-center" align="center">
            <?php foreach ($model as $key => $value) { ?>
                <?php
                $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';
                ?>
                <?php 
                    $count = count($model);
                    if($count == 1){
                        echo "<div class='col-lg-4 col-md-6 course-item'></div>";
                        echo "<div class='col-lg-3 col-md-6 course-item'>";
                    } else if($count == 2){
                        echo "<div class='col-lg-1 col-md-6 course-item'></div>";
                        echo "<div class='col-lg-4 col-md-6 course-item'>";
                    } else if($count == 3){
                        echo "<div class='col-lg-4 col-md-6 course-item'>";
                    } else{
                        echo "<div class='col-lg-3 col-md-6 course-item'>";
                    }
                ?>
            <div class="course-thumb">
                <img src="<?= Url::base(). '/backend' . $image ?>" alt="PARTNERS ST GABRIEL PRE UNIVERSITY">
            </div>
            <div class="course-info">
                <h4><?= $value->name ?></h4>
            </div> 
        </div>
        <?php } ?>
        </div>
    </div>
</section>
<!-- Education section end-->