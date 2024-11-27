<?php

namespace app\modules\dashboard\models\base;

use Yii;
use yii\behaviors\SluggableBehavior;
use app\components\CustomFunc;

/**
 * This is the model class for table "news_catelogies".
 *
 * @property int $id
 * @property string|null $cover
 * @property string $name
 * @property string $slug
 * @property int|null $pid
 * @property int|null $priority
 * @property int|null $level
 * @property string|null $description
 * @property string|null $content
 * @property string|null $seo_image
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $lang
 * @property string|null $code
 * @property int|null $status
 * @property string|null $post_type
 * @property string|null $date_created
 * @property int|null $user_created
 */
class CategoriesBase extends \app\models\NewsCatelogies
{
    CONST URL_CATELOGIES = '/posts/';
    
    /**
     * ---------virtual varible ---------
     */
    public $arr;
    
    /**
     * Danh muc trang thai du an
     * @return string[]
     */
    public static function getCategoriesStatus(){
        return [
            'PUBLISH'=>'Công bố',
            'HIDE'=>'Không công bố',
            'DRAFT'=>'Bản nháp',
        ];
    }
    
    /**
     * Danh muc Loai Kho luu tru label
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
                'attribute' => 'name',
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
            [['name', 'slug'], 'required'],
            [['pid', 'priority', 'level', 'user_created'], 'integer'],
            [['seo_description', 'description', 'content', ], 'string'],
            [['date_created'], 'safe'],
            [['cover', 'seo_image'], 'string', 'max' => 255],
            [['name', 'slug', 'seo_title', 'code'], 'string', 'max' => 200],
            [['lang', 'status', 'post_type'], 'string', 'max' => 20],
        ];
    }
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if($this->pid == null){
                $this->pid = 0;
                $this->level = 1;
            } else{
                $this->level = $this::findOne($this->pid)->level + 1;
            }
            //set lang if null
            if($this->lang == null){
                $this->lang = Yii::$app->params['mainLang'];
            }   
            
            //set status
            if($this->status == null){
                $this->status = 'DRAFT';
            }
            
            $this->date_created = date('Y-m-d H:i:s');
            $this->user_created = Yii::$app->user->id;
        }
        
        //set code
        if($this->code == null){
            $this->code = $this->getRandomCode();
        }
        
        $dir = Yii::getAlias('@webroot'). '/images/posts/_categories/' . $this->code;
        if (!file_exists($dir)  && !is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        return true;
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
        $dirPath = Yii::getAlias('@webroot/images/posts/_categories/'). $this->code;
        $dirThumbPath = Yii::getAlias('@webroot/images/thumbs/_categories/'). $this->code;
        if(is_dir($dirPath)){
            $this->deleteDir($dirPath);
        }
        if(is_dir($dirThumbPath)){
            $this->deleteDir($dirThumbPath);
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
    
}
