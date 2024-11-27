<?php

use app\themes\zero\assets\IndexAssets;

/** @var yii\web\View $this */
/** @var string $content */

IndexAssets::register($this);
//register meta tags
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? 'nguyen trinh tra vinh, sat thep, cua nhom, ep coc, be tong, vat lieu xay dung']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon1.ico')]);

$this->registerMetaTag(['property'=>'og:image', 'content'=>$this->params['meta_image'] ?? 'https://nguyentrinh.com.vn/images/default.jpg']);


$this->registerMetaTag(['name'=>'geo.region', 'content'=>'VN-TV']);
$this->registerMetaTag(['name'=>'geo.placename', 'content'=>'Trà Vinh']);
$this->registerMetaTag(['name'=>'geo.position', 'content'=>'9.9242715, 106.3373696']);
$this->registerMetaTag(['name'=>'ICBM', 'content'=>'9.9242715, 106.3373696']);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
    <?php 
	//google analytics
    echo $this->render('guest/googleAnalytic');
    ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="body-inner">
	<?= $this->render('guest/header') ?>
	<?= $this->render('guest/banner') ?>
	<?= $this->render('guest/services') ?>
	<?= $this->render('guest/facts') ?>
	<?= $this->render('guest/why') ?>
	<?= $this->render('guest/partners') ?>
	<?= $this->render('guest/project') ?>
	<?php // $this->render('guest/video') ?>
	<?= $this->render('guest/subcribe') ?>
	<?= $this->render('guest/news') ?>
	
	<?= $this->render('guest/footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
