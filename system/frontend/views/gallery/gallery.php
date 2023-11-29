<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = isset($seoData->title) ? $seoData->title : 'List Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['/gallery/gallery-categories']];
$this->params['breadcrumbs'][] = $this->title;

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => isset($seoData->keywords) ?? ''], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => isset($seoData->description) ?? ''], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => isset($seoData->canonical) ?? '']);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => isset($seoData->robots) ?? ''], 'robots');

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
            </div>
        <?php } ?>	 
        </div>
    </div>
</section>
<!-- Gallery section end-->

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

function setSchemaProperties() {
    return {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "<?= $name ?>",
        "description": "<?= $description ?>",
        "url": "<?= $url ?>",
        "image": "<?= $image ?>",
        "datePublished": "<?= $datePublished ?>",
        "dateModified": "<?= $dateModified ?>",
        "author": {
            "@type": "Person",
            "name": "<?= $authorName ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= $publisherName ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $publisherLogo ?>"
            }
        },
        "keywords": "<?= $keywords ?>",
        "mainEntityOfPage": "<?= $mainEntityOfPage ?>"
    };
}

// Set schema properties
var schemaProperties = setSchemaProperties();

var scriptTag = document.createElement("script");
scriptTag.type = "application/ld+json";
scriptTag.innerHTML = JSON.stringify(schemaProperties);
document.head.appendChild(scriptTag);
JS;

$this->registerJs($js);