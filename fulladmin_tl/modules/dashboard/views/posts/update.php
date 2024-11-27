<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
?>
<div class="news-update">

<?php 
if(isset($fromcreate) && $fromcreate == true){
?>
<div class="alert alert-success" role="alert">
  <span class="glyphicon glyphicon-ok"></span> Post created!
</div>
<?php } ?>

<?php 
if(isset($showSuccessMessge)){
?>
<!-- <div class="alert alert-success" role="alert">
  <span class="glyphicon glyphicon-ok"></span> Post updated!
</div> -->

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><?= Yii::t('app', 'Notification!') ?></h4>
    <span class="glyphicon glyphicon-ok"></span> <?= Yii::t('app', 'Post updated!') ?>
</div>

<?php } ?>
<?php 
if(isset($showErrorMessge)){
?>
<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><?= Yii::t('app', 'Notification!') ?></h4>
<span class="glyphicon glyphicon-ok"></span> <?= Yii::t('app', 'Data save failed! Please check info!') ?>
</div>
<?php } ?>


    <?= $this->render('_form', [
        'model' => $model,
        'catalogLists' => $catalogLists
    ]) ?>

</div>
