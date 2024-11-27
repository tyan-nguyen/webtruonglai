<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use kartik\select2\Select2;
use app\modules\admin\models\TagList;
use yii\bootstrap\Modal;
use app\widgets\DocumentWidget;
use app\widgets\ImageWidget;
//use johnitvn\ajaxcrud\CrudAsset;

//CrudAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */

    $model->taglist = $model->listTagName;
?>


<!-- editor -->
<script src="<?= Yii::getAlias('@web') ?>/assets/editor/tinymce/tinymce.min.js"></script>
<!-- <script src="https://www.responsivefilemanager.com/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" ></script> -->


<?php 
/* $this->registerJsFile(
    'https://www.responsivefilemanager.com/fancybox/jquery.fancybox-1.3.4.pack.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
    ); */
?>

<div class="row">
	<?php $form = ActiveForm::begin([
        'id' => 'frmPost',
        //'enableAjaxValidation' => false,
        'options' => [ 'enctype' => 'multipart/form-data' ]
    ]); ?>
	<div class="col-md-9">

    
    
     <?= $form->errorSummary($model) ?>
     
     
     <a href="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID5'&fldr=<?= $model->code ?>&akey=<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>" class="btn iframe-btn" type="button">Open Filemanager</a>
     
     <?php
        $currentUrl = Yii::$app->request->url;
        $script = <<< JS
         $('.iframe-btn').fancybox({	
        	'width'		: 900,
        	'height'	: 600,
        	'type'		: 'iframe',
                'autoScale'    	: false
            });
        JS;
        $this->registerJs($script);
    ?>    
     

   	<?php $nameLabel = $model->getAttributeLabel('title') 
    	. ' <span class="seoButton label label-warning" title="Thay đổi liên kết"><i class="glyphicon glyphicon-link"></i></span>' ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label($nameLabel) ?>
	
	<?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>
	
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
	
    

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id'=>'txtContent']) ?>

    

  
	

   
    
</div>
<div class="col-md-3">


	
	
	
	
	
	 <?php $nameLabel = $model->getAttributeLabel('cover') 
    	. ' <a data-toggle="modal"  href="javascript:;" data-target="#myModal" class="btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>' ?>
	 
	 <?= $form->field($model, 'cover')->textInput(['maxlength' => true, 'id'=>'fieldID4', /*'onchange'=>'changeCover()'*/])->label($nameLabel) ?>
	 	
	 <div id="dCover-fieldID4" class="dCover input-append">	  
    	  <img src="<?= $model->cover ?>" />
    </div>
    
     <?= $form->field($model, 'post_status')->dropDownList($model->postStatus, []) ?>
     
     <?php // $form->field($model, 'site_keywords')->textInput(['maxlength' => true]) ?>
     
	 <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
	 
	 <?php //$form->field($model, 'is_static')->checkbox() ?>
	 
	 
	 <?php 
        if($model->isNewRecord)
            $model->lang = $lang;
    ?>
    
    
    <?php /* $form->field($model, 'lang')->dropDownList($model->langs, 
        ['id'=>'lang', 'disabled'=>$model->isNewRecord?false:true])
        ->label($model->isNewRecord?$model->getAttributeLabel('lang'):Yii::t('app', 'Change language') . ' <input id="changeLang" type="checkbox" />') */ ?>
    
	 <?=  $form->field($model, 'lang')->dropDownList(
         (isset($code) && $code != null) 
            ? $model->getLangAvailable($model->code) 
            : Yii::$app->params['langs'], 
         [
             'prompt'=>Yii::t('app', 'Select language'),
             'onchange'=>'ChangeLang()',
             'id'=>'txtLang'
         ]) ?>

    <?php // $form->field($model, 'catelogies')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group <?= isset($model->errors['catalog']) ? 'has-error' : '' ?>">
    	<label>Catelogies</label>
    	<div id="list-catalog" class="list-catalog">
			<?= $this->render('_catalog-tree', [
					'model'=>$model,
					'catalogLists'=>$catalogLists
			]) ?>
		</div>
    </div>
    
    <?= $form->field($model, 'taglist')->widget(Select2::classname(), [
	    'data' => (new TagList())->getListName(),
	    'language' => 'en',
    		'options' => ['placeholder' => 'Select a tags ...', 'multiple' => true],
	    'pluginOptions' => [
	        'allowClear' => true,
	        'tags' => true,
	        'tokenSeparators' => [';'],
	        'maximumInputLength' => 50
	    ],
	]);
	?>
	

	
	
	
    
    <?= $form->field($model, 'date_created')->textInput(['id'=>'dateCreated', 'disabled'=>true])
    	 ->label(Yii::t('app', 'Change date created') . ' <input id="changeDateCreated" type="checkbox" />') ?>
    
    <?= $form->field($model, 'date_updated')->textInput(['id'=>'dateUpdated', 'disabled'=>true])
        ->label(Yii::t('app', 'Change date updated') . ' <input id="changeDateUpdated" type="checkbox" />') ?>
    
    
    <!-- document -->
     <?php if(!$model->isNewRecord): ?>
        <?= DocumentWidget::widget([
            'id_tham_chieu' => $model->id
        ]) ?>
        <?php endif; ?>
        
        <!-- images -->
     <?php if(!$model->isNewRecord): ?>
        <?= ImageWidget::widget([
            'id_tham_chieu' => $model->id
        ]) ?>
        <?php endif; ?>
            
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
<?php ActiveForm::end(); ?> 
</div>

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
/* $(document).on('focusin', function(e) {
  if ($(e.target).closest(".mce-window").length) {
    e.stopImmediatePropagation();
  }
}); */
</script>

<div class="modal modal2 fade" id="myModal" >
<div class="modal-dialog1" style="width:900px">
  <div class="modal-content" style="height:700px;">
    <div class="modal-header">
      <button id="btnfieldID4" data-dismiss="modal" type="button" class="close" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Modal title</h4>
    </div>
    <div class="modal-body">
      <iframe width="850" height="600" src="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID4'&fldr=<?= $model->code ?>&akey=<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
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
      <iframe width="850" height="600" src="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID5'&fldr=<?= $model->code ?>&akey=<?= User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 
$this->registerJsFile(Yii::getAlias('@web') . "/js/script.js", ['position' => \yii\web\View::POS_END, 'depends' => [
    \yii\web\JqueryAsset::className()
]]);
?>

<script>
function ChangeLang(){
     $.ajax({
            url: '/dashboard/posts/change-lang',
           type: 'get',
           //dataType: 'json',
           data: {postid:<?= $model->id ?>, langid: $("#txtLang").val()},
           success: function (data) {
           		//alert(data);
           		$('#list-catalog').html(data);
           		/* $('#txtCat').children().remove();
           		$('#txtCat').append('<option value="">--Chọn--</option>');
           		for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                      $('#txtCat').append('<option value="'+key+'">'+ data[key] +'</option>');
                    }
                } */
           }

      });
}
</script>


<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "clientOptions" => [
        "backdrop" => "static", "keyboard" => false
    ]
])  ?>
<?php Modal::end(); ?>

  