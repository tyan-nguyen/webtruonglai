 <!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn"><?= $setting->getSustainabilityTitle() ?></h1>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'Home')?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white"><?= $setting->getSustainabilityTitle() ?></a>
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container">
            <div class="row g-5">
                <div class="col-lg-12">
                	<?= $setting->getSustainabilityContent() ?>
               	</div>
          </div>
     </div>
</div>