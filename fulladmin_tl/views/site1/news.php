<?php
use app\models\Custom;
use app\modules\admin\models\Catelogies;
use yii\helpers\Html;
use app\models\Settings;
$custom = new Custom();
$setting = Settings::find()->one();
?>

<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn"><?= Yii::t('app', 'Blogs') ?></h1>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'Home') ?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'Blogs') ?></a>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="section post-section pt-5" style="padding-bottom:20px; text-align:justify;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 news-content">
                <div class="text-center">
                    <?php 
                    	$numCount = count($model->catelogiesList);
                    	$indexCount = 0;
                    	foreach ($model->catelogiesList as $indexCat=>$cat){
                	?>
                	<a href="<?= Yii::getAlias('@web') . Catelogies::URL_CATELOGIES . $indexCat ?>" class="category">
                		<span class="badge rounded-pill bg-warning text-dark"><?= $cat ?></span></a>
                	<?php 
                	   }
                	?>
               </div>      	
               
                <h2 class="heading text-center" style="margin:20px 0"><?= $model->title ?></h2>
                <?php if($model->summary != null) { ?> <p class="lead mb-4 text-center"><?= $model->summary ?></p> <?php } ?>
                
                <?php if ($setting->show_cover_after_summary) { ?>
                	<img src="<?= $model->cover ?>" alt="Image" class="img-fluid rounded mb-4">
                <?php } ?>

                 <?= $model->content ?>               
                 
                <div class="row border-top" style="padding-top:10px;padding-bottom:10px;">
                    <?php if($model->tags != null) { ?>
                         <div class="col-12">
                             Từ khóa:
                             <?php 
                             $sumTag = count($model->getListTags());
                             $iTag = 0;
                             foreach ($model->getListTags() as $indexTag=>$tagName){
                                 echo Html::a($tagName, Yii::getAlias('@web/tag/') .$indexTag);
                                 $iTag ++;
                                 if($iTag < $sumTag)
                                     echo ', ';
                             }
                             
                             ?>
                         </div>
                         <?php } ?>
                        <div class="col-12">
                            <span class="fw-bold text-black small mb-1"><?= Yii::t('app', 'Share') ?></span>
                            <ul class="social list-unstyled">
                                <li>
                                    
                                    <div id="fb-root"></div>
    								<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="zpL6GigF"></script>
                                    <div class="fb-share-button" data-href="<?= \Yii::$app->params['siteUrl'] . '/' . Yii::$app->request->url  ?>" data-layout="button" data-size="small"><a rel="nofollow" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                                
                                </li>
                                <li>
                                <a rel="nofollow" class="twitter-share-button"
                                  href="https://twitter.com/intent/tweet">
                               <span class="icon-twitter"></span></a>
                                </li>
                                <!-- <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon-pinterest"></span></a></li>-->
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php if($news != null) { ?>
<div class="section pb-0" style="padding-top:10px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="heading"><?= Yii::t('app', 'Realted Blogs')?></h2>
            </div>
        </div>
        
        <div class="row justify-content-center">        
        <?php 
        foreach ($news as $indexNew=>$new){
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
     
        </div>
    </div>
</div>
<?php } ?>