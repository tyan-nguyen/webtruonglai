<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\dashboard\models\Catelogies;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Catelogies */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Categories');
?>

<!-- editor -->
<script src="<?= Yii::getAlias('@web') ?>/assets/editor/tinymce/tinymce.min.js"></script>
<script src="https://www.responsivefilemanager.com/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" ></script>


<div class="catelogies-form">

<?php 
if(isset($showSuccessMessge)){
?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><?= Yii::t('app', 'Notification!') ?></h4>
    <span class="glyphicon glyphicon-ok"></span> <?= Yii::t('app', 'Data save successfull') ?>
</div>
<?php } ?>
<?php 
if(isset($showErrorMessge)){
?>
<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-warning"></i><?= Yii::t('app', 'Notification!') ?></h4>
<?= Yii::t('app', 'Data save failed! Please check info!') ?>
</div>
<?php } ?>


<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-9">
     <?= $form->errorSummary($model) ?>
     
    <?php $nameLabel = $model->getAttributeLabel('name') 
    	. ' <span class="seoButton label label-warning" title="Thay đổi liên kết"><i class="glyphicon glyphicon-link"></i></span>' ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($nameLabel) ?>
    <?php // $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
    
    
    	
    	<?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    	
    	
    	<div class="dSeo box block-form block-form-border" style="display:block">
    	
    	 <div class="box-header with-border block-form-title">
    	 	<i class="fa fa-bullhorn" aria-hidden="true"></i>
    	 	<h3 class="box-title">SEO</h3>
    	 </div>
    	 
    	 <div class="box-body">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
            	
            <?= $form->field($model, 'seo_description')->textarea(['rows' => 3]) ?>
            
                <?php $nameLabel = $model->getAttributeLabel('seo_image') 
        	. ' <a data-toggle="modal"  href="javascript:;" data-target="#myModalSeo" class="btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>' ?>
    	 
        	 <?= $form->field($model, 'seo_image')->textInput(['maxlength' => true, 'id'=>'fieldID5', /*'onchange'=>'changeCover()'*/])->label($nameLabel) ?>
        	 	
        	 <div id="dCover-fieldID5" class="dCover input-append">	  
            	  <img src="<?= $model->seo_image ?>" />
            </div>
        
        </div>
        
        <?php // $form->field($model, 'seo_title_en')->textInput(['maxlength' => true]) ?>
        	
        <?php // $form->field($model, 'seo_description_en')->textarea(['rows' => 3]) ?>
    
    </div>
    
    <?php
        $currentUrl = Yii::$app->request->url;
        $script = <<< JS
        $('.seoButton').on('click', function(){
        	$('.dSeo').toggle();
        });
        JS;
        $this->registerJs($script);
    ?>    	
        
            	
    	<?= $form->field($model, 'content')->textarea(['rows' => 3, 'id'=>'txtContent']) ?>
    	
    </div><!-- col-md-9 -->
    <div class="col-md-3">
    
    	<?php $nameLabel = $model->getAttributeLabel('cover') 
    	. ' <a data-toggle="modal"  href="javascript:;" data-target="#myModal" class="btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>' ?>
	 
    	 <?= $form->field($model, 'cover')->textInput(['maxlength' => true, 'id'=>'fieldID4', /*'onchange'=>'changeCover()'*/])->label($nameLabel) ?>
    	 	
    	 <div id="dCover-fieldID4" class="dCover input-append">	  
        	  <img src="<?= $model->cover ?>" />
        </div>
        
		<div class="row">
    		<div class="col-md-6">
    			<?= $form->field($model, 'priority')->textInput(['maxlength' => true]) ?>
    		</div>
    		<div class="col-md-6">
        		<?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>
    		</div>
		</div>
		<?= $form->field($model, 'status')->dropDownList($model->categoriesStatus, ['prompt'=>'-Select-']) ?>
		
		<?= $form->field($model, 'lang')->dropDownList(
         (isset($code) && $code != null) 
            ? $model->getLangAvailable($model->code) 
            : Yii::$app->params['langs'], 
         [
             'prompt'=>Yii::t('app', 'Select language'),
             'onchange'=>'ChangeLang()',
             'id'=>'txtLang'
         ]) ?>
         
          <?= $form->field($model,'pid')->dropDownList($model->lang==NULL ? [] : (new Catelogies())->getList($model->lang),
				['class'=>'form-control', 'prompt'=>'--Chọn--', 'id'=>'txtCat']) ?>
		
		<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Lưu lại', 
		        		['class' => 'btn btn-large btn-primary']) ?>
		    <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Lưu lại và thoát', 
		        		['name'=>'btnSubmit','value'=>'saveAndExit','class' => 'btn btn-large btn-primary']) ?>
	    </div>
	<?php } ?>

	</div>
    
    </div><!-- col-md-3 -->
    
    
    
   
            
   
  
	

    <?php ActiveForm::end(); ?>
