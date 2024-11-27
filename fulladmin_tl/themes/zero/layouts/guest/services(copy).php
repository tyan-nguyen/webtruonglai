<?php 
$postsLeft = \app\modules\dashboard\models\PostPublic::getPostsPublic('SERVICE')->orderBy(['date_created'=>SORT_ASC])->offset(0)->limit(3)->all();
$postsRight = \app\modules\dashboard\models\PostPublic::getPostsPublic('SERVICE')->orderBy(['date_created'=>SORT_ASC])->offset(3)->limit(3)->all();
?>

<section id="ts-service-area" class="ts-service-area pb-0">
  <div class="container">
    <div class="row text-center">
        <div class="col-12">
          <h2 class="section-title">Sản phẩm, dịch vụ của chúng tôi</h2>
          <h3 class="section-sub-title">Chúng tôi làm gì?</h3>
        </div>
    </div>
    <!--/ Title row end -->

    <div class="row">
        <div class="col-lg-4">
        
        <?php foreach ($postsLeft as $iPost=>$post){ ?>
        <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="<?= $post->imgCover ?>" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="<?= $post->summary_one ?>"><?= $post->title ?></a></h3>
                <p><?= $post->summary ?></p>
              </div>
          </div><!-- Service 1 end -->
        <?php } ?>
        
        <?php /* ?>
          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/contruction.png" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Thi công xây dựng hạ tầng</a></h3>
                <p>Lĩnh vực thi công xây dựng hạ tầng, lĩnh vực cầu đường, thảm nhựa, thi công ép cọc công trình</p>
              </div>
          </div><!-- Service 1 end -->

          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/service-icon1.png" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Cấu kiện bê tông đúc sẵn</a></h3>
                <p>Sản xuất, kinh doanh cấu kiện bê tông đúc sẵn phục vụ đa dạng cho công trình của Quý khách hàng</p>
              </div>
          </div><!-- Service 2 end -->

          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/gach-khong-nung-icon.png"  alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Gạch không nung</a></h3>
                <p>Sản xuất và kinh doanh Gạch không nung theo nhu cầu của Quý khách hàng</p>
              </div>
          </div><!-- Service 3 end -->
        <?php */ ?>
        </div><!-- Col end -->

        <!-- <div class="col-lg-4 text-center">
          <img loading="lazy" class="img-fluid" src="/ntweb/images/services/service-center.jpg" alt="service-avater-image">
        </div> --><!-- Col end -->
        <div class="col-lg-4  mt-5 mt-lg-0 mb-4 mb-lg-0">
        <?php foreach ($postsLeft as $iPost=>$post){ ?>
        <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="<?= $post->imgCover ?>" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="<?= $post->summary_one ?>"><?= $post->title ?></a></h3>
                <p><?= $post->summary ?></p>
              </div>
          </div><!-- Service 1 end -->
        <?php } ?>
		</div>
		
        <div class="col-lg-4 mt-5 mt-lg-0 mb-4 mb-lg-0">
        <?php foreach ($postsRight as $iPost=>$post){ ?>
        <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="<?= $post->imgCover ?>" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="<?= $post->summary_one ?>"><?= $post->title ?></a></h3>
                <p><?= $post->summary ?></p>
              </div>
          </div><!-- Service 1 end -->
        <?php } ?>
        	<?php /* ?>
          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/vlxd.png" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Vật liệu xây dựng - Trang trí nội thất</a></h3>
                <p>Kinh doanh: Gạch men và Granite, gạch bông, gạch kính và thiết bị vệ sinh với giá thành cạnh tranh</p>
              </div>
          </div><!-- Service 4 end -->

          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/door.png" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Cửa nhôm</a></h3>
                <p>Thiết kế, sản xuất và lắp đặt cửa nhôm, cam kết bảo hành 10 năm bảo đảm lợi ích tối đa cho khách hàng</p>
              </div>
          </div><!-- Service 5 end -->

          <div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="/ntweb/images/icon-image/driving.png" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="#">Đào tạo và Sát hạch lái xe</a></h3>
                <p>Trung tâm đào tạo và sát hạch lái xe cơ giới đường bộ loại I chuyên đào tạo và sát hạch nghề lái xe các hạng</p>
              </div>
          </div><!-- Service 6 end -->
          <?php */ ?>
        </div><!-- Col end -->
    </div><!-- Content row end -->

  </div>
  <!--/ Container end -->
</section><!-- Service end -->
