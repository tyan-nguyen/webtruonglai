 <!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn"><?= $setting->getBranchesPageName() ?></h1>
            <a href="" class="h4 text-white"><?= Yii::t('app', 'Home')?></a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white"><?= $setting->getBranchesPageName() ?></a>
        </div>
    </div>
</div>
<!-- Hero End -->
       <!-- Service Start -->

        <div class="container" style="margin-top:30px;">
            <div class="row g-5 mb-5">
                <!-- <div class="col-lg-5 wow zoomIn" data-wow-delay="0.3s" style="min-height: 400px;">
                    <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/before.jpg" style="object-fit: cover;">
                        <img class="position-absolute w-100 h-100" src="<?php Yii::getAlias('@web') ?>/assets/guest/images/after.jpg" style="object-fit: cover;">
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="section-title">
                        <!-- <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->branchesText ?></h5>-->
                        <h1 class="display-5 mb-4"><?= $setting->branchesTitle ?></h1>
                        <p class="mb-4"><?= $setting->branchesSummary ?></p>
                    </div>
                </div>
            </div>

        </div>
   
    <!-- Service End -->
   
   <!-- About 2 Start -->
         <div class="container about2 global-presence">
            <div class="row g-5">
            	<div class="col-lg-7" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="<?= $setting->branches_fist_image ?>" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-5">
                    <h4 class="text-body mb-4">
                    	<?= $setting->getBranchesFirstContent() ?>
                    </h4>
                    
                    
                </div>
                
            </div>
        </div>
        <!-- About 2 End -->
 <!-- Team Start -->
 	<?php 
 	  if($setting->branches_show_default == true){
 	?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
            
            <div class="col-lg-12">
                <h1 class="display-5 mb-4"><?= $setting->branchesText ?></h1>
            </div>
                
                
                <?php 
                foreach ($branches as $indexBranch => $branch){
                ?>
                 <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                    <?php if ($branch->image != '') { ?>
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="<?= $branch->image ?>" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <?php if($branch->twiter != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->twiter ?>"><i class="fab fa-twitter fw-normal"></i></a><?php }?>
                                <?php if($branch->facebook != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->facebook ?>"><i class="fab fa-facebook-f fw-normal"></i></a><?php }?>
                                <?php if($branch->likein != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->likein ?>"><i class="fab fa-linkedin-in fw-normal"></i></a><?php }?>
                                <?php if($branch->instagram != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->instagram ?>"><i class="fab fa-instagram fw-normal"></i></a><?php }?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2"><?= $branch->country ?></h4>
                            <?php if($branch->name != null){ ?><p class="text-primary mb-0"><?= $branch->name ?></p><?php }?>
                            <?php if($branch->address != null){ ?><p class="text-primary mb-0"><?= Yii::t('app', 'Address')?>: <?= $branch->address ?></p><?php }?>
                            <?php if($branch->email != null){ ?><p class="text-primary mb-0"><?= Yii::t('app', 'Email')?>: <?= $branch->email ?></p><?php }?>
                            <?php if($branch->phone != null){ ?><p class="text-primary mb-0"><?= Yii::t('app', 'Phone')?>: <?= $branch->phone ?></p><?php }?>
                            <?php if($branch->website != null){ ?><p class="text-primary mb-0"><?= Yii::t('app', 'Website')?>: <?= $branch->website ?></p><?php }?>
                            <?php if($branch->other != null){ ?><p class="text-primary mb-0"><?= $branch->other ?></p><?php }?>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
                
            </div>
        </div>
    </div>
    <?php } //end if branches_show_default?>
    <!-- Team End -->
    
    
  