<?php

use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'List Testimony';
$this->params['breadcrumbs'][] = ['label' => 'Parent Testimonial', 'url' => ['/testimonys/testimonys']];
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

<!-- Testimony section -->
<div class="container">
    <div class="section-title text-center">
        <h3>Parent Testimonial</h3>
    </div>
    <section class="testimonial-section spad">
        <div class="container">
            <div class="testimonial-slider owl-carousel ">
                <?php foreach ($model as $key => $value) { ?>
                    <?php
                        $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';
                    ?>
                    <div class="ts-item">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <img src="<?= Url::base(). '/backend' . $image ?>" alt="Testimony ST GABRIEL PRE UNIVERSITY">
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 ts-text">
                                <p style="text-align:justify;padding-right:2%;font-weight:500;color:black"><?= $value->content?></p>
                                <h5><?= $value->name ?></h5>
                                <span>Student’s Parent</span>
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <center>
                                <button class="btn btn-danger btn-sm prev-btn">Previous</button>
                                <button class="btn btn-danger btn-sm next-btn">Next</button>
                            </center>
                        </div>
                    </div>
                <?php } ?>	 
            </div>
        </div>
    </section>
</div>
<!-- Testimony section end-->

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