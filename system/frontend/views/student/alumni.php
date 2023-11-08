<?php

$this->title = 'Alumni';
$this->params['breadcrumbs'][] = ['label' => 'Alumni', 'url' => ['/student/alumni']];
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
    'content' => 'Alumni ST GABRIEL PRE UNIVERSITY',
], 'description');

?>

<!-- WHY section -->
<section class="about-section spad pt-0">
    <div class="container">
        <?= $model->content ?>
</section>
<!-- WHY section end-->