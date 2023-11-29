<?php

use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'Partners';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['/partners/partners']];
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

<!-- Partner section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
    <div class="section-title text-center">
            <h3>Education Partners</h3>
            <p> </p>
        </div>
        <div class="row text-center" align="center">
            <?php foreach ($model as $key => $value) { ?>
                <?php
                $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';
                ?>
                <?php 
                    $count = count($model);
                    if($count == 1){
                        echo "<div class='col-lg-4 col-md-6 course-item'></div>";
                        echo "<div class='col-lg-3 col-md-6 course-item'>";
                    } else if($count == 2){
                        echo "<div class='col-lg-1 col-md-6 course-item'></div>";
                        echo "<div class='col-lg-4 col-md-6 course-item'>";
                    } else if($count == 3){
                        echo "<div class='col-lg-4 col-md-6 course-item'>";
                    } else{
                        echo "<div class='col-lg-3 col-md-6 course-item'>";
                    }
                ?>
            <div class="course-thumb">
                <img src="<?= Url::base(). '/backend' . $image ?>" alt="PARTNERS ST GABRIEL PRE UNIVERSITY">
            </div>
            <div class="course-info">
                <h4><?= $value->name ?></h4>
            </div> 
        </div>
        <?php } ?>
        </div>
    </div>
</section>
<!-- Partner section end-->

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