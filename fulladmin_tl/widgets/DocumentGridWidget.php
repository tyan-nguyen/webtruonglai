<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\modules\dashboard\models\PostDocuments;
use yii\helpers\Html;

class DocumentGridWidget extends Widget{
    public $id_tham_chieu;
    
    public function init(){
        parent::init();
    }
    
    public function run(){ 
        $data = PostDocuments::getTaiLieuThamChieu($this->id_tham_chieu);
        $maHtml = '<div class="box-header with-border">
    		<h3 class="box-title">' . Yii::t('app', 'Documents') . '</h3>
    		<div class="box-tools pull-right">
    			<span class="label label-primary">' . count($data) . ' ' . Yii::t('app', 'documents') . '</span>
    			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    			</button>
    		</div>
    	</div>';
        
        $maHtml .= '<div class="box-body no-padding box-widget-form">
    		<ul class="products-list product-list-in-box">';
        foreach ($data as $key=>$val){
            $maHtml .= '<li class="item">';
            $maHtml .= '<div class="product-img">';
            $maHtml .= Html::img($val->extUrl, ['class'=>'img-responsive', 'style'=>'width:100%']);
            $maHtml .= '</div>';
            //$maHtml .= Html::img($val->hinhAnhUrl, ['class'=>'users-list-name', 'width'=>'128px', 'height'=>'128px']);
            $maHtml .= '<div class="product-info">';
            $maHtml .= Html::a(
                $val->name
                , Yii::getAlias('@web/dashboard/documents/update-outer?id='. $val->id),
                [
                    'role'=>'modal-remote',
                    'data-pjax'=>0,
                    'class'=>'product-title'
                ]);
            $maHtml .= '<span class="product-description">' . '<a class="badge rounded-pill avatar-icons bg-secondary"
                    role="modal-remote" href="'. Yii::getAlias('@web/dashboard/documents/delete-outer?id='. $val->id) . '" aria-label="Xóa" data-pjax="0" data-request-method="post" data-toggle="tooltip" data-confirm-title="Xác nhận xóa hình ảnh?" data-confirm-message="Bạn có chắc chắn thực hiện hành động này?" data-bs-placement="top" data-bs-toggle="tooltip-secondary" data-bs-original-title="Xóa hình ảnh này">
                    x</a>' . '</span>';
            
            $maHtml .= '</div>';
            $maHtml .= '</li>';
        }
        $maHtml .= '</ul></div>';
        
        return $maHtml;
    }
    
    /* public function run(){        
        $data = PostDocuments::getTaiLieuThamChieu($this->id_tham_chieu);
        
        $maHtml = '<div id="docsBlock"><div class="demo-avatar-group d-flex">';
        
        foreach ($data as $key=>$val){
            $maHtml .= '<div class="main-img-user avatar-xl  m-2 ">
    <a title="'. $val->name .'" role="modal-remote" data-pjax="0" href="'. Yii::getAlias('@web/dashboard/documents/update-outer?id='. $val->id) . '">
	<img alt="avatar" class="radius" src="'. $val->extUrl . '" data-bs-placement="top" data-bs-toggle="tooltip-primary" >
    </a>
	<a class="badge rounded-pill avatar-icons bg-secondary" 
		role="modal-remote" href="'. Yii::getAlias('@web/dashboard/documents/delete-outer?id='. $val->id) . '" aria-label="Xóa" data-pjax="0" data-request-method="post" data-toggle="tooltip" data-confirm-title="Xác nhận xóa tài liệu?" data-confirm-message="Bạn có chắc chắn thực hiện hành động này?" data-bs-placement="top" data-bs-toggle="tooltip-secondary" data-bs-original-title="Xóa tài liệu này">
		x</a>
</div>'; 
            
        }
        
        $maHtml .= '</div>';
        return $maHtml;
    } */
}
?>