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
class ViewAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'assets/css/bootstrap.min.css',
		'assets/css/custom.css',
		'assets/css/style.css'
	];
	public $js = [
		'assets/js/jquery-1.11.3.min.js',
		'assets/js/bootstrap.min.js',
		'assets/js/ie10-viewport-bug-workaround.js',
		'assets/js/holder.min.js'
	];
	public $depends = [
		//'yii\web\YiiAsset',
		//'yii\bootstrap\BootstrapAsset',
	];
}
