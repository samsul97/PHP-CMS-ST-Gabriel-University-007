<?php

$this->title = isset($seoData->title) ? $seoData->title : 'Ceo Message';
$this->params['breadcrumbs'][] = ['label' => 'Ceo Message', 'url' => ['/about-us/ceomessage']];
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

<!-- CEO section -->
<section class="about-section spad pt-0">
    <div class="container">
        <?= $model->content ?>
</section>
<!-- CEO section end-->

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
?>