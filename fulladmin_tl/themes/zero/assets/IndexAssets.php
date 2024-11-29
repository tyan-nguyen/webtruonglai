<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\zero\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //Bootstrap
        'zero/plugins/bootstrap/bootstrap.min.css',
        //FontAwesome
        'zero/plugins/fontawesome/css/all.min.css',
        //Animation
        'zero/plugins/animate-css/animate.css',
        //slick Carousel
        'zero/plugins/slick/slick.css',
        'zero/plugins/slick/slick-theme.css',
        //Colorbox
        'zero/plugins/colorbox/colorbox.css',
        //Template styles
        'zero/css/theme.css?v=1',
        'zero/css/style.css',
        'zero/css/custom.css?v=29',
        'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500&family=Montserrat:wght@500&family=Roboto+Serif:opsz@8..144&family=Inter:wght@500&family=Literata:opsz,wght@7..72,500&display=swap'
    ];
    public $js = [
        //initialize jQuery Library
        'zero/plugins/jQuery/jquery.min.js',
        //Bootstrap
        'zero/plugins/bootstrap/bootstrap.min.js',
        //Slick Carousel
        'zero/plugins/slick/slick.min.js',
        'zero/plugins/slick/slick-animation.min.js',
        //Color box
        'zero/plugins/colorbox/jquery.colorbox.js',
        //shuffle
        'zero/plugins/shuffle/shuffle.min.js',
        //Template custom
        'zero/js/script.js?v=2'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
