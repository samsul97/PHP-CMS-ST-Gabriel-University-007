<?php

$this->title = $seoData->title;
$this->params['breadcrumbs'][] = ['label' => 'Why St Gabriels', 'url' => ['/student/why']];
$this->params['breadcrumbs'][] = $this->title;

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => $seoData->keywords], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => $seoData->description], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => $seoData->canonical]);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => $seoData->robots], 'robots');

?>

<!-- WHY section -->
<section class="about-section spad pt-0">
    <div class="container">
        <?= $model->content ?>
</section>
<!-- WHY section end-->

<?php
$js = <<< JS
{
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
}
JS;

$this->registerJs($js);