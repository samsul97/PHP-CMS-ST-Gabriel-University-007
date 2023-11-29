<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = isset($seoData->title) ? $seoData->title : 'Album Gallery';
$this->params['breadcrumbs'][] = ['label' => 'List Gallery', 'url' => ['/gallery/gallery-categories']];
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
        <div class="section-title text-center">
            <h3>Gallery</h3>
            <h5>St. Gabriel's Pre-University Gallery</h5>
        </div>
        <div class="row">
            <?php foreach ($model->getModels() as $value) {?> 
                <div class="col-md-4 event-item">
                    <div class="event-thumb">
                        <?php $image = $value->cover && is_file(Yii::getAlias('@webroot') . '/backend' . $value->cover) ? $value->cover : ''; ?>
                        <?php $image = Url::base(). '/backend' . $image ?>
                        <?= Html::a("<img src='$image' alt='Gallery ST Gabriel Pre University'>", ['/gallery/gallery', 'id'=> $value->id], ['style'=> ""]) ?>
                        <div class="event-date">
                            <span><?= $value->name ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="section-title text-center">
            <h3>Youtube Video</h3>
            <h5>St. Gabriel's Pre-University Gallery</h5>
        </div>
        
        <div class="row">
            <?php foreach($youtubeVideo as $video): ?>
                <div class="col-md-4 event-item">
                        <div class="event-thumb">
                            <iframe width="360" height="215" src="https://www.youtube.com/embed/<?= $video['id']['videoId'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <center><h6><?= $video['snippet']['title'] ?></h6></center>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <center>
                <?= LinkPager::widget([
                    'pagination' => $model->pagination,
                ]);
                ?>
            </center>
        </div>
    </div>
</section>
<!-- Gallery section end-->

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