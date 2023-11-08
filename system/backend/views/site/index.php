<?php

use yii\helpers\Html;
use backend\models\User;
use backend\models\Gallery;
use backend\models\Article;
use backend\models\Slider;
use backend\models\VolunteerProfile;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'St Gabriel Apps';
$this->params['page_title'] = 'Dashboard';
$this->params['page_desc'] = 'St Gabriel University';
$this->params['title_card'] = 'Information';

?>
<div class="row" style="margin: 3px;">
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Slider::getCount()); ?></h3>
            <p>Banner Total</p>
            </div>
            <div class="icon">
            <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= Yii::$app->formatter->asInteger(Article::getCount()); ?><sup style="font-size: 20px"></sup></h3>
                <p>Article Total</p>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    </div>
    
    <div class="col-lg-4 col-xs-6">
    
        <div class="small-box bg-orange">
            <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Gallery::getCount()); ?></h3>
            <p>Gallery Total</p>
            </div>
            <div class="icon">
            <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<?php

$js = <<< JS

JS;

$css = <<< CSS

CSS;

$this->registerJs($js);
$this->registerCss($css);

?>
