<?php

use yii\helpers\Url;

$this->title = 'Parent Testimonial';
$this->params['breadcrumbs'][] = ['label' => 'Parent Testimonial', 'url' => ['/testimonys/testimonys']];
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

?>

<!-- Parent section -->
<div class="container">
    <div class="section-title text-center">
        <h3>Parent Testimonial</h3>
    </div>
        <section class="testimonial-section spad">
            <div class="container">
                <div class="testimonial-slider owl-carousel ">
                    <?php foreach ($model as $key => $value) { ?>
                        <?php
                            $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';
                        ?>
                        <div class="ts-item">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <img src="<?= Url::base(). '/backend' . $image ?>" alt="Testimony ST GABRIEL PRE UNIVERSITY">
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9 ts-text">
                                    <p style="text-align:justify;padding-right:2%;font-weight:500;color:black"><?= $value->content?></p>
                                    <h5><?= $value->name ?></h5>
                                    <span>Student’s Parent</span>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                <center>
                                    <button class="btn btn-danger btn-sm prev-btn">Previous</button>
                                    <button class="btn btn-danger btn-sm next-btn">Next</button>
                                </center>
                            </div>
                        </div>
                    <?php } ?>	 
                </div>
            </div>
        </section>

        <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Third slide">
                </div>
            </div>
        </div> -->
</div>
<!-- Parent section end-->

