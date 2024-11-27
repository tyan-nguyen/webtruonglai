<?php
use app\models\Custom;
use app\modules\admin\models\Catelogies;
$custom = new Custom();
?>

<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Blog</h1>
            <a href="" class="h4 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white">Blog</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- List Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-9">
            
            	<?php 
                    foreach ($model as $indexNew=>$new){
                ?>      
                    <div class="col-lg-12">
                        <div class="post-entry d-md-flex small-horizontal mb-5">
                            <div class="me-md-5 thumbnail mb-3 mb-md-0">
                                <img src="<?= $new->imageCover ?>" alt="Image" class="img-fluid">
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
             <div class="col-lg-3">
             	 <h4 class="text-body fst-italic mb-4">Categories</h4>
             	  <ul class="blog">
                 	<?php 
                     	foreach ($cats as $indexCat => $cat){
                     	    $catModel = Catelogies::findOne($indexCat);
                     	    if($catModel != null){
                    ?>
                    			<li><a href="<?= $catModel->url ?>"><?= $cat ?></li>
                    <?php    
                     	    }
                     	}
                 	?>
                 	</ul>
             </div>
         </div>
    </div>
</div>