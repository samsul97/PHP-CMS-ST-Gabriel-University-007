<?php 
$this->title = 'Contact - ST Gabriel Pre University';
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['/about-us/contact']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url;

// seo page
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => '
        a level,
        athe,
        college,
        college in indonesia,
        college jakarta,
        fast track,
        ib diploma,
        indonesia college, 
        international college jakarta,
        international school di jakarta,
        international university indonesia,
        international university jakarta,
        jakarta international college,
        kuliah cepat ijazah international,
        kuliah di luar negeri,
        o level,
        ofqual accreditation,
        pathway,
        preuniversity,
        preuniversity indonesia,
        preuniversity jakarta,
        school of business,
        school of business jakarta,
        sekolah fast track,
        sekolah fast track program,
        sekolah pathway luar negeri,
        study abroad,
        study business management,
        study diploma fast track,
        study in australia,
        study in singapore,
        study in uk,
        distance learning',
], 'keywords');

// seo page description
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'This is a contact page, find us here.',
], 'description');


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