<?php

namespace app\modules\dashboard\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use app\modules\dashboard\models\base\PostsBase;
use app\models\Custom;

class Posts extends PostsBase
{
    /**
     * Gets query for [[PostType]].
     * 1 post must belong 1 post_type
     * @return \yii\db\ActiveQuery
     */
    public function getPostType()
    {
        return $this->hasOne(PostType::class, ['code' => 'post_type']);
    }
    
    /**
     * get new link publish
     */
    public function getUrl(){
        if($this->postType->code=='PROJECT'){
            return Yii::getAlias('@web/project/') . $this->slug;
        }
        return Yii::getAlias('@web/post/') . $this->slug;
    }
    
    /**
     * get new link edited
     */
    public function getUrlEdit(){
        return Yii::getAlias('@web/dashboard/posts/update?id=') . $this->id;
    }
    
    /**
     * get categories
     */
    public function getCategoriesList(){
        $result = array();
        $list = explode(';', $this->categories);
        foreach ($list as $item){
            $cat = Catelogies::find()->where(['slug'=>$item])->one();
            if($cat != null)
                $result[$item] = $cat->showName;
        }
        return $result;
    }
    
    /**
     * view categories in gridview
     */
    public function getCategoriesView(){
        $result = '';
        $list = explode(';', $this->categories);
        foreach ($list as $item){
            $cat = Catelogies::find()->where(['slug'=>$item])->one();
            if($cat != null)
                $result .= '<span class="label label-primary">' . $cat->name . '</span> ';
        }
        return $result;
    }
    
    /**
     * get list tags list by name
     */
    public function getListTagName(){
        $idTags = array();
        if($this->tags != null){
            $tagSlugs = explode(';', $this->tags);
            foreach ($tagSlugs as $indexTag=>$tagSlug){
                $tagModel = TagList::find()->where(['slug'=>$tagSlug])->one();
                if($tagModel != null)
                    $idTags[] = $tagModel->name;
            }
        }
        return $idTags;
    }
    
    /**
     * get list tags list by name
     */
    public function getListTags(){
        $idTags = array();
        if($this->tags != null){
            $tagSlugs = explode(';', $this->tags);
            foreach ($tagSlugs as $indexTag=>$tagSlug){
                $tagModel = TagList::find()->where(['slug'=>$tagSlug])->one();
                if($tagModel != null)
                    $idTags[$tagSlug] = $tagModel->name;
            }
        }
        return $idTags;
    }
    
    /**
     * get summary
     */
    public function getSummaryByChars($numChar=NULL){
        if($numChar == NULL){
            $numChar = 400;
        }
        if($this->summary != '' && strlen($this->summary) > $numChar){
            $pos=strpos($this->summary, ' ', $numChar);
            return substr($this->summary,0,$pos ) . '...';
        } else {
            return $this->summary;
        }
    }
    
    /**
     * get user created
     */
    public function getUserCreated(){
        if($this->user_created == null){
            return 'Auto';
        } else {
            return User::findOne($this->user_created)->username;
        }
    }
    
    /**
     * get date created
     */
    public function getDateCreated(){
        if($this->date_created != null){
            return (new Custom())->convertYMDHIStoDMY($this->date_created);
        }
        return null;
    }
    
    /**
     * get images
     */
   /*  public function getImageCover(){
        $picFolder = Yii::getAlias('@webroot/images/posts/'. $this->code . '/');
        $picWebFolder = Yii::getAlias('@web/images/posts/'. $this->code . '/');
        $picDefault = Yii::getAlias('@web/images/posts/default.jpg');
        //find fist image in folder, if not found get default image
        $firstFile = 'default.jpg';
        if(file_exists($picFolder)){
            if(!$this->is_dir_empty($picFolder)){
                $firstFile = scandir($picFolder)[2];
                return $picWebFolder . $firstFile;
            } else {
                return $picDefault;
            }
        } else {
            return $picDefault;
        }
        
    } */
    
