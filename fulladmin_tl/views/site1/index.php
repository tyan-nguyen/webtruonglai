<?php 
use yii\helpers\Html;

//Yii::$app->language = 'vi';
?>
    <?= $this->render('guest/carousel', ['list'=>$carousel, 'setting' => $setting]) ?>

	
	<?= $this->render('guest/banner', ['setting' => $setting, 'servicesList'=>$servicesList]) ?>
    

    <?= $this->render('guest/about', ['setting' => $setting]) ?>


	<?= $this->render('guest/services', ['services' => $services, 'setting' => $setting]) ?>
    
   
    <!-- Map Start -->
    <div class="container-fluid bg-offer my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
    
        <div class="container py-12">
        	<div class="row justify-content-center">
            	<div class="col-lg-12" style="text-align:center">
                	<ul class="ulmap">
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
        </div>
    </div>
    <!-- Map End -->
    
    <?= $this->render('guest/news', ['news' => $blogs, 'setting' => $setting]) ?>
    
    
	<?= $this->render('guest/showcases', ['showcases' => $showcases, 'setting' => $setting]) ?>
	
	
	<?= $this->render('guest/video') ?>

    <!-- Testimonial Start -->
    <!-- div id="dBlog" class="container-fluid bg-primary bg-testimonial py-5 my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel rounded p-5 wow zoomIn" data-wow-delay="0.6s">
                    	<?php 
                    	foreach ($blogs as $indexBlog => $blog){
                    	?>
                        <div class="testimonial-item text-center text-white">
                            <h2><a href="<?= $blog->url ?>"><?= $blog->title ?></a></h2>
                            <p class="fs-5"><?= $blog->summary500 ?></p>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0"><a href="/blog"><?= Yii::t('app', 'Lasted Blog') ?></a></h4>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Testimonial End -->

    
    <?= $this->render('guest/sustainability', ['setting' => $setting]) ?>
	<!-- end gia tri ben vung -->

<?= $this->render('guest/branches', ['branches' => $branches, 'setting' => $setting]) ?>