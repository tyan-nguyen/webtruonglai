<?php 
$posts = \app\modules\dashboard\models\PostPublic::getPostsPublic('SERVICE')->orderBy(['date_created'=>SORT_ASC])->offset(0)->limit(9)->all();
?>

<section id="ts-service-area" class="ts-service-area pb-0">
  <div class="container-fluid">
    <div class="row text-center">
        <div class="col-12">
          <h2 class="section-title">Sản phẩm, dịch vụ của chúng tôi</h2>
          <h3 class="section-sub-title">Chúng tôi làm gì?</h3>
        </div>
    </div>
    <!--/ Title row end -->
    
    <div class="row">
    <?php foreach ($posts as $iPost=>$post){ 
        if($iPost%3==0){ echo '<div class="col-lg-4">'; };
     ?>
     	<div class="ts-service-box d-flex">
              <div class="ts-service-box-img">
                <img loading="lazy" src="<?= $post->imgCover ?>" alt="service-icon">
              </div>
              <div class="ts-service-box-info">
                <h3 class="service-box-title"><a href="<?= $post->summary_one ?>"><?= $post->title ?></a></h3>
                <p><?= $post->summary ?></p>
              </div>
       </div><!-- Service 1 end -->
    <?php 
        if($iPost%3==2){ echo '</div>'; };
       } ?>
    </div>
    

  </div>
  <!--/ Container end -->
</section><!-- Service end -->
