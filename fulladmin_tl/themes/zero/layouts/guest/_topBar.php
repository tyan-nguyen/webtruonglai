<?php 
use app\modules\dashboard\models\Links;
$socialLink = Links::find()->where(['type'=>'SOCIAL_LINK'])->all();
$setting = \app\modules\dashboard\models\Options::getOptions('SETTING');
?>
<div id="top-bar" class="top-bar">
    <div class="container">
          <div class="row">
            <div class="col-lg-2 .d-none .d-md-block .d-lg-block">

            </div>
            <div class="col-lg-10 top-bar-main">
             
              <div class="row">
                <div class="col-lg-8 col-md-8">
                <ul class="top-info text-center text-md-left">
                    <li><p class="info-text"><i class="fas fa-map-marker-alt"></i>  <?= $setting['site_address'] ?></p>
                    </li>
                </ul>
              </div>
              <!--/ Top info end -->

          <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
            <ul class="list-unstyled">
            
            	<?php 
              	foreach ($socialLink as $iLink=>$link){
              ?>
              <li><a <?= $link->open_new_tab ? 'target="_bank"' : '' ?> href="<?= $link->link ?>">
                      <span class="social-icon"><?= $link->name ?></span>
                  </a></li>
              <?php     
              }
              ?>

            </ul>
          </div>
          <!--/ Top social end -->
          </div>
       
        	</div>
          
      	</div>
      <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</div>