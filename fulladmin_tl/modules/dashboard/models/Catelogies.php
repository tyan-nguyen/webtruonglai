<?php

namespace app\modules\dashboard\models;
use Yii;
use yii\behaviors\SluggableBehavior;
use app\modules\dashboard\models\base\CategoriesBase;

class Catelogies extends CategoriesBase
{
    /**
     * get list index is id
     */
    /**
     *
     * @param unknown $arr
     * @param unknown $pid
     * @param unknown $level
     */
    public function getChildCatalog($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['pid'=>$pid])->all();
        if($listChildCatalogs != null){
            foreach ($listChildCatalogs as $j=>$catalog1){
                $this->arr[$catalog1->id] = $left . ' ' .$catalog1->name;
                $this->getChildCatalog($this->arr, $catalog1->id, $left);
            }
        }
    }
    /**
     *
     * @return unknown
     */
    public function getList($langid=NULL)
    {
        $this->arr = array();
        
        if($langid==NULL){
            $langid = Yii::$app->params['mainLang'];
        }
        
        //lay ds catalog parent
       // if($langid == null){
       //     $parentCatalogs = $this::find()->where('pid IS NULL OR pid = 0')->all();
       // } else {
            $parentCatalogs = $this::find()->where("pid IS NULL OR pid = 0 AND lang = '".$langid."'")->all();
       // }
        foreach ($parentCatalogs as $i=>$catalog){
            $this->arr[$catalog->id] = $catalog->showName;
            $this->getChildCatalog($this->arr, $catalog->id, '');
        }
        return $this->arr;
    }
    
    /**
     * get list index is slug
     */
    /**
     *
     * @param unknown $arr
     * @param unknown $pid
     * @param unknown $level
     */
    public function getChildCatalogSlug($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['pid'=>$pid])->all();
        if($listChildCatalogs != null){
            foreach ($listChildCatalogs as $j=>$catalog1){
                $this->arr[$catalog1->slug] = $left . ' ' .$catalog1->name;
                $this->getChildCatalogSlug($this->arr, $catalog1->id, $left);
            }
        }
    }
    /**
     *
     * @return unknown
     */
    public function getListSlug($langid=NULL)
    {
        $this->arr = array();
        if($langid==NULL){
            $langid = Yii::$app->params['mainLang'];
        }
        //lay ds catalog parent
        $parentCatalogs = $this::find()->where("pid IS NULL OR pid = 0 AND lang = '".$langid."'")->all();
        foreach ($parentCatalogs as $i=>$catalog){
            $this->arr[$catalog->slug] = $catalog->name;
            $this->getChildCatalogSlug($this->arr, $catalog->id, '');
        }
        return $this->arr;
    }
    
    /**
     * get cat link
     */
    public function getUrl(){
        return Yii::getAlias('@web') . $this::URL_CATELOGIES . $this->slug;
    }
    
    /**
     * get number post has this tag
     */
    public function getNumberNewsHasThisCatelog(){
        return Posts::find()->andFilterWhere(['like', 'categories', $this->slug])->count();
    }
    
    /**
     * show name by lang
     */
    public function getShowName(){
        $session = Yii::$app->session;
        $lang = $session->get('language');
        
        if($lang == 'en-US'){
            return $this->name_en;
        } else {
            return $this->name;
        }
    }
    
    /**
     * show seo title by lang
     */
    public function getShowSeoTitle(){
        $session = Yii::$app->session;
        $lang = $session->get('language');
        
        if($lang == 'en-US'){
            return $this->seo_title_en;
        } else {
            return $this->seo_title;
        }
    }
    
    /**
     * show seo description by lang
     */
    public function getShowSeoDescription(){
        $session = Yii::$app->session;
        $lang = $session->get('language');
        
        if($lang == 'en-US'){
            return $this->seo_description_en;
        } else {
            return $this->seo_description;
        }
    }
    
    /**
     * seo
     */
    public function getSeoTitle(){
        return $this->showSeoTitle == null ? $this->showName : $this->showSeoTitle;
    }
    
    public function getSeoDescription(){
        return $this->showSeoDescription == null ? '' : $this->showSeoDescription;
    }
    
    /**
     * relation
     * vitual attribute in view
     */
    public function getParent(){
        if($this->pid > 0)
            return $this->hasOne(Catelogies::class, ['id' => 'pid']);
        else 
            return null;
    }

    public function getShowParent(){
        if($this->parent != null){
            return $this->parent->name;
        }
        return null;
    }
    
    public function getLangList(){
        return Catelogies::find()->select(['id', 'lang'])->where(['code'=>$this->code])->orderBy('lang DESC')->asArray()->all();
    }
    
    public function getLangAvailable($code){
        $langArr = Yii::$app->params['langs'];
        $cats = Catelogies::find()->where(['code'=>$code])->all();
        foreach ($cats as $index=>$cat){
            unset($langArr[$cat->lang]);
        }
        return $langArr;
    }

}
