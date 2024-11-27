<?php

namespace app\modules\dashboard\models;

use Yii;
use app\models\Custom;

class Contact extends \app\models\ViewContact
{
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){  
                $this->date_created = date('Y-m-d H:i:s');     
                if($this->viewed == null)
                    $this->viewed = 0;
            }
            return true;
        }
    }
    
    /**
     * get services name
     */
    public function getServiceName(){
        if($this->services != null){
            $ser = Services::findOne($this->services);
            if($ser != null){
                return $ser->getShowName();
            }                
        }
        return '';
    }
    
    /**
     * show date_created as d/m/Y H:i:s
     */
    public function getDateCreated(){
        $cus = new Custom();
        return $cus->convertYMDHIStoDMYHIS($this->date_created);
    }
    
    /**
     * count contact
     * @return number|string|NULL
     */
    public function getCountNewContact(){
        return Contact::find()->where(['viewed'=>0])->count();
    }
}
