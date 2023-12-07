<?php

use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'Home';

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => isset($seoData->keywords) ? $seoData->keywords : ''], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => isset($seoData->description) ? $seoData->description : ''], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => isset($seoData->canonical) ? $seoData->canonical : '']);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => isset($seoData->robots) ? $seoData->robots : ''], 'robots');

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
$trackVisitorUrl = Url::to(['site/track-visitor']);

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

// track visitor
var ipAddress = '$ipAddress';
var browser = '$browser';
var os = '$os';
var language = '$language';
var referrer = '$referrer';
var currentUrl = '$currentUrl';
var visitTime = '$visitTime';

$.ajax({
    url: '$trackVisitorUrl',
    type: 'POST',
    data: {
        ip_address: ipAddress,
        browser: browser,
        os: os,
        language: language,
        referrer: referrer,
        current_url: currentUrl,
        visit_time: visitTime,
    },
    success: function(response) {
      console.log(response);
        console.log('Tracking data sent successfully');
    },
    error: function(error) {
        console.error('Error sending tracking data:', error);
    }
});
JS;

$this->registerJs($js);