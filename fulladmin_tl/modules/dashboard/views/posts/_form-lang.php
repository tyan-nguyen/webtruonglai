<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use kartik\select2\Select2;
use app\modules\admin\models\TagList;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */

$model->taglist = $model->listTagName;
?>


<!-- editor -->
<script src="<?= Yii::getAlias('@web') ?>/assets/editor/tinymce/tinymce.min.js"></script>
<!-- <script src="https://www.responsivefilemanager.com/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" ></script> -->
<div class="row">
	<?php $form = ActiveForm::begin([
        'id' => 'frmPost',
        //'enableAjaxValidation' => false,
        'options' => [ 'enctype' => 'multipart/form-data' ]
    ]); ?>
	<div class="col-md-9">

    
    
     <?= $form->errorSummary($model) ?>

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
    
     <?= $form->field($model, 'post_status')->dropDownList($model->postStatus, []) ?>
     
     <?php // $form->field($model, 'site_keywords')->textInput(['maxlength' => true]) ?>
     
	 <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
	 
	 <?php //$form->field($model, 'is_static')->checkbox() ?>
	 
	 <?php if($model->postType->enable_languages){ 
	  <?= $form->field($model, 'lang')->dropDownList(
         (isset($code) && $code != null) 
            ? $model->getLangAvailable($model->code) 
            : Yii::$app->params['langs'], 
         [
             'prompt'=>Yii::t('app', 'Select language'),
             'onchange'=>$model->postType->enable_categories ? 'ChangeLang()' : '',
             'id'=>'txtLang'
         ]) ?>
	
	<?php } //enable languages ?>
    
    
    <?php if($model->postType->enable_categories){ ?>
    <div class="form-group">
    	<label>Catelogies</label>
    	<div id="list-catalog" class="list-catalog">
			<?= $model->lang!=null ? $this->render('_catalog-tree', [
					'model'=>false,
					'catalogLists'=> $catalogLists
			]) : Yii::t('app', 'Please select language.') ?>
		</div>
    </div>
    <script>
        function ChangeLang(){
             $.ajax({
                    url: '/dashboard/posts/change-lang',
                   type: 'get',
                   //dataType: 'json',
                   data: {postid:'', langid: $("#txtLang").val()},
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


  