<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\widgets\DocumentGridWidget;

class DocumentWidget extends Widget{
    public $id_tham_chieu;
    
    public function init(){
        parent::init();
    }
    
    public function run(){        
        $maHtml = '';
        
        $maHtml .= '<div class="box box-primary">';
        $maHtml .= '<div id="docsBlock">';
        $maHtml .= DocumentGridWidget::widget([
            'id_tham_chieu' => $this->id_tham_chieu
        ]);
        $maHtml .= '</div>';
        $maHtml .= '<div class="box-footer text-center">';
        $maHtml .= Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> ' . Yii::t('app', 'Add A Document'),
            [Yii::getAlias('@web').'/dashboard/documents/create-outer?pid='.$this->id_tham_chieu],['role'=>'modal-remote','title'=> Yii::t('app', 'Add New Document'),'class'=>'btn btn-outline-primary']);
        $maHtml .= '</div>';
        $maHtml .= '</div>';
        
        return $maHtml;
    }
    
    /* public function run(){
        
        $maHtml = Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm tài liệu',
            [Yii::getAlias('@web').'/dashboard/documents/create-outer?pid='.$this->id_tham_chieu],['role'=>'modal-remote','title'=> 'Thêm mới tài liệu','class'=>'btn btn-outline-primary']);
        
        $maHtml .= DocumentGridWidget::widget([
            'id_tham_chieu' => $this->id_tham_chieu
        ]);
        $maHtml .= '</div>';
        return $maHtml;
    } */
}
?>