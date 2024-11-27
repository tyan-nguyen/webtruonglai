<?php

use app\themes\zero\assets\IndexAssets;
use app\modules\dashboard\models\PostPublic;
use app\modules\dashboard\models\Catelogies;
use app\modules\dashboard\models\TagList;

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


$this->registerMetaTag(['property'=>'og:image', 'content'=>$this->params['meta_image'] ?? 'https://nguyentrinh.com.vn/images/default.jpg']);


$this->registerMetaTag(['name'=>'geo.region', 'content'=>'VN-TV']);
$this->registerMetaTag(['name'=>'geo.placename', 'content'=>'Trà Vinh']);
$this->registerMetaTag(['name'=>'geo.position', 'content'=>'9.9242715, 106.3373696']);
$this->registerMetaTag(['name'=>'ICBM', 'content'=>'9.9242715, 106.3373696']);

$listNewPosts = PostPublic::getPostsPublic('POST')->limit(4)->orderBy(['date_created'=>SORT_DESC])->all();
$listCategories = PostPublic::getCategoriesPublic('POST')->all();
$listTags = (new TagList())->getList();

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
      <div class="container">
        <div class="row">
    
          <div class="col-lg-8 mb-5 mb-lg-0">
				<?= $content ?>	
		 </div><!-- Content Col end -->
		 
      <div class="col-lg-4">

        <div class="sidebar sidebar-right">
          <div class="widget recent-posts">
            <h3 class="widget-title">Bài viết mới</h3>
            <ul class="list-unstyled">
            
            	<?php foreach ($listNewPosts as $iPost=>$post){ ?>
            	<li class="d-flex align-items-center">
                    <div class="posts-thumb">
                      <a href="<?= $post->url ?>"><img loading="lazy" alt="img" src="<?= $post->imgCover ?>"></a>
                    </div>
                    <div class="post-info">
                      <h4 class="entry-title">
                        <a href="<?= $post->url ?>"><?= $post->title ?></a>
                      </h4>
                    </div>
              	</li><!-- post end-->
            	<?php } ?>
            </ul>

          </div><!-- Recent post end -->

          <div class="widget">
            <h3 class="widget-title">Danh mục</h3>
            <ul class="arrow nav nav-tabs">
            <?php foreach ($listCategories as $iCat=>$cat){ ?>
            <li><a href="<?= $cat->url ?>"><?= $cat->name ?></a></li>
            <?php } ?>
             <!--  <li><a href="#">Construction</a></li>
              <li><a href="#">Commercial</a></li>
              <li><a href="#">Building</a></li>
              <li><a href="#">Safety</a></li>
              <li><a href="#">Structure</a></li> -->
            </ul>
          </div><!-- Categories end -->

          

          <div class="widget widget-tags">
            <h3 class="widget-title">Thẻ </h3>

            <ul class="list-unstyled">
                <?php foreach ($listTags as $slug=>$name){ ?>
                <li><a href="/tag/<?= $slug ?>"><?= $name ?></a></li>
                <?php } ?>
                
              <!-- <li><a href="#">Construction</a></li>
              <li><a href="#">Design</a></li>
              <li><a href="#">Project</a></li>
              <li><a href="#">Building</a></li>
              <li><a href="#">Finance</a></li>
              <li><a href="#">Safety</a></li>
              <li><a href="#">Contracting</a></li>
              <li><a href="#">Planning</a></li> -->
            </ul>
          </div><!-- Tags end -->


        </div><!-- Sidebar end -->
      </div><!-- Sidebar Col end -->

    </div><!-- Main row end -->

  </div><!-- Conatiner end -->
</section><!-- Main container end -->

		 
	<?= $this->render('guest/footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
