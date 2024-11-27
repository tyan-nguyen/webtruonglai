<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn"><?= Yii::t('app', 'About Us')?></h1>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'Home')?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'About')?></a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title mb-4">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->aboutText ?></h5>
                    <h1 class="display-5 mb-0"><?= $setting->aboutTitle ?></h1>
                </div>
                <h4 class="text-body fst-italic mb-4"><?= $setting->aboutSummary1 ?></h4>
                <p class="mb-4"><?= $setting->aboutSummary2 ?></p>
                <div class="row g-3">
                	<?php 
                	foreach ($setting->aboutFact as $indexFact => $fact){
                	?>
                	 <div class="col-sm-12 wow zoomIn" data-wow-delay="0.3s">
                        <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i><?= $fact ?></h5>
                    </div>
                	<?php } ?>
                </div>
                <a href="/contact" class="btn btn-primary py-3 px-5 mt-4 wow zoomIn" data-wow-delay="0.6s"><?= Yii::t('app', 'Make Appointment') ?></a>
            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="<?= $setting->about_image ?>" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
        
        <!-- About 2 Start -->
         <div class="container about2">
            <div class="row g-5">
            	<div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="<?= $setting->about2_image ?>" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                        
                        <h1 class="display-5 mb-0"><?= $setting->getAbout2Title() ?></h1>
                    </div>
                    <h4 class="text-body mb-4">
                    	<?= $setting->getAbout2Summary() ?>
                    </h4>
                    
                    
                </div>
                
            </div>
        </div>
        <!-- About 2 End -->
        
        
        
        
         <!-- Pricing Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="section-title mb-4">
                        <h1 class="display-5 mb-0"><?= $setting->getAbout3Text() ?></h1>
                    </div>
                   <div class="row g-3">
                        <div class="col-sm-12 wow zoomIn" data-wow-delay="0.3s">
                        
                        <?php 
                	foreach ($setting->getAbout3Content() as $indexFact => $fact){
                	?>
                	
                    
                    	<h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>
                            	<?= $fact ?>
						</h5>
							
                	<?php } ?>
                	
                            
                            
                        </div>
                        <!-- <div class="col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>24/7 Opened</h5>
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Fair Prices</h5>
                        </div> -->
                    </div>
                </div>
                
                <div class="col-lg-6">
                        <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">
                        
                        <?php
                        foreach ($showcases as $indexShowcase=>$showcase){
                        ?>
                        <div class="price-item pb-4">
                                <div class="position-relative itemsContainer">
                                    <img class="img-fluid rounded-top" src="<?= $showcase->image ?>" alt="">
                                     <div class="play" onclick="openYoutube('<?= $showcase->showName ?>', '<?= $showcase->link_youtube ?>')"><img src="<?= Yii::getAlias('@web/images/icons/play.png') ?>" /> </div>
                                </div>
                                <div class="position-relative text-center bg-light border-bottom border-primary py-5 p-4">
                                    <h4><?= $showcase->showName ?></h4>
                                    <hr class="text-primary w-50 mx-auto mt-0">
                                    
                                </div>
                            </div>
                        <?php } ?>
                        
                        
                        
                        
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->
    
        
        
    </div>
    <!-- About End -->