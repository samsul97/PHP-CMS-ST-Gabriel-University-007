<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\models\Contacts;
use backend\models\Footer;
use backend\models\Slider;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Enquiry;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$contactUs = Contacts::findOne(['code' => 'STGABRIELPREUNIVERSITY']);
$banner = Slider::find()->all();
$model = new Enquiry();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="shortcut icon" href="<?= Url::to('@web/img/favicon.ico') ?>" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Page preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Page preloder end -->

<!-- Header section -->
<header class="header-section">
    <div class=" service-item">
        <div class="row"  >
            <!-- widget -->
            <div class="col-sm-6 col-lg-3 footer-widget">
                <div class="about-widget text-center">
                </br><img src="<?= Url::to('@web/img/logo.png') ?>" alt="LOGO ST GABRIEL PRE UNIVERSITY">
                    <div class="nav-switch">
                        <h6>MENU</h6>
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
            <!-- widget -->
        
            <div class="col-sm-6 col-lg-6 col-md-4 footer-widget header-info" align="left" style="margin-top:-1%"></br>
                <img src="<?= Url::to('@web/img/nama.png') ?>" alt="ST GABRIEL PRE UNIVERSITY LOGO NAME">
                <p  class="open" style="font-family: 'Oswald', sans-serif; font-size:130%;text-align:center;margin-top:-5%;COLOR:#800000"><B>ACADEMIC &nbsp;EXCELLENCE,&nbsp;EDUCATIONAL &nbsp;INNOVATION &nbsp;& &nbsp;SOCIAL RESPONSIBILITY</B></p>
            </div>
            <!-- widget -->
                
            <!-- widget -->
            <div class="col-sm-6 col-lg-3 footer-widget text-right header-info" align="right">
            </br></br>
                <div style="font-family: Kaushan Script" class="about-widget text-left">
                        <img src="<?= Url::to('@web/img/athe_new.png') ?>" alt="AWARDS ST GABRIEL PRE UNIVERSITY"></a></br>
                </div>
            </div>		 
        </div>
    </div> 
</header>
<!-- Header section end-->

