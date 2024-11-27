<?php

namespace app\modules\dashboard\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use app\models\Custom;
use app\modules\dashboard\models\base\PostDocumentsBase;

class PostDocuments extends PostDocumentsBase
{    
    /**
     * get tai lieu thuoc id tham chieu
     * @param string $loai
     * @param int $idthamchieu
     * @return \yii\db\ActiveRecord[]
     */
    public static function getTaiLieuThamChieu($pid){
        return PostDocuments::find()->where([
            'pid' => $pid
        ])->orderBy('ID DESC')->all();
    }
    
    /**
     * xoa tat ca tai lieu thuoc id tham chieu(khi xoa tham chieu)
     * @param string $loai
     * @param int $idthamchieu
     */
    public static function xoaTaiLieuThamChieu($pid){
        $models = PostDocuments::getTaiLieuThamChieu($pid);
        foreach ($models as $indexMod=>$model){
            $model->delete();
        }
    }
    
    /**
     * get tai lieu ext url image
     * @return string
     */
    public function getExtUrl(){
        return Yii::getAlias('@web') . $this::FOLDER_DOCUMENTS_ICONS . $this->file_extension . '.' . 'png';
    }
    
    /**
     * get tai lieu url
     * @return string
     */
    public function getFileUrl(){
        return $this->post->folderWeb . $this->url;
    }
    
    /**
     * file size by KB
     * @return string
     */
    public function getSizeKB(){
        return ceil($this->file_size/1024) . ' KB';
    }
}