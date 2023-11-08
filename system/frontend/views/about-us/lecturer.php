<?php

$this->title = 'Lecturer - ST Gabriel Pre University';
$this->params['breadcrumbs'][] = ['label' => 'Lecturer', 'url' => ['index']];
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
    'content' => 'This is a lecturer page, get to know us more closely.',
], 'description');

?>

<!-- Lecturer section -->
<section class="about-section spad pt-0">
    <div class="container">
        <?= $model->content ?>
    </div>
</section>
<!-- Lecturer section end-->