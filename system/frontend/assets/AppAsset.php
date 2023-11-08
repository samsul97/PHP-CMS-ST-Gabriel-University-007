<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/themify-icons.css',
        'css/magnific-popup.css',
        'css/animate.css',
        'css/owl.carousel.css',
        'css/style.css',
        'css/enquiry.css',
        'https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i',
        'https://fonts.googleapis.com/css?family=Oswald&display=swap',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css',
        "backend/plugins/sweetalert2/sweetalert2.css",
        // 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css'
    ];
    public $js = [
        // 'js/jquery-3.2.1.min.js',
        // "https://code.jquery.com/jquery-3.6.4.js",
        'js/owl.carousel.min.js',
        // 'js/jquery.countdown.js',
        'js/masonry.pkgd.min.js',
        'js/magnific-popup.min.js',
        'js/main.js',
	    // 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo',
	    // 'js/map.js',
        'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js',
        "backend/plugins/sweetalert2/sweetalert2.all.js",
        // 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
