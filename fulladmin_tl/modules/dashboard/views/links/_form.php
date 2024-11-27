<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\dashboard\models\Links;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Links */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="links-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    
      <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_new_tab')->checkbox() ?>
    
     <?= $form->field($model,'pid')->dropDownList((new Links())->getList($model->type),
				['class'=>'form-control', 'prompt'=>'--Chọn--']) ?>
    
     <?= $form->field($model, 'priority')->textInput(['maxlength' => true]) ?>
     
     <?php /* $form->field($model, 'type')->dropDownList($model->typeLink, [
         'prompt' => '-Select-'
     ])*/ ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
