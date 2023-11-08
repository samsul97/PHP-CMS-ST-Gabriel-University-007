<?php

use yii\helpers\Url;

$this->title = 'Programs - ST Gabriel Pre University';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['/about-us/programs']];
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
    'content' => 'follow our program, the process is fast and easy to study abroad.',
], 'description');

?>

<!-- Program section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
    <div class="section-title text-center">
            <h3>Our Programs</h3>
            <p></p>
        </div>
        <div class="row">
            <?php
                $image = $model->image && is_file(Yii::getAlias('@webroot') . '/backend' . $model->image) ? $model->image : '';
            ?>
            <img width="100%" height="100%"src="<?= Url::base(). '/backend' . $image ?>" alt="Programs ST Gabriel Pre University">
        </div>
    </div>
</section>
<!-- Program section end-->