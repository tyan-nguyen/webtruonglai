<?php
$posts = \app\modules\dashboard\models\PostPublic::getPostsPublic('KHOAHOC')
->orderBy(['date_created'=>SORT_ASC])
->offset(0)
->limit(10)
->all();
?>

<section id="ts-khoa-hoc" class="ts-service-area pb-0">
 <div class="container-fluid">
	<div class="row text-center">
        <div class="col-12">
          <h2 class="section-title">Trung tâm Giáo dục nghề nghiệp và sát hạch lái xe cơ giới đường bộ Nguyễn Trình</h2>
          <h3 class="section-sub-title" style="margin: 0 0 20px">Địa chỉ</h3>
        </div>
    </div>
    <!--/ Title row end -->
	<div class="row">
	
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d62899.89721493952!2d106.32065431370091!3d9.829898472573039!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a03d002855b71b%3A0x89cfff4f595f89f9!2zVFJVTkcgVMOCTSBHRE5OICYgU8OBVCBI4bqgQ0ggTMOBSSBYRSBOR1VZ4buETiBUUsOMTkg!5e0!3m2!1svi!2s!4v1732865255541!5m2!1svi!2s" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	
    </div>
</div>
</section><!-- Service end -->
