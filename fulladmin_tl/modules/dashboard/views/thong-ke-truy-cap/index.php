<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcounterByDaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcounter By Days';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>



<style>
.content h3{
	color: white;
	background: none;
}
</style>
<section class="content">
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getOnline()); ?></h3>

              <p>Đang truy cập</p>
            </div>
            <div class="icon">
              <i class="fa  fa-clock-o"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getToday()) ?></h3>

              <p>Hôm nay</p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getYesterday()) ?></h3>

              <p>Hôm qua</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getTotal()); ?></h3>

              <p>Tổng truy cập</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>


	<div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
              <li class="active"><a href="#a" data-toggle="tab">Thống kê 7 ngày gần nhất</a></li>
              <li><a href="#b" data-toggle="tab">Thống kê chi tiết</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Thống kê truy cập</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="tab-pane active" id="a">

              	<div class="chart" id="line-chart" style="height: 300px;"></div>

              </div>
              <div class="tab-pane" id="b">

              		<div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Thống kê chi tiết</h3>
			            </div>
			            <div class="box-body chart-responsive">

			            		<div class="pcounter-by-day-index">
								    <div id="ajaxCrudDatatable">
								        <?=GridView::widget([
								            'id'=>'crud-datatable',
								            'dataProvider' => $dataProvider,
								            'filterModel' => $searchModel,
								            'pjax'=>true,
								            'columns' => require(__DIR__.'/_columns.php'),
								        	'showPageSummary' => true,
								            'toolbar'=> [
								                ['content'=>
								                    //Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
								                   // ['role'=>'modal-remote','title'=> 'Create new Pcounter By Days','class'=>'btn btn-default']).
								                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
								                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
								                		//.
								                    //'{toggleData}'.
								                    //'{export}'
								                ],
								            ],
								            'striped' => true,
								            'condensed' => true,
								            'responsive' => true,
								        		'panel' => [
								        				'type' => 'primary',
								        				'heading' => '<i class="glyphicon glyphicon-list"></i> ',
								        				'before'=>'<div class="col-md-6">'.
								        					$this->render('_form-search',['model'=>$searchModel])
								        				.'</div>',
								        				'after'=>/*BulkButtonWidget::widget([
								        						'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa tất cả',
								        						["bulk-delete"] ,
								        						[
								        						"class"=>"btn btn-danger btn-xs",
								        						'role'=>'modal-remote-bulk',
								        						'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
								        						'data-request-method'=>'post',
								        						'data-confirm-title'=>'Thông báo',
								        						'data-confirm-message'=>'Bạn chắc chắn muốn xóa?'
								        						]),
								        						]).*/
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


			            </div>
			            <!-- /.box-body -->
			          </div>

              </div>
            </div>
          </div>

</section>





