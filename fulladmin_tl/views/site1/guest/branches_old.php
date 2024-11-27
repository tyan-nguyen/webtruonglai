 <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title bg-light rounded h-100 p-5">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->branchesText ?></h5>
                        <h1 class="display-6 mb-4"><?= $setting->branchesTitle ?></h1>
                         <p class="mb-4"><?= $setting->branchesSummary ?></p>
                        <!-- <a href="appointment.html" class="btn btn-primary py-3 px-5">Appointment</a>-->
                    </div>
                </div>
                
                <?php 
                foreach ($branches as $indexBranch => $branch){
                ?>
                 <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="<?= $branch->image ?>" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <?php if($branch->twiter != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->twiter ?>"><i class="fab fa-twitter fw-normal"></i></a><?php }?>
                                <?php if($branch->facebook != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->facebook ?>"><i class="fab fa-facebook-f fw-normal"></i></a><?php }?>
                                <?php if($branch->likein != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->likein ?>"><i class="fab fa-linkedin-in fw-normal"></i></a><?php }?>
                                <?php if($branch->instagram != null){ ?><a class="btn btn-primary btn-square m-1" href="<?= $branch->instagram ?>"><i class="fab fa-instagram fw-normal"></i></a><?php }?>
                            </div>
                        </div>
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
                
                
                
                
               <!--  <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="img/team-1.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="img/team-2.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="img/team-3.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="img/team-4.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="img/team-5.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Team End -->