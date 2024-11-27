<?php

namespace app\modules\dashboard\models;

use Yii;
use app\models\Custom;
/**
 * This is the model class for table "post_types".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $enable
 * @property int|null $enable_images
 * @property int|null $enable_documents
 * @property int|null $enable_cover
 * @property int|null $enable_seo
 * @property int|null $enable_summary
 * @property int|null $enable_summary_one
 * @property int|null $enable_summary_two
 * @property int|null $enable_content
 * @property int|null $enable_content_one
 * @property int|null $enable_categories
 * @property int|null $enable_languages
 * @property int|null $enable_tags
 * @property string|null $layout
 * @property int|null $enable_single_view
 */
class PostType extends \app\models\PostTypes 
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['enable', 'enable_images', 'enable_documents', 'enable_cover', 'enable_seo', 'enable_summary', 'enable_summary_one', 'enable_summary_two', 'enable_content', 'enable_content_one', 'enable_categories', 'enable_languages', 'enable_tags', 'enable_single_view'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 200],
            [['layout'], 'string', 'max' => 50],
        ];
    }
    
    public function getAdminLink(){
        return Yii::getAlias('@web/dashboard/content/' . strtolower($this->code));
    }
    
    public function getPostLabels(){
        $labelArr = array();
        $labelArr['title'] = $this->name;
        $labelArr['createLink'] = 'create?post_type=' . strtolower($this->code);
        $labelArr['reloadLink'] = $this->adminLink;
        
        return $labelArr;
    }
    
    public static function defaultPostLabels(){
        $labelArr = array();
        
        $labelArr['title'] = 'Post';
        $labelArr['createLink'] = 'create';
        $labelArr['reloadLink'] = '';
        
        return $labelArr;
    }
    
    public static function getPostLinkByPostType($post_type){
        return Yii::getAlias('@web/dashboard/posts/') . 'create?post_type=' . strtolower($post_type);
    }
    
    public static function getSettingByAttribute($code, $attr){
        $model = PostType::findOne(['code'=>$code]);
        if($model->$attr == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}