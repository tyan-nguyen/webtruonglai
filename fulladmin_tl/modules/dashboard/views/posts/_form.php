<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use kartik\select2\Select2;
use app\modules\dashboard\models\TagList;
use yii\bootstrap\Modal;
use app\widgets\DocumentWidget;
use app\widgets\ImageWidget;
//use johnitvn\ajaxcrud\CrudAsset;

//CrudAsset::register($this);
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
    $model->taglist = $model->listTagName;
?>

<!-- editor -->
<script src="<?= Yii::getAlias('@web') ?>/assets/editor/tinymce/tinymce.min.js"></script>

<div class="row">
	<?php $form = ActiveForm::begin([
        'id' => 'frmPost',
        //'enableAjaxValidation' => false,
        'options' => [ 'enctype' => 'multipart/form-data' ]
    ]); ?>
    
    <!-- left content -->
	<div class="col-md-9">
	
    <?= $form->errorSummary($model) ?>

   	<?php $nameLabel = $model->getAttributeLabel('title');
   	        if($model->postType->enable_seo){
           	    $nameLabel .= ' <span class="seoButton label label-warning" title="Thay đổi liên kết"><i class="glyphicon glyphicon-link"></i></span>';
           	}
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label($nameLabel) ?>
	
	<?= $model->postType->enable_summary ? $form->field($model, 'summary')->textarea(['rows' => 3]) : '' ?>
	
	<?= $model->postType->enable_summary_one ? $form->field($model, 'summary_one')->textarea(['rows' => 3]) : '' ?>
	
	<?= $model->postType->enable_summary_two ? $form->field($model, 'summary_two')->textarea(['rows' => 3]) : '' ?>
	
	<?php if($model->postType->enable_seo){ ?>
	 <div class="dSeo box block-form block-form-border" style="display:block">
    	
    	 <div class="box-header with-border block-form-title">
    	 	<i class="fa fa-bullhorn" aria-hidden="true"></i>
    	 	<h3 class="box-title">SEO</h3>
    	 </div>
    	 
    	 <div class="box-body">
    	<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    	
    	<?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
    	
    	<?= $form->field($model, 'seo_description')->textarea(['rows' => 3]) ?>
    	
    	    <?php /* $nameLabel = $model->getAttributeLabel('seo_image') 
        	. ' <a data-toggle="modal"  href="javascript:;" data-target="#myModalSeo" class="btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>' */ ?>
        	
        	 <?php $nameLabel = $model->getAttributeLabel('seo_image') 
        	. ' <a href="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID5&fldr=' . $model->code . '&akey=' . (User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '') .'" class="btn iframe-btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>' ?>
    	 
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
	
	<?php } // enable seo ?>
	
	<?php if($model->postType->enable_content){ ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id'=>'txtContent']) ?>
	<?php } //enable content ?>
	
	<?php if($model->postType->enable_content_one){ ?>
    <?= $form->field($model, 'content_one')->textarea(['rows' => 6, 'id'=>'txtContentOne']) ?>
	<?php } //enable content ?>
	    
    </div><!-- left content -->
    
    <!-- right content -->
    <div class="col-md-3">
	
	<?php if($model->postType->enable_cover){ 
	    $nameLabel = $model->getAttributeLabel('cover') 
    	. ' <a href="/filemanager/filemanager/dialog.php?type=2&field_id=fieldID4&fldr=' . $model->code . '&akey=' . (User::hasRole('bientapvien') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '') .'" class="btn iframe-btn" type="button"><i class="glyphicon glyphicon-picture"></i></a>';
	   echo $form->field($model, 'cover')->textInput(['maxlength' => true, 'id'=>'fieldID4'])->label($nameLabel); ?>
	 	
	 <div id="dCover-fieldID4" class="dCover input-append">	  
    	  <img src="<?= $model->cover ?>" />
    </div>    
    <?php } //enable cover ?>
    
    
    
     <?= $form->field($model, 'post_status')->dropDownList($model->postStatus, []) ?>
     
     <?php // $form->field($model, 'site_keywords')->textInput(['maxlength' => true]) ?>
     
	 <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
	 
	 <?php //$form->field($model, 'is_static')->checkbox() ?>

	 <?php if($model->postType->enable_languages){ 
        /* if($model->isNewRecord)
            $model->lang = $lang; */
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
             'onchange'=>$model->postType->enable_categories ? 'ChangeLang()' : '',
             'id'=>'txtLang'
         ]) ?>
	
	<?php } //enable languages ?>
	
    <?php // $form->field($model, 'catelogies')->textInput(['maxlength' => true]) ?>
    
    <?php if($model->postType->enable_categories){ ?>
    <div class="form-group <?= isset($model->errors['catalog']) ? 'has-error' : '' ?>">
    	<label>Catelogies</label>
    	<div id="list-catalog" class="list-catalog">
			<?= $this->render('_catalog-tree', [
					'model'=>$model,
					'catalogLists'=>$catalogLists
			]) ?>
		</div>
    </div>
    
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

    <?php } //enable catalog ?>
    
    <?php  if($model->postType->enable_tags){ ?>
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
	<?php } //enable tags ?>

    <?= $form->field($model, 'date_created')->textInput(['id'=>'dateCreated', 'disabled'=>true])
    	 ->label(Yii::t('app', 'Change date created') . ' <input id="changeDateCreated" type="checkbox" />') ?>
    
    <?= $form->field($model, 'date_updated')->textInput(['id'=>'dateUpdated', 'disabled'=>true])
        ->label(Yii::t('app', 'Change date updated') . ' <input id="changeDateUpdated" type="checkbox" />') ?>
    
    
    <!-- document -->
     <?php if(!$model->isNewRecord && $model->postType->enable_documents): ?>
        <?= DocumentWidget::widget([
            'id_tham_chieu' => $model->id
        ]) ?>
        <?php endif; ?>
        
        <!-- images -->
     <?php if(!$model->isNewRecord && $model->postType->enable_images): ?>
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


<?php if($model->postType->enable_content){ ?>
<script>
tinymce.remove();
//editor for content
tinymce.init({
	selector: "#txtContent,#txtContentOne",
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
<?php } // enable content?>


<?php if($model->postType->enable_cover){ ?>
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
<?php } //enable cover ?>

<?php if($model->postType->enable_seo){ ?>
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
<?php } //enable seo ?>


<?php 
$this->registerJsFile(Yii::getAlias('@web') . "/js/script.js", ['position' => \yii\web\View::POS_END, 'depends' => [
    \yii\web\JqueryAsset::className()
]]);
?>

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


<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "clientOptions" => [
        "backdrop" => "static", "keyboard" => false
    ]
])  ?>
<?php Modal::end(); ?>

  