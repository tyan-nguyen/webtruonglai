<?php 
use app\modules\dashboard\models\Posts;

$posts = Posts::getPostByType('POST',5, 'video');
?>

<section class="content content-posts content-dark">
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
          <h3 class="column-title"><a href="/posts/video">Video mới nhất</a></h3>
		<div id="testimonial-slide" class="testimonial-slide">
		<?php foreach ($posts as $iPost=>$post){ ?>
		
          
              <div class="item">
                
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
                
              </div>
              <!--/ Item 1 end -->
		<?php } ?>	
				
				<?php /* ?>
              <div class="item">
                <div class="quote-item">
                    <span class="quote-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done idunt ut
                      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitoa tion ullamco laboris
                      nisi aliquip consequat.
                    </span>

                    <div class="quote-item-footer">
                      <img loading="lazy" class="testimonial-thumb" src="/ntweb/images/clients/testimonial2.png" alt="testimonial">
                      <div class="quote-item-info">
                          <h3 class="quote-author">Weldon Cash</h3>
                          <span class="quote-subtext">CFO, First Choice</span>
                      </div>
                    </div>
                </div><!-- Quote item end -->
              </div>
              <!--/ Item 2 end -->

              <div class="item">
                <div class="quote-item">
                    <span class="quote-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done idunt ut
                      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitoa tion ullamco laboris
                      nisi ut commodo consequat.
                    </span>

                    <div class="quote-item-footer">
                      <img loading="lazy" class="testimonial-thumb" src="/ntweb/images/clients/testimonial3.png" alt="testimonial">
                      <div class="quote-item-info">
                          <h3 class="quote-author">Minter Puchan</h3>
                          <span class="quote-subtext">Director, AKT</span>
                      </div>
                    </div>
                </div><!-- Quote item end -->
              </div>
              <!--/ Item 3 end -->
             <?php */ ?>

          </div>
          <!--/ Testimonial carousel end-->
        </div><!-- Col end -->

       

    </div>
    <!--/ Content row end -->
  </div>
  <!--/ Container end -->
</section><!-- Content end -->