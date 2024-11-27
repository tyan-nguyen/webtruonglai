<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
        	<?php 
        	foreach ($list as $indexCarousel=>$carousel){
        	?>
        	 <div class="carousel-item <?= $indexCarousel==0?'active':''?>">
                <img class="w-100" src="<?= $carousel->image ?>" alt="<?= $carousel->titleSmall ?>">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                        	<?= $carousel->titleSmall ?>
                       </h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn"><?= $carousel->titleLarge ?></h1>
                        <?php if($carousel->default_button == true){ ?>
                        <a href="/contact" class="btn btn-primary py-md-3 px-md-5 animated slideInRight"><i class="fa fa-envelope" aria-hidden="true"></i> <?= Yii::t('app', 'Contact Us') ?></a>
                        <a href="tel:<?= $setting->top_hotline ?>" class="btn btn-secondary py-md-3 px-md-5 me-3 animated slideInLeft"><i class="fa fa-phone" aria-hidden="true"></i> <?= Yii::t('app', 'Call Us') ?></a>
                    	<?php } ?>
                    </div>
                </div>
            </div>
        	<?php } ?>
        
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?= Yii::t('app', 'Next') ?></span>
        </button>
    </div>
</div>
<!-- Carousel End -->