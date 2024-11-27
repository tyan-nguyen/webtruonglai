<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $link
 * @property string $link_en
 * @property int $open_new_tab
 * @property int|null $pid
 * @property int $priority
 * @property string|null $type
 * @property string|null $lang
 */
class Links extends \app\models\Links
{
    /**
     * ---------virtual varible ---------
     */
    public $arr;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'link', 'open_new_tab', 'priority'], 'required'],
            [['open_new_tab', 'pid', 'priority'], 'integer'],
            [['name', 'name_en', 'link', 'link_en'], 'string', 'max' => 200],
            [['type', 'lang'], 'string', 'max' => 20],
        ];
    }
    
    /*
     * post status
     */
    public function getTypeLink(){
        return [
            'MENU_TOP' => 'Menu Top',
            'QUICK_LINK' => 'Quick link',
            'FOOTER_LINK' => 'Footer link',
            'SOCIAL_LINK' => 'Social link'
        ];
    }
    
    /*
     * post status
     */
    public function getTypeLinkName($type){
        $arr = $this->getTypeLink();
        if($arr[$type] != null){
            return $arr[$type];
        } else {
            return null;
        }
    }
    
    /**
     * show type link label
     */
    public function getTypeLinkLabel(){
        $arr = $this->getTypeLink();
        if($arr[$this->type] != null){
            return $arr[$this->type];
        } else {
            return null;
        }
    }
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if($this->pid == null){
                $this->pid = 0;
            }
            //set lang if null
            if($this->lang == null){
                $this->lang = Yii::$app->params['mainLang'];
            }
        }
        return true;
    }
    
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
    public function getList($menuType, $langid=NULL)
    {
        $this->arr = array();        
        if($langid==NULL){
            $langid = Yii::$app->params['mainLang'];
        }
        $parentCatalogs = $this::find()->where("pid IS NULL OR pid = 0 AND lang = '".$langid."'")
            ->andFilterWhere(['type'=>$menuType])->all();
        foreach ($parentCatalogs as $i=>$catalog){
            $this->arr[$catalog->id] = $catalog->name;
            $this->getChildCatalog($this->arr, $catalog->id, '');
        }
        return $this->arr;
    }
    /**
     * count number child of links
     */
    public function numberChildren(){
        return Links::find()->where(['pid'=>$this->id])->andFilterWhere(['type'=>'MENU_TOP'])->count();
    }
    
    /**
     * show link name by language
     */
    public function getShowName(){
        $session = Yii::$app->session;
        $lang = $session->get('language');
        //$session->close();
        
        if($lang == 'en-US'){
            return $this->name_en;
        } else {
            return $this->name;
        }
       
    }
    /**
     * show link url by language
     */
    public function getShowUrl(){
        $session = Yii::$app->session;
        $lang = $session->get('language');
        //$session->close();
        
        if($lang == 'en-US'){
            return $this->link_en;
        } else {
            return $this->link;
        }
        
    }
}
