<?php
$this->title = $seoData->title ?? null;

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => $seoData->keywords ?? null], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => $seoData->description ?? null], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => $seoData->canonical ?? null]);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => $seoData->robots ?? null], 'robots');

?>

<!-- Our culture -->
  <?=$contactUs->our_culture?>
<!-- Our culture end-->

<!-- Youtube video -->
<div class="embed-responsive embed-responsive-21by9">
    <?= $contactUs->youtube_api ?>
</div>
<!-- Youtube video end -->

<?php
$css = <<< CSS
.embed-responsive-item {
  width: 854px !important;
  height: 470px !important;
  margin-left: 125px !important;
}

@media (max-width: 768px) {
  .embed-responsive .embed-responsive-item {
    width: 90% !important;
    height: 100% !important;
    margin-left: 25px !important;
  }
}
CSS;

$this->registerCss($css);

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