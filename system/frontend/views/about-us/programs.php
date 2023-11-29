<?php

use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'Programs';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['/about-us/programs']];
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

<?php
$js = <<< JS
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