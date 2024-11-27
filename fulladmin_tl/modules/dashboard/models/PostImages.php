<?php

namespace app\modules\dashboard\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use app\models\Custom;
use app\modules\dashboard\models\base\PostImagesBase;

class PostImages extends PostImagesBase
{  
    /**
     * get hinh anh thuoc id tham chieu
     * @param int $idthamchieu
     * @return \yii\db\ActiveRecord[]
     */
    public static function getHinhAnhThamChieu($idthamchieu){
        return PostImages::find()->where([
            'pid' => $idthamchieu
        ])->orderBy('ID DESC')->all();
    }
    
    /**
     * xoa tat ca hinh anh thuoc id tham chieu(khi xoa tham chieu)
     * @param int $idthamchieu
     */
    public static function xoaHinhAnhThamChieu($idthamchieu){
        $models = PostImages::getHinhAnhThamChieu($idthamchieu);
        foreach ($models as $indexMod=>$model){
            $model->delete();
        }
    }
    
    /**
     * get hinh anh url
     * @return string
     */
    public function getHinhAnhUrl(){
        return $this->post->folderWeb . $this->url;
    }
}