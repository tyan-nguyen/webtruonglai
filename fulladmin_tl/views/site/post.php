<div class="post-content post-single">
	<?php if(isset($this->params['display_cover_first']) && $this->params['display_cover_first']){?>
    <div class="post-media post-image text-center">
        <img loading="lazy" src="<?= $post->imgCover ?>" class="img-fluid" alt="post-image">
    </div>
    <?php } ?>
    <div class="post-body">
    	
    	<?php if ($post->getCategoriesView() !=null){?>
        <div class="entry-header">
        	
            <div class="post-meta">
                <span class="post-cat">
                    <i class="far fa-folder-open"></i>
                    <?= $post->getCategoriesView() ?>
                </span>
                <span class="post-meta-date"><i class="far fa-calendar"></i> <?= $post->dateCreated ?></span>
            </div>
            
            <h1 class="entry-title">
                <?= $post->title ?>
            </h1>
        </div><!-- header end -->
     <?php } else { ?>
     	<div class="entry-header">        	
            <h2 class="entry-title text-center" style="text-transform: uppercase;">
                <?= $post->title ?>
            </h2>
        </div><!-- header end -->
     <?php } ?>
        <div class="entry-content">
        	<p><?= $post->summary ?></p>
            <?= $post->content ?>
            <p>
            	<img src="/ntweb/images/nguyen-trinh-loi-ket.jpg?v=1" style="width:100%" />
            </p>
        </div>
        <div class="tags-area d-flex align-items-center justify-content-between">
            <div class="post-tags">
            	<?= $post->geTagsView() ?>
                <!-- <a href="#">Construction</a>
                <a href="#">Safety</a>
                <a href="#">Planning</a> -->
            </div>
            <div class="share-items">
                <ul class="post-social-icons list-unstyled">
                    <li class="social-icons-head">Chia sẻ:</li>
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://nguyentrinh.com.vn<?= $post->url ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    
                </ul>
            </div>
        </div>
        
        
    </div><!-- post-body end -->
</div><!-- post content end -->
<?php if($postOthers != NULL){?>
<section id="news" class="news" style="padding:20px 0">
    <div class="container">
        <div class="row">
            <div class="col-12"  style="margin-bottom:10px">
                <h3 class="section-title">Bài viết khác</h3>
            </div>
        </div>
        <!--/ Title row end -->
        <div class="row">
        
        	<?php foreach ($postOthers as $iPost=>$post){?>        
            <div class="col-lg-4 col-md-6 mb-4">
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
                                <i class="fa fa-clock-o"></i> <?= $post->dateCreated ?>
                            </span>
                        </div>
                    </div>
                </div><!-- Latest post end -->
            </div><!-- 1st post col end -->
            <?php } ?>
            
        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section>
<?php } ?>