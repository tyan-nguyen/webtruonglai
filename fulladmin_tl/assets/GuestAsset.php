<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GuestAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		//'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
	   // 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
	    'assets/guest/css/fontawesome/css/all.min.css',
	    'assets/guest/css/bootstrap-icons-1.4.1/bootstrap-icons.css',
	    'assets/guest/lib/owlcarousel/assets/owl.carousel.min.css',
	    'assets/guest/lib/animate/animate.min.css',
	    'assets/guest/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
	    'assets/guest/lib/twentytwenty/twentytwenty.css',
	    'assets/guest/css/bootstrap.min.css',
	    'assets/guest/css/style.css',
	    'assets/guest/css/anstyle.css?v=8'
	];
	public $js = [
	    //<!-- JavaScript Libraries -->
		//'https://code.jquery.com/jquery-3.4.1.min.js',
	    //'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
	    'assets/guest/js/jquery-3.4.1.min.js',
	    'assets/guest/js/bootstrap.bundle.min.js',
	    'assets/guest/lib/wow/wow.min.js',
	    'assets/guest/lib/easing/easing.min.js',
	    'assets/guest/lib/waypoints/waypoints.min.js',
	    'assets/guest/lib/owlcarousel/owl.carousel.min.js',
	    'assets/guest/lib/tempusdominus/js/moment.min.js',
	    'assets/guest/lib/tempusdominus/js/moment-timezone.min.js',
	    'assets/guest/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
	    'assets/guest/lib/twentytwenty/jquery.event.move.js',
	    'assets/guest/lib/twentytwenty/jquery.twentytwenty.js',
	    //<!-- Template Javascript -->
	    'assets/guest/js/main.js?v=1'
	];
	public $depends = [
		//'yii\web\YiiAsset',
		//'yii\bootstrap\BootstrapAsset',
	];
}
