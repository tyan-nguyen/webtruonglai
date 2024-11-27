<?php
use app\models\Custom;
use app\modules\admin\models\News;
use app\modules\admin\models\Catelogies;
$custom = new Custom();
?>
    
<?php if($model != null) { ?>
<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn"><?= Yii::t('app', 'Blogs') ?></h1>
            <a href="/" class="h4 text-white"><?= Yii::t('app', 'Home') ?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="/blog" class="h4 text-white"><?= Yii::t('app', 'Blogs') ?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="#" class="h4 text-white"><?= $modelCat->name ?></a>
            
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="section pb-0" style="padding-top:20px;margin-bottom:20px;">
    <div class="container">
        <!-- <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-12">
                <h2 class="heading"><?= $modelCat->name ?></h2>
            </div>
        </div>-->
        <div class="row justify-content-center">
        
        <?php 
        foreach ($model as $indexNew=>$new){
        ?>
        
        
            <div class="col-lg-12">
                <div class="post-entry d-md-flex small-horizontal mb-5">
                    <div class="me-md-5 thumbnail mb-3 mb-md-0">
                        <img src="<?= $new->cover ?>" alt="Image" class="img-fluid">
                    </div>
                    <div class="content">
                        <div class="post-meta mb-3">
                        	<?php 
                        	$linking = ',';
                        	$numCount = count($new->catelogiesList);
                        	$indexCount = 0;
                        	foreach ($new->catelogiesList as $indexCat=>$cat){
                        	    $indexCount ++;
                        	    if($indexCount == $numCount)
                        	        $linking = '&mdash;';
                        	?>
                        	<a href="<?= Yii::getAlias('@web') . Catelogies::URL_CATELOGIES . $indexCat ?>" class="category"><?= $cat ?></a>
                        	<?= $linking ?>
                        	<?php 
                        	}
                        	?>
                            
                            <span class="date"><?= $custom->convertYMDHIStoDMY($new->date_created) ?></span>
                        </div>
                        <h2 class="heading"><a href="<?= $new->url ?>"><?= $new->title ?></a></h2>
                         <p><?= $new->summary300 ?></p>
                       <!--  <a href="#" class="post-author d-flex align-items-center">
                            <div class="author-pic">
                                <img src="assets/theme4/images/xperson_1.jpg.pagespeed.ic.Zebptmx_f8.webp" alt="Image">
                            </div>
                            <div class="text">
                                <strong>Sergy Campbell</strong>
                                <span>Author, 26 published post</span>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
        
        <?php 
        }
        ?>
        
         <div style="with:100%">
        	<?= $prev == null ? '' : '<a href="'. $modelCat->url . '?page=' . $prev .  '" class="btn btn-primary float-start">Previous page</a>' ?>
        	
        	<?= $next == null ? '' : '<a href="'. $modelCat->url . '?page=' . $next .  '" class="btn btn-primary float-end">Next page</a>' ?>
        </div>
     
        </div>
    </div>
</div>
<?php } ?>