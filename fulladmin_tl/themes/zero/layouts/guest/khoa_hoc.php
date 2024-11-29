<?php 
$posts = \app\modules\dashboard\models\PostPublic::getPostsPublic('KHOAHOC')
    ->orderBy(['date_created'=>SORT_ASC])
    ->offset(0)
    ->limit(10)
    ->all();
?>

<section id="ts-khoa-hoc" class="ts-service-area pb-0">
 <div class="container">
	<div class="row text-center">
        <div class="col-12">
          <h2 class="section-title">Các khoá học đang mở tại trung tâm</h2>
          <h3 class="section-sub-title" style="margin: 0 0 20px">CÁC KHÓA HỌC</h3>
        </div>
    </div>
    <!--/ Title row end -->
	<div class="row">
	<?php foreach ($posts as $iPost=>$post): ?>
      <div class="col-lg-4 col-md-6">
        <div class="ts-pricing-box<?= ($post->summary_two==1?' ts-pricing-featured' : '') ?>">
          <div class="ts-pricing-header">
            <h2 class="ts-pricing-name"><?= $post->title ?></h2>
            <h2 class="ts-pricing-price">
              <strong><?= number_format($post->summary) ?></strong>
            </h2>
          </div><!-- Pricing header -->
          <div class="ts-pricing-features">
          
          	<?= $post->content ?>
          	
          </div><!-- Features end -->
          <!-- <div class="plan-action">
            <a href="#" class="btn btn-red">Đăng ký ngay</a>
          </div> -->
          <div class="ts-pricing-header ts-pricing-footer">
            <h2 class="ts-pricing-name"><a href="#">Đăng ký ngay</a></h2>
          </div><!-- Pricing header -->
        </div><!-- Plan 1 end -->
      </div><!-- Col end -->
	<?php endforeach; ?>
    </div>
</div>
</section><!-- Service end -->
