<?php
use yii\helpers\Html;
?>
<!-- Banner Start -->
<?php if($setting->show_index_block == true){ ?>
<div class="container-fluid banner mb-5" style="padding-left: 0px; padding-right: 0px;">
    <div class="container"  style="padding-left: 0px; padding-right: 0px;">
        <div class="row gx-0">
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                <div class="bg-primary d-flex flex-column p-5" style="height: 300px;">
                    <?= $setting->siteIndexBlock1  ?>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                <div class="bg-dark d-flex flex-column p-5" style="height: 300px;">
                    <h3 class="text-white mb-3"><?= Yii::t('app', "What's your interest?") ?></h3>
                    <form action="/service-contact" method="post">
                     <div class="date mb-3" data-target-input="nearest">
                        <input type="email" class="form-control bg-light border-0" name="email" required="required"
                            placeholder="<?= Yii::t('app', 'Your email') ?>"  style="height: 40px;">
                    </div>
                    <?php 
                        echo Html::dropDownList('service', '', $servicesList, [
                            'prompt'=>Yii::t('app', 'Select A Service'),
                            'class'=>'form-select bg-light border-0 mb-3',
                            'style'=>'height:40px;'
                        ])
                    ?>
                    <button type="submit" class="btn btn-light"><?= Yii::t('app', 'Send') ?></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                <div class="bg-secondary d-flex flex-column p-5" style="height: 300px;">
                    <?= $setting->siteIndexBlock2 ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- Banner Start -->
