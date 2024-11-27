<!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?= Yii::t('app', 'Contact Us') ?></h1>
                <a href="" class="h4 text-white"><?= Yii::t('app', 'Home') ?></a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white"><?= Yii::t('app', 'Contact Us') ?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase"><?= $setting->getContactText() ?></h5>
                            <h1 class="display-6 mb-4"><?= $setting->getContactTitle() ?></h1>
                        </div>
                        <?php 
                        $ctCon = $setting->getContactContent();
                        if($ctCon != null){
                            foreach ($ctCon as $indexCon => $con){
                                $conItem = explode('|', $con);
                                if(isset($conItem[0]) && isset($conItem[1])){
                        ?>
                        <div class="d-flex align-items-center mb-2">
                            <i class="<?= $conItem[0] ?> fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0"><?= $conItem[1] ?></h5>
                                <?php if(isset($conItem[2]) ) {  ?>
                                <span><?= $conItem[2] ?></span>
                            	<?php } ?>
                            </div>
                        </div>
                        <?php 
                                }
                            }
                        }
                        ?>
                        
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form action="/site/info-contact" method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" name="name" class="form-control border-0 bg-light px-4" placeholder="<?= Yii::t('app', 'Your Name') ?>" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" required="required" class="form-control border-0 bg-light px-4" placeholder="<?= Yii::t('app', 'Your Email (required)') ?>" style="height: 55px;">
                            </div>
                             <div class="col-12">
                                <input type="text" name="phone" class="form-control border-0 bg-light px-4" placeholder="<?= Yii::t('app', 'Your Phone') ?>" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control border-0 bg-light px-4" placeholder="<?= Yii::t('app', 'Subject') ?>" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea name="message" required="required" class="form-control border-0 bg-light px-4 py-3" rows="5" placeholder="<?= Yii::t('app', 'Message (required)') ?>"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3" type="submit"><?= Yii::t('app', 'Send Message') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                	
                   <!--  <iframe class="position-relative rounded w-100 h-100"
                        src="<?= $setting->map ?>"
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe> -->
                        
                         <!-- Map Start -->
                        
                            	<div class="row justify-content-center">
                                	<div class="col-lg-12" style="text-align:center">
                                    	<ul class="ulmap-contact">
                                    		<?php 
                                    		$countMap = 0;
                                    		foreach ($setting->listMap as $indexMap=>$map){
                                    		?>
                                    		<li><input onClick="changeMap(this)" <?= $countMap==0 ? 'checked' : '' ?> type="radio" id="radio-1" name="radio-1" value="<?= $map ?>"> <?= $indexMap ?></li>
                                    		<?php
                                    		  $countMap++;
                                    		}
                                    		?>
                                    		<!-- <li><input onClick="changeMap(this)" checked type="radio" id="radio-1" name="radio-1" value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5723.825837906647!2d106.77691103005164!3d10.890222031753956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d75fb25e520d%3A0x869bfd7c0b43eca4!2sC%C3%B4ng%20ty%20TNHH%20APEIRON%20BIOENERGY%20(Vi%E1%BB%87t%20Nam)!5e0!3m2!1sen!2s!4v1681005437821!5m2!1sen!2s"> Kho Bình Dương</li>
                                    		<li><input onClick="changeMap(this)" type="radio" id="radio-1" name="radio-1" value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3927.693039920593!2d105.687917!3d10.1241926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0851a2a478199%3A0x18bd88ce74f3f82!2sKho%20C%E1%BA%A7n%20Th%C6%A1-%20C%C3%B4ng%20ty%20Apeiron%20Bioenergy%20(%20Viet%20Nam)!5e0!3m2!1sen!2s!4v1681006199837!5m2!1sen!2s"> Kho Cần Thơ</li>
                                    		<li>Kho Hà Nội</li>	 -->
                                    	</ul>
                                    </div>
                            	</div>
                            	
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 wow zoomIn" data-wow-delay="0.6s">
                                        <iframe id="ifr-map" src="<?= $setting->mapSrcDefault ?>" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                           
                        <!-- Map End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->