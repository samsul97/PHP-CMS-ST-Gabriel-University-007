<?php 
use yii\helpers\Url;

$this->title = isset($seoData->title) ? $seoData->title : 'Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['/about-us/contact']];
$this->params['breadcrumbs'][] = $this->title;

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => isset($seoData->keywords) ? $seoData->keywords : ''], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => isset($seoData->description) ? $seoData->description : ''], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => isset($seoData->canonical) ? $seoData->canonical : '']);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => isset($seoData->robots) ? $seoData->robots : ''], 'robots');

?>
<section class="fact-section spad set-bg" data-setbg="<?= Url::to('@web/img/fact-bg.jpg') ?>" style="color:#fff;" >
    <div  class="container">
        <div class="row" >
            <div class="col-sm-12 col-lg-5 fact text-center">
                <div class="fact-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                
                </br>
                
                <div class="fact-text text-center">
                <h2 align="center"style="font-size:30px;color:#fff;">ADDRESS</h2>
                    <p> <?= $model->address ?> </p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 fact text-center">
                <div class="fact-icon">
                    <i class="fa fa-phone"></i>
                </div>
            
                </br>

                <div class="fact-text text-center">
                    <h2 style="font-size:30px;color:#fff;">PHONE</h2>
                    <p>
                        <?= $model->phone1 ?> </br>
                        <?= $model->phone2 ?>
                    </p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 fact text-center">
                <div class="fact-icon">
                    <i class="fa fa-envelope"></i>
                </div>
                
                </br>

                <div class="fact-text text-center">
                    <h2 style="font-size:30px;color:#fff;">EMAIL</h2>
                    <p><?= $model->email ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact section -->
<section class="contact-page spad pt-0" style="margin-bottom:-8%">
    <div class="container">
        <div class="contact-form spad pb-0" style="align:center">
            <div class="section-title text-center">
                <h3>Our Maps</h3>
                    <div class="embed-responsive embed-responsive-21by9">
                        <?= $model->maps ?>
                    </div> 
            </div>
        </div>
    </div>
</section>
<!-- Contact section end-->

<?php
$trackVisitorUrl = Url::to(['visitor-log/track-visitor']);

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
var geoLocation = '$geoLocation';

$.ajax({
    url: '$trackVisitorUrl',
    type: 'POST',
    data: {
        ip_address: ipAddress,
        browser: browser,
        os: os,
        geo_location: geoLocation,
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

$css = <<< CSS
.embed-responsive-item {
    width: 600px !important;
    height: 450px !important;
    margin-left: 280px !important;
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