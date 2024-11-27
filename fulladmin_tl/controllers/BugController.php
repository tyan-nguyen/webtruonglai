<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use app\modules\dashboard\models\Catelogies;
use app\components\Common;
use app\modules\dashboard\models\Posts;

class BugController extends Controller
{    
    public function actionTestMenu(){
        $this->layout = 'testMenuLayout';
        return $this->render('menu');
    }
    
    public function actionLang($lang){
        $value = \Yii::$app->getRequest()->getCookies()->getValue('site_lang');
        if($value != $lang){
            $cookie = new Cookie([
                'name' => 'site_lang',
                'value' => $lang,
                'expire' => time() + 86400 * 365,
            ]);
            \Yii::$app->getResponse()->getCookies()->add($cookie);
        }
        
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
    
    public function actionCat($lang=NULL,$slug){
        $this->layout = 'testMenuLayout';
        $lang = Common::getLang($lang);
        $catModel = Catelogies::findOne(['lang'=>$lang, 'slug'=>$slug]);
        return $this->render('cat', ['catModel'=>$catModel]);
    }
    
    public function actionPost($lang=NULL,$slug){
        $this->layout = 'testMenuLayout';
        $lang = Common::getLang($lang);
        $postModel = Posts::findOne(['lang'=>$lang, 'slug'=>$slug]);
        return $this->render('post', ['postModel'=>$postModel]);
    }
}