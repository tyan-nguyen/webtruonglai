<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\modules\dashboard\models\PostImages;
use yii\helpers\Html;

class ImageGridWidget extends Widget{
    public $loai;
    public $id_tham_chieu;
    
    public function init(){
        parent::init();
    }
    
    public function run(){
        $data = PostImages::getHinhAnhThamChieu($this->id_tham_chieu);
        $maHtml = '<div class="box-header with-border">
    		<h3 class="box-title">' . Yii::t('app', 'Images') . '</h3>
    		<div class="box-tools pull-right">
    			<span class="label label-primary">' . count($data) . ' ' . Yii::t('app', 'images') . '</span>
    			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    			</button>
    		</div>
    	</div>';
        
        $maHtml .= '<div class="box-body no-padding box-widget-form">
    		<div class="row padding-bottom">';
                foreach ($data as $key=>$val){
                    $maHtml .= '<div class="col-sm-4 text-center">';
                    //$maHtml .= Html::img($val->hinhAnhUrl, ['class'=>'users-list-name', 'width'=>'128px', 'height'=>'128px']);
                    $maHtml .= Html::a(
                        Html::img($val->hinhAnhUrl, ['class'=>'img-responsive', 'style'=>'width:100%'])
                        , Yii::getAlias('@web/dashboard/images/update-outer?id='. $val->id),
                        [
                            'role'=>'modal-remote',
                            'data-pjax'=>0
                        ]);
                    $maHtml .= '<a class="badge rounded-pill avatar-icons bg-secondary" 
                    role="modal-remote" href="'. Yii::getAlias('@web/dashboard/images/delete-outer?id='. $val->id) . '" aria-label="Xóa" data-pjax="0" data-request-method="post" data-toggle="tooltip" data-confirm-title="Xác nhận xóa hình ảnh?" data-confirm-message="Bạn có chắc chắn thực hiện hành động này?" data-bs-placement="top" data-bs-toggle="tooltip-secondary" data-bs-original-title="Xóa hình ảnh này">
                    x</a>';
                    $maHtml .= '</div>';
                }
    	$maHtml .= '</div></div>';
        
        return $maHtml;
    }
    
    /* public function run(){        
        $data = PostImages::getHinhAnhThamChieu($this->id_tham_chieu);
        
        $maHtml = '<div id="imgBlock"><div class="demo-avatar-group d-flex">';
        
        foreach ($data as $key=>$val){
            $maHtml .= '<div class="main-img-user avatar-xl  m-2 ">
                <a role="modal-remote" data-pjax="0" href="'. Yii::getAlias('@web/dashboard/images/update-outer?id='. $val->id) . '">
                <img alt="avatar" class="radius" src="'. $val->hinhAnhUrl . '">
                </a>
                <a class="badge rounded-pill avatar-icons bg-secondary" 
                    role="modal-remote" href="'. Yii::getAlias('@web/dashboard/images/delete-outer?id='. $val->id) . '" aria-label="Xóa" data-pjax="0" data-request-method="post" data-toggle="tooltip" data-confirm-title="Xác nhận xóa hình ảnh?" data-confirm-message="Bạn có chắc chắn thực hiện hành động này?" data-bs-placement="top" data-bs-toggle="tooltip-secondary" data-bs-original-title="Xóa hình ảnh này">
                    <i class="fe fe-x fs-12 d-flex"></i></a>
            </div>';
        }
        
        $maHtml .= '</div>';
        return $maHtml;
    } */
}
?>