 <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?= Yii::t('app', 'Products')?></h1>
                <a href="" class="h4 text-white"><?= Yii::t('app', 'Home')?></a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white"><?= $productModel->getShowName() ?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->

	
	
   <!-- Product Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
        	
            <div class="row g-5 mb-5">
            	<?php if ($setting->show_service_image == true) { ?>
            	<div class="col-lg-12">
            		<img src="<?= $setting->service_image ?>" width="100%" />
            	</div>
            	<?php } ?>
               <div class="col-lg-5 wow zoomIn" data-wow-delay="0.3s" style="min-height: 400px;">
                    <!-- <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/before.jpg" style="object-fit: cover;">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/after.jpg" style="object-fit: cover;">
                    </div> -->
                     <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-4">
                        <?= $setting->siteIndexBlock2 ?>
                    </div>
                    
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-3">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->serviceText ?></h5>
                        
                       
                         
                        <h1 class="display-5 mb-3"><?= $productModel->getShowName() ?></h1>
                        <!-- <p class="mb-4"><?= $setting->serviceSummary ?></p> -->
                        
                         <div class="col-md-12 service-item wow zoomIn" data-wow-delay="0.6s">
                            <div class="rounded-top overflow-hidden">
                             	<img class="img-fluid" style="display:block;margin-left:auto;margin-right:auto" src="<?= $productModel->image ?>" alt="">
                         	</div>
                         </div>
                       
                       
                    </div>
                    <div class="row">
                    	<p><?= $productModel->getShowSummary() ?></p>                        
                        
                    </div>
                    
                    
                    <div class="section-title mb-3">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= Yii::t('app', 'Other Products') ?></h5>
                    </div>
                    <div class="row g-5">
                    	
                        <?php 
                        foreach ($products as $indexProduct => $product){
                        ?>
                         <div class="col-md-6 service-item wow zoomIn" data-wow-delay="0.6s">
                                <div class="rounded-top overflow-hidden">
                                    <a href="<?= $product->showLink ?>"><img class="img-fluid" src="<?= $product->image ?>" alt=""></a>
                                </div>
                                <div class="position-relative bg-light rounded-bottom text-center p-4">
                                	<h5 class="m-0"><a href="<?= $product->showLink ?>"><?= $product->showName ?></a></h5>
                                </div>
                            </div>
                        <?php } ?>
                        
                        
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    <!-- Product End -->