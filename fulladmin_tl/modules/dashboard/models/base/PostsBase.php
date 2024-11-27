<?php

namespace app\modules\dashboard\models\base;

use Yii;
use yii\behaviors\SluggableBehavior;
use webvimark\modules\UserManagement\models\User;
use app\components\CustomFunc;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $cover
 * @property string|null $categories
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $summary
 * @property string|null $summary_one
 * @property string|null $summary_two
 * @property string|null $content
 * @property string|null $content_one
 * @property string|null $date_created
 * @property string|null $date_updated
 * @property int|null $user_created
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_image
 * @property string|null $post_status
 * @property string|null $tags
 * @property string|null $lang
 * @property string|null $post_type
 */
class PostsBase extends \app\models\Posts
{
    //catalog for create, update
    public $catalog;
    public $taglist;
    
    /**
     * Danh muc trang thai post
     * @return string[]
     */
    public static function getPostStatus(){
        return [
            'PUBLISH'=>'Công bố',
            'HIDE'=>'Không công bố',
            'DRAFT'=>'Bản nháp',
        ];
    }
    
    /**
     * Danh muc trang thai post label
     * @param int $val
     * @return string
     */
    public static function getStatusLabel($val){
        $label = '';
        if($val == 'PUBLISH'){
            $label = Yii::t('app', 'PUBLISH');
        }else if($val == 'HIDE'){
            $label = Yii::t('app', 'HIDE');
        }else if($val == 'DRAFT'){
            $label = 'DRAFT';
        }
        return $label;
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'immutable' => true,
                'ensureUnique'=>true,
                //'uniqueValidator'=>[]
                // 'slugAttribute' => 'slug',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['categories', 'title'], 'required'],
            [['title'], 'required'],
            /* [['slug', 'summary', 'content', 'seo_description'], 'string'],
            [['date_created', 'date_updated', 'catalog', 'taglist'], 'safe'],
            [['user_created', 'is_static', 'lang_parent'], 'integer'],
            [['code', 'imgcover', 'categories', 'seo_title', 'tags', 'site_keywords'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 300],
            [['post_status', 'post_type'], 'string', 'max' => 20],
            [['lang'], 'string', 'max' => 5], */
            [['slug', 'summary', 'summary_one', 'summary_two', 'content', 'content_one', 'seo_description'], 'string'],
            [['date_created', 'date_updated', 'catalog', 'taglist'], 'safe'],
            [['user_created'], 'integer'],
            [['code', 'cover', 'seo_title', 'tags'], 'string', 'max' => 200],
            [['categories', 'seo_image'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 300],
            [['post_status', 'post_type'], 'string', 'max' => 20],
            [['lang'], 'string', 'max' => 5],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    /* public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'imgcover' => 'Imgcover',
            'categories' => 'Categories',
            'title' => 'Title',
            'slug' => 'Slug',
            'summary' => 'Summary',
            'content' => 'Content',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'user_created' => 'User Created',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'post_status' => 'Post Status',
            'tags' => 'Tags',
            'site_keywords' => 'Site Keywords',
            'is_static' => 'Is Static'
        ];
    } */
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                if(!Yii::$app->user->isGuest)
                    $this->user_created = Yii::$app->user->id;
                $this->date_created = date('Y-m-d H:i:s');
                $this->date_updated = date('Y-m-d H:i:s');
                //set lang if null
                if($this->lang == null){
                    $this->lang = Yii::$app->params['mainLang'];
                }
                //set status
                if($this->post_status == null){
                    $this->post_status = 'DRAFT';
                }
                
                //set code
                if($this->code == null){
                    $this->code = $this->getRandomCode();
                }
                $dir = Yii::getAlias('@webroot'). '/images/posts/' . $this->code;
                if (!file_exists($dir)  && !is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
            } else {
                $this->date_updated = date('Y-m-d H:i:s');
            }
            return true;
        }
    }
    
    /**
     * tao random code khi them moi
     * @return string
     */
    public function getRandomCode(){
        $cus = new CustomFunc();
        $code = rand(10,99) . $cus->generateRandomString();
        $model = CategoriesBase::findOne(['code'=>$code]);
        if($model == null){
            return $code;
        } else {
            $this->getRandomCode();
        }
    }
    
    /**
     * delete file
     */
    public function beforeDelete()
    {
        $dirPath = Yii::getAlias('@webroot/images/posts/'). $this->code;
        if(is_dir($dirPath)){
            $this->deleteDir(Yii::getAlias('@webroot/images/posts/'). $this->code);
        }
        parent::beforeDelete();
        return true;
    }
    
    /**
     * dell folder not used
     * @return mixed
     */
    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    
    /**
     * check dir empty
     */
    public function is_dir_empty($dir) {
        if (!is_readable($dir)) return null;
        return (count(scandir($dir)) == 2);
    }    
}
