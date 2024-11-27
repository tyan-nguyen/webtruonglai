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
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon1.ico')]);
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
	<?php if($this->params['showBanner']){ ?>
	<div id="banner-area" class="banner-area" style="background-image:url(<?= $this->params['image'] ?>)">
      <div class="banner-text">
        <div class="container">
            <div class="row">
              <div class="col-lg-12">
                  <div class="banner-heading">
                    <h1 class="banner-title"><?= $this->params['title'] ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                        	<?php 
                        	if(isset($this->params['breadcrumb'])){
                        	    foreach ($this->params['breadcrumb'] as $i=>$bread){
                        	        if(!$bread['active']){
                        	?>
                        	<li class="breadcrumb-item"><a href="<?= $bread['url'] ?>"><?= $bread['label'] ?></a></li>
                        	<?php 
                        	        } else {
                        	?>
                        	<li class="breadcrumb-item active" aria-current="page"><?= $bread['label'] ?></li>
                        	<?php             
                        	        }
                        	    }
                        	}
                        	?>
                        
                        
                         <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Company</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Contact Us</li> -->
                        </ol>
                    </nav>
                  </div>
              </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
      </div><!-- Banner text end -->
    </div><!-- Banner area end --> 
    <?php } ?>
    
	<section id="main-container" class="main-container">
		<?= $content ?>
	</section>
	<?= $this->render('guest/footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
