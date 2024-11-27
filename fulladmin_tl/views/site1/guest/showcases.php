 <!-- Pricing Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="section-title mb-4">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->showcaseText ?></h5>
                        <h1 class="display-5 mb-0"><?= $setting->showcaseTitle ?></h1>
                    </div>
                    <p class="mb-4"><?= $setting->showcaseSummary ?></p>
                   <!-- <h5 class="text-uppercase text-primary wow fadeInUp" data-wow-delay="0.3s">Call for Appointment</h5>
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s">+012 345 6789</h1> --> 
                </div>
                <div class="col-lg-7">
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