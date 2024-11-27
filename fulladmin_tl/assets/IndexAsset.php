<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 * PageAsset for anhduong themes
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'anhduong/css/style.css?v=1.0.0',        
        'anhduong/bootstrap-3.3.7/dist/css/bootstrap.min.css?v=1.0.0',        
        'anhduong/css/main.css?v=1.0.0',        
        'anhduong/css/custom.css?v=1.0.1', //for header
        'anhduong/css/wc-dt-custom.css?v=1.0.0', //for sidebar sản phẩm mới, danh mục sản phẩm        
        'anhduong/css/media.css?v=1.0.0', //ảnh hưởng chia cột        
        'anhduong/fontawesome-free-6.4.2-web/css/all.min.css', //fontawesome 6x        
        'anhduong/css/customfooter.css?v=1.0.1', //for footer        
        //for slider & branches
        'anhduong/js/slick/slick.css?v=1.0.0',
        'anhduong/js/slick/slick-theme.css?v=1.0.0',
        'anhduong/css/slide.css?v=1.0.0',
        'anhduong/css/branch-slider.css?v=1.0.0',
        
        'anhduong/css/chat.css?v=1.0.0', //chat bundle css
        'anhduong/css/me.css?v=1.0.2', //additional custom css
    ];
    public $js = [
        //in head
        ['anhduong/js/jquery-1.11.0.min.js', 'position' => \yii\web\View::POS_HEAD],
        ['anhduong/js/jquery-migrate-1.2.1.min.js', 'position' => \yii\web\View::POS_HEAD],
        
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
    ];
}
