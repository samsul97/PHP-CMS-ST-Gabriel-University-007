<?php

use yii\helpers\Url;

$this->title = 'St Gabriel Pre University';

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
    'content' => 'Keep following our news to get the latest information.',
], 'description');

?>

<!-- Parent section -->
<div class="container">
        <div class="section-title text-center">
            <h3>Blog and Article</h3>
        </div>
        <!-- <section class="testimonial-section spad"> -->
            <div class="container">
                <!-- <div class="testimonial-slider owl-carousel "> -->
                    <?php foreach ($model as $key => $value) { ?>
                        <div class="ts-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <?php $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : ''; ?>
                                    <img src="<?= Url::base(). '/backend' . $image ?>" alt="" style="width: 90%" class="rounded-0">
                                    <br>
                                    <br>
                                    <h6>Article Category : <?= $value->article_category_id ?></h6>
                                    <h6>Post By : <?= $value->created_by ?></h6>
                                    <h6>Created At : <?= $value->created_at ?></span>
                                    <br>
                                <br>
                                <br>
                                <br>
                                </div>
                                
                                <div class="col-md-8 col-sm-8 col-xs-8 ts-text">
                                    <h5><?= $value->title ?></h5>
                                    <br>
                                    <p style="text-align:justify;padding-right:2%;color:black"><?= $value->content ?></p>
                                    <!-- <span>Article</span> -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>	 
                <!-- </div> -->
            </div>
        <!-- </section> -->
</div>
<!-- Parent section end-->