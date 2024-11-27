<?php 
use app\modules\dashboard\models\Posts;

$posts = Posts::getPostByType('POST',4,'hoat-dong-doanh-nghiep');
?>
<section id="news" class="news">
  <div class="container-fluid">
    <div class="row text-center">
        <div class="col-12">
          <h2 class="section-title">Bài viết</h2>
          <h3 class="section-sub-title">Thông tin mới nhất</h3>
        </div>
    </div>
    <!--/ Title row end -->

    <div class="row">
    
    	<?php foreach ($posts as $iPost=>$post){ ?>
    	<div class="col-lg-3 col-md-6 mb-4">
          <div class="latest-post">
              <div class="latest-post-media">
                <a href="<?= $post->url ?>" class="latest-post-img">
                    <img loading="lazy" class="img-fluid" src="<?= $post->imgCover ?>" alt="img">
                </a>
              </div>
              <div class="post-body">
                <h4 class="post-title">
                    <a href="<?= $post->url ?>" class="d-inline-block"><?= $post->title ?></a>
                </h4>
                <div class="latest-post-meta">
                    <span class="post-item-date">
                      <i class="fa fa-clock-o"></i><?= $post->dateCreated ?>
                    </span>
                </div>
              </div>
          </div><!-- Latest post end -->
        </div><!-- 1st post col end -->
    	<?php } ?>
    
       
    </div>
    <!--/ Content row end -->

    <div class="general-btn text-center mt-4">
        <a class="btn btn-primary" href="/posts">Xem thêm</a>
    </div>

  </div>
  <!--/ Container end -->
</section>