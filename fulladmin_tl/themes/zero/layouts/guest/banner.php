<?php 
$posts = \app\modules\dashboard\models\Posts::getPostByType('SLIDE',5);
?>

<div class="banner-carousel banner-carousel-1 mb-0">
<?php foreach ($posts as $iPost=>$post){ ?>
 <div class="banner-carousel-item" style="background-image:url(<?= $post->imgCover ?>)">
    <div class="slider-content text-right">
        <div class="container h-100">
          <div class="row align-items-center h-100">
              <div class="col-md-12">
                <h2 class="slide-title" data-animation-in="slideInDown"><?= $post->title ?></h2>
                <h3 class="slide-sub-title" data-animation-in="fadeIn"><?= $post->getSummaryByChars() ?></h3>
                <p class="slider-description lead" data-animation-in="slideInRight"><?= $post->summary_one?></p>
                <div data-animation-in="slideInLeft">
                    <a href="<?= $post->summary_two ?>" class="slider btn btn-primary" aria-label="learn-more-about-us">Xem chi tiết</a>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
<?php } ?>


<!-- 
  <div class="banner-carousel-item" style="background-image:url(/ntweb/images/slider-main/bg3.jpg)">
    <div class="slider-content text-right">
        <div class="container h-100">
          <div class="row align-items-center h-100">
              <div class="col-md-12">
                <h2 class="slide-title" data-animation-in="slideInDown">Thi công công trình</h2>
                <h3 class="slide-sub-title" data-animation-in="fadeIn">Đội ngũ kỹ sư giàu kinh nghiệm</h3>
                <p class="slider-description lead" data-animation-in="slideInRight">Với hơn 20 năm kinh nghiệm trong lĩnh vực thi công xây dựng hạ tầng, cầu đường, thảm nhựa </p>
                <div data-animation-in="slideInLeft">
                   <a href="contact.html" class="slider btn btn-primary border" aria-label="contact-with-us">Gọi ngay</a>
                    <a href="about.html" class="slider btn btn-primary" aria-label="learn-more-about-us">Xem chi tiết</a>
                </div>
              </div>
          </div>
        </div>
    </div>
  </div>


  <div class="banner-carousel-item" style="background-image:url(/ntweb/images/slider-main/bg1.jpg)">
    <div class="slider-content">
        <div class="container h-100">
          <div class="row align-items-center h-100">
              <div class="col-md-12 text-center">
                <h2 class="slide-title" data-animation-in="slideInLeft">30 năm kinh nghiệm</h2>
                <h3 class="slide-sub-title" data-animation-in="slideInRight">Vật liệu xây dựng & Trang trí nội thất</h3>
                <p data-animation-in="slideInLeft" data-duration-in="1.2">
                    <a href="services.html" class="slider btn btn-primary">Xem thêm</a>
                </p>
              </div>
          </div>
        </div>
    </div>
  </div>

  <div class="banner-carousel-item" style="background-image:url(/ntweb/images/slider-main/bg2.jpg)">
    <div class="slider-content text-left">
        <div class="container h-100">
          <div class="row align-items-center h-100">
              <div class="col-md-12">
                <h2 class="slide-title-box" data-animation-in="slideInDown">Cấu kiện bê tông đúc sẵn</h2>
                <h3 class="slide-sub-title" data-animation-in="slideInLeft">Phục vụ đa dạng cho công trình của bạn</h3>
                <p data-animation-in="slideInRight">
                    <a href="services.html" class="slider btn btn-primary border">Xem thêm</a>
                </p>
              </div>
          </div>
        </div>
    </div>
  </div>
  -->

  <!-- <div class="banner-carousel-item" style="background-image:url(images/slider-main/bg3.jpg)">
    <div class="slider-content text-right">
        <div class="container h-100">
          <div class="row align-items-center h-100">
              <div class="col-md-12">
                <h2 class="slide-title" data-animation-in="slideInDown">Meet Our Engineers</h2>
                <h3 class="slide-sub-title" data-animation-in="fadeIn">We believe sustainability</h3>
                <p class="slider-description lead" data-animation-in="slideInRight">We will deal with your failure that determines how you achieve success.</p>
                <div data-animation-in="slideInLeft">
                    <a href="contact.html" class="slider btn btn-primary" aria-label="contact-with-us">Get Free Quote</a>
                    <a href="about.html" class="slider btn btn-primary border" aria-label="learn-more-about-us">Learn more</a>
                </div>
              </div>
          </div>
        </div>
    </div>
  </div> -->
</div>