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