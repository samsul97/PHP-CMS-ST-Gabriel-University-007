<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;

$this->title = 'Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['/gallery/gallery-categories']];
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
        Learning Journey,
        Company Visit,
        Business Workshop',
], 'keywords');

// seo page description
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Welcome to gallery, have fun in our gallery.',
], 'description');
?>

<!-- Gallery section -->
<section class="about-section spad pt-0">
    <div class="container">
        <h5><?= $galleryCategory->name ?></h5>
        <br>
        <div class="row">
        <?php foreach ($gallery as $index => $value) {?> 
            <div class="col-md-3 event-item">
                <div class="event-thumb">
                    <?php $image = $value['image'] && is_file(Yii::getAlias('@webroot') . '/backend' . $value['image']) ? $value['image'] : ''; ?>
                    <?php $image = Url::base(). '/backend' . $image ?>
                    <?= Html::a("<img src='$image' alt='Gallery ST Gabriel Pre University'>", 'javascript:void(0);', [
                        'class' => 'gallery_detail',
                        'data-index' => $index,
                        'data-image' => $image,
                    ]) ?>
                </div>
                <!-- <div class="event-date">
                        <span>// $value->name ?></span>
                    </div> -->
                <!-- <div class="event-info">
                    <h4> // $value->name </h4>
                </div> -->
            </div>
        <?php } ?>	 
        </div>
    </div>
</section>
<!-- About section end-->

<?php
$js = <<< JS

$(".gallery_detail").on("click", function(e) {
    e.preventDefault();
    var index = $(this).data('index');
    var gallery = $('.gallery_detail');

    var magnificItems = [];
    gallery.each(function() {
        var image = $(this).data('image');
        magnificItems.push({ src: image });
    });

    $.magnificPopup.open({
        items: magnificItems,
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1], // Preload 1 image before and after the current one
            arrowMarkup:
                '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Previous', // Text for previous button
            tNext: 'Next', // Text for next button
        },
        index: index, // Set the initial index for the popup
        callbacks: {
            open: function() {
                this.goTo(index);
            }
        }
    });

    return false;
});
JS;

$this->registerJs($js);
// $this->registerCss($css);