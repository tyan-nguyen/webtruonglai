<?php 
    $setting = \app\modules\dashboard\models\Options::getOptions('SETTING'); 
?>
<div class="bg-white">
<div class="container">
  <div class="logo-area">
      <div class="row align-items-center">
        <div class="logo col-lg-2 text-center text-lg-left mb-2 mb-md-0 mb-lg-0">
            <a class="d-block" href="/">
              <img loading="lazy" src="<?= $setting['site_logo'] ?>" alt="Constra">
            </a>
        </div><!-- logo end -->
        <div  class="col-lg-10" style="padding:10px 0px;">
        	<div class="d-site-name"><span style="color:red;text-transform: uppercase;font-size:18px;font-weight: bold"><?= $setting['site_name'] ?></span></div>
        	<div class="d-site-sub">
	<span style="color:var(--bg-color);font-size:15px;font-weight: bold">Địa chỉ:  Ấp Giồng Trôm, Mỹ Chánh, Châu Thành, Trà Vinh</span> 
	<span style="color:var(--bg-color);font-size:15px;font-weight: bold"> - </span>
	<span style="color:var(--bg-color);font-size:15px;font-weight: bold">Số điện thoại: 01234.567.890
</span></div>
        
          <?php /* ?><div class="row">
            <div class="col-lg-12 header-right">
                <ul class="top-info-box">
                	<li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">&nbsp;</p>
                          <p class="info-box-subtitle" style="text-transform: uppercase;"><?= $setting['site_name'] ?></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Điện thoại</p>
                          <p class="info-box-subtitle"><?= $setting['site_hotline_text'] ?></p>
                      </div>
                    </div>
                  </li>
                  <!-- <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Địa chỉ Email</p>
                          <p class="info-box-subtitle"><?= $setting['site_email'] ?></p>
                      </div>
                    </div>
                  </li>
                  <li class="last d-none d-md-block">
                    <div class="info-box last">
                      <div class="info-box-content">
                          <p class="info-box-title">Mã số thuế</p>
                          <p class="info-box-subtitle"><?= $setting['site_mst'] ?></p>
                      </div>
                    </div>
                  </li> -->
                  <!-- <li class="last d-block d-md-none">
                      <a class="btn btn-primary" href="tel:<?= $setting['site_hotline'] ?>" style="color:white"><i class="fas fa-phone-alt"></i>&nbsp; GỌI NGAY</a>
                  </li> -->
                  <!-- <li class="header-get-a-quote last d-none d-md-block">
                    <a class="btn btn-primary" href="tel:<?= $setting['site_hotline'] ?>"><i class="fas fa-phone-alt"></i>&nbsp; GỌI NGAY</a>
                  </li> -->
                  <!-- <li class="header-get-a-quote last d-block d-md-none">
                    <a class="btn btn-primary btn-dark" href="/contact"><i class="fas fa-address-card"></i>&nbsp; LIÊN HỆ</a>
                  </li> -->
                  <li class="header-get-a-quote ">
                    <a class="btn btn-primary" href="#"><i class="fas fa-calendar-check"></i>&nbsp; ĐĂNG KÝ TRỰC TUYẾN</a>
                  </li>
                  <li class="header-get-a-quote last">
                    <a class="btn btn-primary" href="tel:<?= $setting['site_hotline'] ?>"><i class="fas fa-phone-alt"></i>&nbsp; GỌI NGAY</a>
                  </li>
                  
                </ul><!-- Ul end -->
              </div>

              <div class="col-lg-12 header-right">

              </div>

          </div><!-- header right end -->
        </div> <?*/?>

      </div><!-- logo area end -->

  </div><!-- Row end -->
</div><!-- Container end -->
</div>