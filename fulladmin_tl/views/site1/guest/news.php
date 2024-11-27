    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-12">
                    <div class="section-title mb-5">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase">Blog</h5>
                        <h1 class="display-5 mb-4">Tin tức mới nhất</h1>
                    </div>
                    <div class="row g-5">
                    <?php 
                    foreach ($news as $indexNew => $new){
                    ?>
                     <div class="col-md-3 service-item wow zoomIn" data-wow-delay="0.6s">
                            <div class="rounded-top overflow-hidden">
                                <a href="<?= $new->url ?>"><img class="img-fluid img-news" src="<?= $new->cover ?>" alt=""></a>
                            </div>
                            <div class="position-relative bg-light rounded-bottom text-center p-4 title-news">
                            	<h5 class="m-0"><a href="<?= $new->url ?>"><?= $new->title ?></a></h5>
                            </div>
                        </div>
                    <?php } ?>
                    
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Service End -->