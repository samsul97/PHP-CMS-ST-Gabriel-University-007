<?php

use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'Detail Article';

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => isset($seoData->keywords) ?? ''], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => isset($seoData->description) ?? ''], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => isset($seoData->canonical) ?? '']);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => isset($seoData->robots) ?? ''], 'robots');

?>

<!-- Parent section -->
<div class="container">
    <div class="section-title text-center">
        <h3>Blog and Article</h3>
    </div>
    <div class="container">
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
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Parent section end-->

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