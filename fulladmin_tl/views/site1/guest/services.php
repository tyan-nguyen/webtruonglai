    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 mb-5">
                <!-- <div class="col-lg-5 wow zoomIn" data-wow-delay="0.3s" style="min-height: 400px;">
                    <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/before.jpg" style="object-fit: cover;">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/after.jpg" style="object-fit: cover;">
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="section-title mb-5">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->serviceText ?></h5>
                        <h1 class="display-5 mb-4"><?= $setting->serviceTitle ?></h1>
                        <p class="mb-4"><?= $setting->serviceSummary ?></p>
                    </div>
                    <div class="row g-5">
                    <?php 
                    foreach ($services as $indexService => $service){
                    ?>
                     <div class="col-md-3 service-item wow zoomIn" data-wow-delay="0.6s">
                            <div class="rounded-top overflow-hidden">
                                <a href="<?= $service->showLink ?>"><img class="img-fluid" src="<?= $service->image ?>" alt=""></a>
                            </div>
                            <div class="position-relative bg-light rounded-bottom text-center p-4">
                            	<?php // if($service->link != null) {?>
                            	<h5 class="m-0"><a href="<?= $service->showLink ?>"><?= $service->showName ?></a></h5>
                            	<?php /*} else {?>
                                <h5 class="m-0"><?= $service->showName ?></h5>
                                <?php } */ ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    
                    
                    
                      
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Service End -->