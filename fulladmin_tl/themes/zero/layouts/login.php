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
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/1.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
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
	<?= $this->render('guest/news') ?>
	
	<?= $this->render('guest/footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
