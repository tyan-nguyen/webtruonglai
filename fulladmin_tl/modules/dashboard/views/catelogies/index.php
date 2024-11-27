<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CatelogiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Categories');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="catelogies-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add new'), ['create?post_type='.$postType->code],
                        ['role'=>'modal-remote','title'=> Yii::t('app','Create new') .' '. Yii::t('app','Categories'),'class'=>'btn btn-default']).
                            
                    Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add full'), ['create-full?post_type='.$postType->code],
                        ['data-pjax'=>0,'title'=> Yii::t('app','Create full') .' '. Yii::t('app','Categories'),'class'=>'btn btn-default']).
                            
                    
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> ' . Yii::t('app', 'Reload'), ['/dashboard/cat/'.$postType->code],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
                    //'{toggleData}'.
                    //'{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => '', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Catelogies listing'),
                'before'=>'<em>* ' . Yii::t('app', 'Resize table columns just like a spreadsheet by dragging the column edges').'</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; '. Yii::t('app', 'Delete All'),
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>Yii::t('app', 'Are you sure?'),
                                    'data-confirm-message'=>Yii::t('app', 'Are you sure want to delete this item')
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