<!-- Navbar section  -->
<nav class="nav-section" >
    <ul class="main-menu">
        <li class="active"><?= Html::a(Yii::t('frontend', 'Home'), ['/index'], ['style'=> "font-size:14px;"]) ?></li>
        
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About Us <span class="caret"></span></a>
            <div class="dropdown-menu" role="menu">
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', "St. Gabriel's Pre-University"), ['/about-us/profile'], [
                        'style'=> "color: #16181b;
                                text-decoration: none;
                                text-transform: capitalize;
                                background-color: #e9ecef;
                                display: block;
                                width: 100%;
                                padding: 0.25rem 1.5rem;
                                clear: both;
                                font-weight: 400;
                                color: #212529;
                                text-align: inherit;
                                white-space: nowrap;
                                background-color: transparent;
                                border: 0;"])
                    ?>
                </button>

                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Lecturer'), ['/about-us/lecturer'], [
                        'style'=> "color: #16181b;
                                text-decoration: none;
                                text-transform: capitalize;
                                background-color: #e9ecef;
                                display: block;
                                width: 100%;
                                padding: 0.25rem 1.5rem;
                                clear: both;
                                font-weight: 400;
                                color: #212529;
                                text-align: inherit;
                                white-space: nowrap;
                                background-color: transparent;
                                border: 0;"])
                    ?>
                </button>
            </div>
        </li>
        
        <li><?= Html::a(Yii::t('frontend', 'Ceo Message'), ['/about-us/ceomessage'], ['style'=> "font-size:14px;"]) ?></li>
        
        <li><?= Html::a(Yii::t('frontend', 'Programs'), ['/about-us/programs'], ['style'=> "font-size:14px;"]) ?></li>
        
        <li><?= Html::a(Yii::t('frontend', 'Education Partners'), ['/partners/partners'], ['style'=> "font-size:14px;"]) ?></li>
        
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Student <span class="caret"></span></a>
            <div class="dropdown-menu" role="menu">
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Why Choose St.Gabriel"s Pre University'), ['/student/why-stgabriel'], [
                        'style'=> "color: #16181b;
                                text-decoration: none;
                                text-transform: capitalize;
                                background-color: #e9ecef;
                                display: block;
                                width: 100%;
                                padding: 0.25rem 1.5rem;
                                clear: both;
                                font-weight: 400;
                                color: #212529;
                                text-align: inherit;
                                white-space: nowrap;
                                background-color: transparent;
                                border: 0;"])
                    ?>
                </button>
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Student Care Service'), ['/student/scs'], [
                        'style'=> "color: #16181b;
                                text-decoration: none;
                                text-transform: capitalize;
                                background-color: #e9ecef;
                                display: block;
                                width: 100%;
                                padding: 0.25rem 1.5rem;
                                clear: both;
                                font-weight: 400;
                                color: #212529;
                                text-align: inherit;
                                white-space: nowrap;
                                background-color: transparent;
                                border: 0;"])
                    ?>
                </button>
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Alumni'), ['/student/alumni'], [
                            'style'=> "color: #16181b;
                                    text-decoration: none;
                                    text-transform: capitalize;
                                    background-color: #e9ecef;
                                    display: block;
                                    width: 100%;
                                    padding: 0.25rem 1.5rem;
                                    clear: both;
                                    font-weight: 400;
                                    color: #212529;
                                    text-align: inherit;
                                    white-space: nowrap;
                                    background-color: transparent;
                                    border: 0;"])
                    ?>
                </button>
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Pastoral Counseling'), ['/student/pastoral-conseling'], [
                            'style'=> "color: #16181b;
                                    text-decoration: none;
                                    text-transform: capitalize;
                                    background-color: #e9ecef;
                                    display: block;
                                    width: 100%;
                                    padding: 0.25rem 1.5rem;
                                    clear: both;
                                    font-weight: 400;
                                    color: #212529;
                                    text-align: inherit;
                                    white-space: nowrap;
                                    background-color: transparent;
                                    border: 0;"])
                    ?>
                </button>
                <button class="dropdown-item" type="button">
                    <?= Html::a(Yii::t('frontend', 'Handbook'), ['/student/handbook'], [
                            'style'=> "color: #16181b;
                                    text-decoration: none;
                                    text-transform: capitalize;
                                    background-color: #e9ecef;
                                    display: block;
                                    width: 100%;
                                    padding: 0.25rem 1.5rem;
                                    clear: both;
                                    font-weight: 400;
                                    color: #212529;
                                    text-align: inherit;
                                    white-space: nowrap;
                                    background-color: transparent;
                                    border: 0;"])
                    ?>
                </button>
            </div>
        </li>
        
        <li><?= Html::a(Yii::t('frontend', 'Parent Testimonial'), ['/testimonys/testimonys'], ['style'=> "font-size:14px;"]) ?></li>
        <li><?= Html::a(Yii::t('frontend', 'Gallery'), ['/gallery/gallery-categories'], ['style'=> "font-size:14px;"]) ?></li>
        <li><?= Html::a(Yii::t('frontend', 'Article'), ['/article/articles'], ['style'=> "font-size:14px;"]) ?></li>
        <li><?= Html::a(Yii::t('frontend', 'Contact'), ['/about-us/contact'], ['style'=> "font-size:14px;"]) ?></li>
    </ul>
</nav>
<!-- Navbar section end -->

<!-- Content section -->
<?php if(Url::current() == '/about-us/contact') : ?>
    
    <section class="service-section spad">
        <div class="container services">
            <div class="row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>
        </div>
    </section>

    <?= $content ?>

<?php else : ?>

    <?php if(Url::current() == '/index') : ?>
            
        <!-- Slider section -->
        <section class="hero-section">
            <div class="hero-slider owl-carousel">
                <?php foreach($banner as $value) { ?>
                <div class="img-fluid hs-item set-bg" data-setbg="<?= Url::base(). '/backend'.$value->banner ?>">
                    <div class="hs-text">
                        <div class="container">
                            <div class="row" <?php if($value->big_title!=""){ ?> style="background-color:black;opacity:80%;"<?php }?> >
                                <div class="col-lg-8"style=" opacity:100%;padding-top:1%;"   >
                                    <div class="hs-subtitle"><?=$value['small_title']?></div>
                                    <h2 class="hs-title"  ><?=$value['big_title']?></h2>
                                    <p class="hs-des"><?=$value['content']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <!-- Slider section end -->
        
        <section class="service-section spad">
            <div class="container services">
                <div class="row">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </section>

    <?php else : ?>

        <section class="service-section spad">
            <div class="container services">
                <div class="row">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </section>

    <?php endif ?>
    
<?php endif ?>
<!-- Content section end -->

<!-- Enquiry section -->
<div  id="feedback">
	<a href="#popup1" >Send Enquiry</a>
</div>

<div id="popup1" class="overlay">
    <div class="popup">
        <div class="div1" style="background:#fff">
            <a class="close" href="#">×</a>
            <div class="content" id="quickenquire">
                <h3 style="text-align:center">Send Enquiry</h3>
                
                <?php $form = ActiveForm::begin(['action' => ['site/send-enquiry']]); ?>
                    <?= $form->field($model, 'name')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
                    <?= $form->field($model, 'subject')->textInput() ?>
                    <?= $form->field($model, 'message')->textarea() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'background-color:#800000']) ?>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
<!-- Equiry section end -->

<!-- Footer section -->
<footer class="footer-section" style="background-color:#800000;font-color:#fff;">
    <div class="row" >
        <!-- Logo -->
        <div class="col-sm-12 col-lg-3 footer-widget" style="margin-left:5%;">
        </br>
            <div  class="about-widget text-left">
                <?php $imageContact = $contactUs->logo && is_file(Yii::getAlias('@webroot') . '/backend' . $contactUs->logo) ? $contactUs->logo : ''; ?> 
                <img width="250px" src="<?= Url::base().'/backend' . $imageContact ?>" alt="LOGO ST GABRIEL PRE UNIVERSITY">
            </div>
            <div  class="about-widget text-left">
                <img width="250px" src="<?= Url::to('@web/img/athe_new.png') ?>" alt="AWARDS ST GABRIEL PRE UNIVERSITY" style="margin-top:-5%">
            </div>
        </div>
        <!-- Logo end -->
        
        <div class="col-sm-12 col-lg-3 footer-widget">
            </br>
            <!-- Partner -->
            <?php $footer = Footer::find()->all();
            foreach ($footer as $key => $value) { ?>
                <?php $imageFooter = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : ''; ?>
                <a href="#"><img style="padding:5px;" width="35%px" src="<?= Url::base().'/backend' . $imageFooter ?>" alt="PARTNER LOGO ST GABRIEL PRE UNIVERSITY"></a>
            <?php } ?>
            <!-- Partner end -->
        </div>

        <!-- Contact information -->
        <div class="col-sm-6 col-lg-3 footer-widget" style="margin-left:0%;">
            </br>
            <div class="dobule-link">
                    <h6 class="fw-title">CONTACT</h6>
            <ul class="contact">
                <li><p style="font-size:16px;color:white;"><i class="fas fa-map-marker"></i>&nbsp;<?=$contactUs->address?></p></li>
                <li><p style="font-size:17px;color:white;"><i class="fas fa-phone"></i> <?=$contactUs->phone2?></p>
                <p style="font-size:17px;color:white;"><i class="fas fa-phone"></i> <?=$contactUs->phone1?></p>
                </li>
                <li><p style="font-size:15px;color:white;"><i class="fa fa-envelope"></i> <?=$contactUs->email?></p></li>
                <li><p style="font-size:17px;color:white;"><i class="fa fa-clock-o"></i> Monday - Friday, </br>08:00AM - 06:00 PM</p></li>
            </ul>
            </div>
        </div>
        <!-- Contact information end -->
    
        <!-- Social media -->
        <div class="col-sm-6 col-lg-2 footer-widget text-right" align="left"  >
            </br>
            <div style="font-family: Kaushan Script" class="about-widget text-left">
                <h6 class="fw-title">Follow Us :</h6>
                <a href="<?= $contactUs->instagram ?>" target='_blank'><img width="20%px" src="<?= Url::to('@web/img/ig.png') ?>" alt="INSTAGRAM ST GABRIEL PRE UNIVERSITY"></a>&nbsp;
                <a href="<?= $contactUs->facebook ?>" target='_blank'><img width="20%px" src="<?= Url::to('@web/img/fb.png') ?>" alt="FACEBOOK ST GABRIEL PRE UNIVERSITY"></a>&nbsp;
                <a href="https://wa.me/62<?= $contactUs->whatsaap ?>" target='_blank'><img width="20%px" src="<?= Url::to('@web/img/wa.png') ?>" alt="WHATSAPP SUPPORT ST GABRIEL PRE UNIVERSITY"></a>&nbsp;
                <a href="<?= $contactUs->youtube ?>" target='_blank'><img width="20%px" src="<?= Url::to('@web/img/youtube.jpg') ?>" alt="YOUTUBE ST GABRIEL PRE UNIVERSITY"></a>
            </div>
        </div>
        <!-- Social media end -->
    </div>

    <button class="btn btn-primary scroll-top-btn" onclick="scrollToTop()">&#8593;</button>

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <p style="color:white;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://stgabrielpreuniversity.com" target="_blank">St Gabriel's Pre University</a></p>
        </div>		
    </div>
    <!-- Copyright end -->
</footer>
<!-- Footer section end -->
<?php $this->endBody() ?>
</body>

<!-- Flashes -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
        $title = !empty($message["title"]) ? $message["title"]: "Title Not Set!";
        $text  = !empty($message["message"]) ? $message["message"] : "Message Not Set!";
        $type  = !empty($message["type"]) ? $message["type"] : "error";
        $timer = !empty($message["duration"]) ? $message["duration"] : 3000;
    ?>
    <script>
        jQuery(document).ready(function(e) {
            swal.fire({
                title: '<?=$title?>',
                text: '<?=$text?>',
                icon: '<?=$type?>',
                timer: <?=$timer?>,
                showCancelButton: false,
                showConfirmButton: true
            });
        });
    </script>
<?php endforeach; ?>
<!-- Flashes end -->

<!-- Scroll top -->
<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.onscroll = function() {
        var scrollTopBtn = document.querySelector('.scroll-top-btn');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopBtn.style.display = 'block';
        } else {
            scrollTopBtn.style.display = 'none';
        }
    };
</script>

<style>
    .scroll-top-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
    }
</style>
<!-- Scroll top end -->
</html>
<?php $this->endPage() ?>
