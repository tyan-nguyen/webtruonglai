<?php

namespace app\modules\dashboard\models;

use Yii;
use app\models\Custom;

class PostPublic extends Posts
{
    public function getLayoutView(){
        if($this->postType->layout==null){
            return 'post';
        } else
            return $this->postType->layout;
    }
    
    /**
     * get new public
     * if $cat exist load new by $cat
     */
    public static function getPostsPublic($postType, $cat=NULL){
        $query = PostPublic::find()->where([
            'post_type'=>$postType,
            'post_status'=>'PUBLISH'
        ]);
        if($cat!=null){
            $query = $query->andFilterWhere(['like', 'categories', $cat]);
        }
        return $query;
    }
    
    /**
     * get new public by tag
     * if $tag exist load new by $tag
     */
    public static function getPostsPublicByTag($postType, $tag=NULL){
        $query = PostPublic::find()->where([
            'post_type'=>$postType,
            'post_status'=>'PUBLISH'
        ]);
        if($tag!=null){
            $query = $query->andFilterWhere(['like', 'tags', $tag]);
        }
        return $query;
    }
    
    
    /**
     * get categories public
     * if $cat exist load category by $cat
     */
    public static function getCategoriesPublic($postType=NULL){
        $query = Catelogies::find()->where([
            'status'=>'PUBLISH'
        ]);
        if($postType != null){
            $query = $query->andFilterWhere(['post_type' => $postType]);
        }
        return $query;
    }
    
    /**
     * view categories in gridview
     */
    public function getCategoriesView($showLink=true){
        $result = '';
        $list = explode(';', $this->categories);
        $numList = count($list);
        $i=0;
        foreach ($list as $item){
            $i++;
            $cat = Catelogies::find()->where(['slug'=>$item])->one();
            if($cat != null){
                if($showLink == true){
                    $result .= '<a href="'.$cat->url.'">' . $cat->name . '</a>';
                } else {
                    $result .= $cat->name;
                }
                if($numList>1 && $i<$numList)
                    $result .= '&nbsp;/&nbsp;';
            }
        }
        return $result;
    }
    
    public function checkPostAvailable(){
        if($this->post_status == 'PUBLISH' && $this->postType->enable_single_view == true){
            return true;
        } else 
            return false;
    }

    
    /**
     * get list tags list by name
     */
    public function geTagsView(){
        $result = '';
        if($this->tags != null){
            $tagSlugs = explode(';', $this->tags);
            foreach ($tagSlugs as $indexTag=>$tagSlug){
                $tagModel = TagList::find()->where(['slug'=>$tagSlug])->one();
                if($tagModel != null){
                    $result .= '<a href="/tag/'. $tagModel->slug .'">'. $tagModel->name .'</a>';
                }
            }
        }
        return $result;
    }
    
    
}