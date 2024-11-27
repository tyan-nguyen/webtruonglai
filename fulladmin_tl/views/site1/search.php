<?php
use app\models\Custom;
use app\modules\admin\models\News;
use app\modules\admin\models\Catelogies;
$custom = new Custom();
?>
<?php if($model != null) { ?>
<div class="section pb-0" style="padding-top:20px;margin-bottom:20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="heading">Kết quả tìm kiếm</h2>
            </div>
        </div>
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
                    </div>
                </div>
            </div>
        
        <?php 
        } 
        ?>       
        
        <div style="with:100%">
        	<?= $prev == null ? '' : '<a href="'.Yii::getAlias('@web/site/search?search='). $search . '&page=' . $prev .  '" class="btn btn-primary float-start">Previous page</a>' ?>
        	
        	<?= $next == null ? '' : '<a href="'.Yii::getAlias('@web/site/search?search='). $search . '&page=' . $next .  '" class="btn btn-primary float-end">Next page</a>' ?>
        </div>        
     
        </div>
    </div>
</div>
<?php } else { 
    $this->registerMetaTag([ 'name' => 'robots', 'content' => 'noindex,nofollow' ]);
?>
<div class="section pb-0" style="padding-top:20px;margin-bottom:20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="heading">Kết quả tìm kiếm</h2>
            </div>
        </div>
        <div class="row justify-content-center">
        
        	Không tìm thấy!
        
     
        </div>
    </div>
</div>
<?php } ?>