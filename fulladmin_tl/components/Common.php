<?php
namespace app\components;

use Yii;

class Common
{  
    public static function getLang($lang){
        
        if($lang==null || !array_key_exists($lang, Yii::$app->params['langs'])){
            $lang = Yii::$app->params['mainLang'];
        }
        return $lang;
    }
    
    public static function showLangSlug($slug){
        $langck = \Yii::$app->getRequest()->getCookies()->getValue('site_lang');
        if($langck == yii::$app->params['mainLang'] || $langck == null){
            return $slug;
        } else {
            return $langck . '/' . $slug;
        }
    }
}