</div><!-- row -->    
</div>



<script>
function ChangeLang(){
     $.ajax({
            url: '/dashboard/catelogies/change-lang',
           type: 'get',
           //dataType: 'json',
           data: {langid: $("#txtLang").val()},
           success: function (data) {
           		$('#txtCat').children().remove();
           		//ver json
           		/*$('#txtCat').append('<option value="">--Chọn--</option>');
           		for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                      $('#txtCat').append('<option value="'+key+'">'+ data[key] +'</option>');
                    }
                }*/
                //ver html
                $('#txtCat').html(data);
           }

      });
}
</script>


<script>
tinymce.remove();
//editor for content
tinymce.init({
	selector: "#txtContent",
	branding: false,
	statusbar: false,
	plugins: "media,image,paste,table,code,link,lists,advlist,responsivefilemanager,hr",
	menubar: 'edit view insert format table',
	toolbar: 'autolink | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist hr | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link unlink anchor codesample | ltr rtl | responsivefilemanager',
  	toolbar_sticky: true,
	paste_data_images: true,
	image_advtab: true,
	image_title: true,
	//images_upload_url: "<?= Yii::getAlias('@web') . '/assets/editor/upload.php' ?>", //upload img tab
	//images_upload_credentials: true,
	relative_urls : false,
	remove_script_host : true,
	document_base_url : "/",
	convert_urls : true,
	height : "800",
	
	external_filemanager_path:"<?= Yii::getAlias('@web') ?>/filemanager/filemanager/",
	filemanager_title:"QUẢN LÝ FILE" ,
	external_plugins: { "filemanager" : "<?= Yii::getAlias('@web') ?>/filemanager/filemanager/plugin.min.js"},
	filemanager_access_key: "<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>",

	language_url : '<?= Yii::getAlias('@web')?>/assets/editor/tinymce/langs/vi.js',
		
	setup: function (editor) {
	    editor.on('change', function () {
	        tinymce.triggerSave();
	    });
	}
});

//prevent Bootstrap from hijacking TinyMCE modal focus
$(document).on('focusin', function(e) {
  if ($(e.target).closest(".mce-window").length) {
    e.stopImmediatePropagation();
  }
});
</script>

<div class="modal modal2 fade" id="myModal" >
<div class="modal-dialog1" style="width:900px">
  <div class="modal-content" style="height:700px;">
    <div class="modal-header">
      <button id="btnfieldID4" data-dismiss="modal" type="button" class="close" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Modal title</h4>
    </div>
    <div class="modal-body">
      <iframe width="850" height="600" src="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID4'&fldr=_categories/<?= $model->code ?>&akey=<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal modal2 fade" id="myModalSeo" >
<div class="modal-dialog1" style="width:900px">
  <div class="modal-content" style="height:700px;">
    <div class="modal-header">
      <button id="btnfieldID5" data-dismiss="modal" type="button" class="close" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Modal title</h4>
    </div>
    <div class="modal-body">
      <iframe width="850" height="600" src="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID5'&fldr=_categories/<?= $model->code ?>&akey=<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 
$this->registerJsFile(Yii::getAlias('@web') . "/js/script.js", ['position' => \yii\web\View::POS_END, 'depends' => [
    \yii\web\JqueryAsset::className()
]]);
?>

<?php
$currentUrl = Yii::$app->request->url;
$script = <<< JS
//chua co
JS;
$this->registerJs($script);
?>

<script>

/* $('#changeLang2').on('click', function(){ // on change of state
  // if(this.checked) // if changed state is CHECKED
 //   {
       alert('kkk');
  //  }
}); */

/* 
/* $(function() {
    $("input[type='checkbox']:checked").change(function() {
		alert('kkk');
    })
}) */

function changeLang(){
	alert('kkk');
} */

/* function responsive_filemanager_callback(field_id){
	//console.log(field_id);
	var url=jQuery('#'+field_id).val();
	//alert('update '+field_id+" with "+url);
	//alert(url);
	$('#dCover img').attr('src', url);
	$('#btnModal2').click();	
} */

</script>

