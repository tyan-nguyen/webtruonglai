<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\dungchung\models\HinhAnh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hinh-anh-form">

    <?php $form = ActiveForm::begin([
        'id' => 'img-form', 
        'options' => [
            'enctype' => 'multipart/form-data',
            //'data-pjax' => 1
        ]
    ]); ?>
    
    <?= $model->isNewRecord ? $form->field($model, 'file')->fileInput() : '' ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
