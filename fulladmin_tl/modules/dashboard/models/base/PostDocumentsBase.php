<?php

namespace app\modules\dashboard\models\base;

use Yii;
use app\modules\dashboard\models\Posts;

/**
 * This is the model class for table "post_documents".
 *
 * @property int $id
 * @property int $pid
 * @property string|null $name
 * @property string|null $url
 * @property string|null $file_name
 * @property string|null $file_extension
 * @property float|null $file_size
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class PostDocumentsBase extends \app\models\PostDocuments
{
    CONST FOLDER_DOCUMENTS_ICONS = '/images/icons/';
    public $file;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'required'],
            [['pid', 'user_created'], 'integer'],
            [['file_size'], 'number'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['name', 'url', 'file_name'], 'string', 'max' => 255],
            [['file_extension'], 'string', 'max' => 10],
            [['file'], 'file'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->date_created = date('Y-m-d H:i:s');
            $this->user_created = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     * xoa file anh
     */
    public function beforeDelete()
    {
        if($this->url != NULL){
            $filePath = $this->post->folderRoot . $this->url;
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }
        return parent::beforeDelete();
    }
    
    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->pid !=NULL ? $this->hasOne(Posts::class, ['id' => 'pid']) : '';
    }
}
