<?php 
use app\modules\dashboard\models\Links;
use app\modules\dashboard\models\Options;

$quickLink = Links::find()->where(['type'=>'QUICK_LINK'])->all();
$footerLink = Links::find()->where(['type'=>'FOOTER_LINK'])->all();
$socialLink = Links::find()->where(['type'=>'SOCIAL_LINK'])->all();

$setting = Options::getOptions('SETTING');
?>
<footer id="footer" class="footer bg-overlay">
<div class="footer-main">
  <div class="container-fluid">
    <div class="row justify-content-between">
      <div class="col-lg-4 col-md-6 footer-widget footer-about">
        <h3 class="widget-title">Thông tin</h3>
        <!-- <img loading="lazy" class="footer-logo" src="<?= $setting['site_logo_white'] ?>" alt="Constra"> -->
        <p class="big-title"><strong><?= $setting['site_name'] ?></strong></p>
        <!-- <p><?= $setting['site_description'] ?></p>-->
        <p>Địa chỉ: <?= $setting['site_address'] ?></p>
        <p>Mã số thuế: <?= $setting['site_mst'] ?></p>
        <p>Số điện thoại: <?= $setting['site_hotline'] ?></p>
        <p>Email: <?= $setting['site_email'] ?></p>
        <div class="footer-social">
          <ul>
          	<?php 
          	foreach ($socialLink as $iLink=>$link){
          ?>
          <li><a <?= $link->open_new_tab ? 'target="_bank"' : '' ?> href="<?= $link->link ?>"><?= $link->name ?></a></li>
          <?php     
          }
          ?>
          </ul>
        </div><!-- Footer social end -->
      </div><!-- Col end -->

     <!-- Col end -->

      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 footer-widget">
        <h3 class="widget-title">Facebook</h3>
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" nonce="L5mCPRLp"></script>
        <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100094631493232" data-tabs="timeline" data-width="" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100094631493232" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100094631493232">Nguyễn Trình Group</a></blockquote></div>
        <!-- <ul class="list-arrow">
        	<?php 
          foreach ($footerLink as $iLink=>$link){
          ?>
          <li><a <?= $link->open_new_tab ? 'target="_bank"' : '' ?> href="<?= $link->link ?>"><?= $link->name ?></a></li>
          <?php     
          }
          ?>
        
        </ul>-->
      </div><!-- Col end -->

      <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
        <h3 class="widget-title">Địa điểm</h3>
        <div class="working-hours">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d245.63233749748625!2d106.3375597152774!3d9.924179611521206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0175b80077a69%3A0x88e890ee0daf9887!2zQ-G7rWEgSMOgbmcgTmjDtG0gS8OtbmggLSBT4bqvdCBWbHhkIE5ndXnhu4VuIFRyw6xuaA!5e0!3m2!1svi!2s!4v1708161529516!5m2!1svi!2s" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

    </div><!-- Row end -->
  </div><!-- Container end -->
</div><!-- Footer main end -->

<div class="copyright">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="copyright-info text-center">
          <?= $setting['site_copyright'] ?>
        </div>
      </div>

     <!--  <div class="col-md-12">
        <div class="copyright-info text-center">
          <span>Distributed by <a href="https://themewagon.com/">Themewagon</a></span>
        </div>
      </div> -->

      <div class="col-md-12">
        <div class="footer-menu text-center">
          <ul class="list-unstyled mb-0">
          <?php 
          foreach ($footerLink as $iLink=>$link){
          ?>
          <li><a <?= $link->open_new_tab ? 'target="_blank"' : '' ?> href="<?= $link->link ?>"><?= $link->name ?></a></li>
          <?php     
          }
          ?>
          </ul>
        </div>
      </div>
    </div><!-- Row end -->

    <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
      <button class="btn btn-primary" title="Back to Top">
        <i class="fa fa-angle-double-up"></i>
      </button>
    </div>
    
    <a id="zalo" target="_bank" href="https://zalo.me/0903336470">
          <img src="/images/icons/zalo.png" width="35px" height="" style="padding-bottom: 2px">
    </a>
    
     <a id="messenger" target="_bank" href="https://www.facebook.com/messages/t/109789528842656">
          <img src="/images/icons/messenger.png" width="35px" height="" style="padding-bottom: 2px">
    </a>
    
     <a id="call" href="tel:<?= $setting['site_hotline'] ?>">
          <img class="trin-trin" src="/images/icons/call.png?v=3" width="35px" height="" style="padding-bottom: 2px">
    </a>

  </div><!-- Container end -->
</div><!-- Copyright end -->
</footer><!-- Footer end -->
