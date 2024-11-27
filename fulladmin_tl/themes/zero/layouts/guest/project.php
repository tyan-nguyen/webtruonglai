<?php 
    use app\modules\dashboard\models\PostPublic;

    $projectCats = PostPublic::getCategoriesPublic('PROJECT')->orderBy(['priority'=>SORT_ASC])->all();
    $projects = PostPublic::getPostsPublic('PROJECT')->orderBy(['date_created'=>SORT_DESC])->all();
?>

<section id="project-area" class="project-area">
  <div class="container-fluid">
    <div class="row text-center">
      <div class="col-lg-12">
        <h2 class="section-title">Nhà xưởng, Công trình, Dự án</h2>
        <h3 class="section-sub-title">Dự án đã thực hiện của Nguyễn Trình</h3>
      </div>
    </div>
    <!--/ Title row end -->

    <div class="row">
      <div class="col-12">
        <div class="shuffle-btn-group">
        
        	
        	
        
          <label class="active" for="all">
            <input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Tất cả
          </label>
          
          <?php foreach ($projectCats as $indexCat=>$cat){?>
          <label for="<?= $cat->slug ?>" class="">
            <input type="radio" name="shuffle-filter" id="<?= $cat->slug ?>" value="<?= $cat->slug ?>"><?= $cat->name ?>
          </label>
          <?php } ?>
          
          <!-- 
          <label for="commercial" class="">
            <input type="radio" name="shuffle-filter" id="commercial" value="commercial">Commercial
          </label>
          <label for="education" class="">
            <input type="radio" name="shuffle-filter" id="education" value="education">Education
          </label>
          <label for="government" class="">
            <input type="radio" name="shuffle-filter" id="government" value="government">Government
          </label>
          <label for="infrastructure" class="">
            <input type="radio" name="shuffle-filter" id="infrastructure" value="infrastructure">Infrastructure
          </label>
          <label for="residential" class="">
            <input type="radio" name="shuffle-filter" id="residential" value="residential">Residential
          </label>
          <label for="healthcare" class="">
            <input type="radio" name="shuffle-filter" id="healthcare" value="healthcare">Healthcare
          </label> -->
          
        </div><!-- project filter end -->


        <div class="row shuffle-wrapper shuffle" style="position: relative; overflow: hidden; height: 700px; transition: height 250ms cubic-bezier(0.4, 0, 0.2, 1) 0s;max-height:700px;">
          <div class="col-1 shuffle-sizer"></div>
          
          <?php foreach ($projects as $iProject=>$project){ 
              $group = '[&quot;' . str_replace(';', '&quot;,&quot;', $project->categories) . '&quot;]';
              ?>
          <div class="col-lg-3 col-md-6 shuffle-item shuffle-item--visible" data-groups="<?= $group ?>" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity; transform: translate(0px, 0px) scale(1);padding:5px">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="<?= $project->imgCover ?>" aria-label="project-img">
                <img class="img-fluid" src="<?= $project->imgCover ?>" alt="project-img">
                <span class="gallery-icon d-none d-sm-block"><i class="fas fa-eye"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="<?= $project->url ?>"><?= $project->title ?></a>
                  </h3>
                  <p class="project-cat"><?= $project->getCategoriesView(false) ?></p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 1 end -->
          <?php } ?>
          
          
          
          
<?php /* ?>
          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;government&quot;,&quot;healthcare&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity; transform: translate(0px, 0px) scale(1);">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project1.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project1.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">Capital Teltway Building</a>
                  </h3>
                  <p class="project-cat">Commercial, Interiors</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 1 end -->

          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;healthcare&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(380px, 0px) scale(1); transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project2.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project2.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">Ghum Touch Hospital</a>
                  </h3>
                  <p class="project-cat">Healthcare</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 2 end -->

          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;infrastructure&quot;,&quot;commercial&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(760px, 0px) scale(1); transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project3.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project3.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">TNT East Facility</a>
                  </h3>
                  <p class="project-cat">Government</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 3 end -->

          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;education&quot;,&quot;infrastructure&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(0px, 304px) scale(1); transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project4.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project4.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">Narriot Headquarters</a>
                  </h3>
                  <p class="project-cat">Infrastructure</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 4 end -->

          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;infrastructure&quot;,&quot;education&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(380px, 304px) scale(1); transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project5.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project5.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">Kalas Metrorail</a>
                  </h3>
                  <p class="project-cat">Infrastructure</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 5 end -->

          <div class="col-lg-4 col-md-6 shuffle-item shuffle-item--visible" data-groups="[&quot;residential&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(760px, 304px) scale(1); transition-duration: 250ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
            <div class="project-img-container">
              <a class="gallery-popup cboxElement" href="/ntweb/images/projects/project6.jpg" aria-label="project-img">
                <img class="img-fluid" src="/ntweb/images/projects/project6.jpg" alt="project-img">
                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
              </a>
              <div class="project-item-info">
                <div class="project-item-info-content">
                  <h3 class="project-item-title">
                    <a href="projects-single.html">Ancraft Avenue House11</a>
                  </h3>
                  <p class="project-cat">Residential</p>
                </div>
              </div>
            </div>
          </div><!-- shuffle item 6 end -->
          
          <?php */ ?>
          
        </div><!-- shuffle end -->
      </div>

      <div class="col-12">
        <div class="general-btn text-center">
          <a class="btn btn-primary" href="/projects">Xem thêm</a>
        </div>
      </div>

    </div><!-- Content row end -->
  </div>
  <!--/ Container end -->
</section>