<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\widgets\ShowLangAdd;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $labels['title'];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<style>
.modal-dialog {
    width: 90%!important;
}
@media (max-width: 800px) {
   .modal-dialog {
      width: 99%!important; 
   }
}
</style>
                    
<div class="news-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                   /*  Html::a('<i class="glyphicon glyphicon-plus"></i> Add New Post', ['create?lang=' . $lang],
                    ['data-pjax'=>0, 'title'=> 'Create new News','class'=>'btn btn-default']). */
                    /* Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add new'), [$labels['createLink']],
                        ['data-pjax'=>0, 'title'=> Yii::t('app', 'Add new'),'class'=>'btn btn-default']). */
                    
                   /*  '<div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add new') . ' <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>'.  */
                    ( $postType->enable_languages ? ShowLangAdd::widget(['post_type'=>$postType->code]) :
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Add New Post', ['create?post_type=' . $postType->code],
                        ['data-pjax'=>0, 'title'=> 'Create new News','class'=>'btn btn-default']) )
                    .
                    Html::a('<i class="glyphicon glyphicon-th"></i> Categories', ['cat/' . $postType->code],
                        ['data-pjax'=>0, 'title'=> 'Manage Categories','class'=>'btn btn-default'])
                    .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Reload List', [$labels['reloadLink']],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
                    //'{toggleData}'.
                    //'{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => '', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> News listing',
                //'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
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
    "clientOptions" => [
        "backdrop" => "static", "keyboard" => false
    ]
])?>
<?php Modal::end(); ?>

<?php
   /*  $currentUrl = Yii::$app->request->url;
    $script = <<< JS
       function ChangeLang(){
         $.ajax({
                url: '/dashboard/posts/change-lang',
               type: 'get',
               //dataType: 'json',
               data: {postid:, langid: $("#txtLang").val()},
               success: function (data) {
               		$('#list-catalog').html(data);
               }
    
          });
        }
    JS;
    $this->registerJs($script); */
?>   