    /**
     * get images
     */
   /*  public function getImageCover1(){
        $picFolder = Yii::getAlias('@webroot/images/posts/'. $this->code . '/');
        $picWebFolder = Yii::getAlias('@web/images/posts/'. $this->code . '/');
        $picDefault = Yii::getAlias('@web/images/default.jpg');
        //find fist image in folder, if not found get default image
        $firstFile = 'default.jpg';
        if(file_exists($picFolder)){
            if(!$this->is_dir_empty($picFolder)){
              
                $firstFile = scandir($picFolder)[2];
                return $picWebFolder . $firstFile;
            } else {
                return $picDefault;
            }
        } else {
            return $picDefault;
        }      
        
    } */
    
    /**
     * test lại
     * @return unknown|string|boolean
     */
    public function getImgCover(){
        if($this->cover != null)
            return $this->cover;
        else 
            return Yii::getAlias('@web/images/default.jpg');
            //return $this->getImageCover();
    }
    
    /**
     * xem lại
     * @return string|string|boolean
     */
    public function getImageCover(){
        /* $picFolder = Yii::getAlias('@webroot/images/posts/'. $this->code . '/');
        $fi = new \FilesystemIterator($picFolder);
        return iterator_count($fi); */
        $picFolder = Yii::getAlias('@webroot/images/posts/'. $this->code . '/');
        $picWebFolder = Yii::getAlias('@web/images/posts/'. $this->code . '/');
        $picDefault = Yii::getAlias('@web/images/default.jpg');
        //find fist image in folder, if not found get default image
        $firstFile = 'default.jpg';
        if(file_exists($picFolder)){
            if(!$this->is_dir_empty($picFolder)){
                //count file in folder
                $fi = new \FilesystemIterator($picFolder);
                $numFile = iterator_count($fi);
                $files = glob($picFolder . '/*.{jpg,png,gif}', GLOB_BRACE);
                $bestImageVal = null;
                $bestFile = null;
                $bestName =  null;
                foreach($files as $file) {
                    //do your work here
                    list($width, $height, $type, $attr) = getimagesize($file);
                   // if($width - $height >=0){
                        if($bestImageVal == null){
                            $bestImageVal = $width - $height;
                            $bestFile = $file;
                            $bestName = basename($file);
                        }
                        else if( ($width - $height) > $bestImageVal){
                             $bestImageVal = $width - $height;
                             $bestFile = $file;
                             $bestName = basename($file);
                        }
                            
                   // }
                    
                }
                if($bestFile != null && $bestImageVal >= 0)
                    return $picWebFolder . $bestName;
                else
                    return $picDefault;
                
               // $firstFile = scandir($picFolder)[2];
               # return $picWebFolder . $firstFile;
            } else {
                return $picDefault;
            }
        } else {
            return $picDefault;
        } 
    }
    
    /**
     * seo
     */
    public function getSeoTitle(){
        return $this->seo_title == null ? $this->title : $this->seo_title;
    }
    
    public function getSeoDescription(){
        return $this->seo_description == null ? $this->summary : $this->seo_description;
    }
    
    public function getSeoImage(){
        return $this->seo_image != null ? $this->seo_image : $this->imgCover;
    }
    
    
    public function getLangList(){
        return Posts::find()->select(['id', 'lang'])->where(['code'=>$this->code])->orderBy('lang DESC')->asArray()->all();
    }
    
    public function getLangAvailable($code){
        $langArr = Yii::$app->params['langs'];
        $cats = Posts::find()->where(['code'=>$code])->all();
        foreach ($cats as $index=>$cat){
            unset($langArr[$cat->lang]);
        }
        return $langArr;
    }
    
    public function getFolderWeb(){
        return Yii::getAlias('@web/images/posts/'. $this->code . '/');
    }
    
    public function getFolderRoot(){
        return Yii::getAlias('@webroot/images/posts/'. $this->code . '/');
    }
    
    public function getAdminLink(){
        return Yii::getAlias('@web/dashboard/content/'. strtolower($this->post_type));
    }
    
    /**
     * get posts by type
     */
    public static function getPostByType($postType, $limit, $categorySlug=NULL){
        $posts = Posts::find()->where([
            'post_type'=>$postType,
            'post_status'=>'PUBLISH'
        ]);
        
        if($categorySlug!=NULL){
            $posts->andFilterWhere(['like', 'categories', $categorySlug]);
        }

        return $posts->orderBy(['date_created'=>SORT_DESC])->limit($limit)->all();
    }
    
    
    
}
