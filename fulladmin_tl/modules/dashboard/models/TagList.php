<?php

namespace app\modules\dashboard\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "tag_list".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $date_created
 * @property int|null $user_created
 * @property string|null $seo_title
 * @property string|null $seo_description
 */
class TagList extends \app\models\TagList
{
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_created'], 'safe'],
            [['user_created'], 'integer'],
            [['seo_description'], 'string'],
            [['name', 'slug', 'seo_title'], 'string', 'max' => 200],
        ];
    }
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->date_created = date('Y-m-d H:i:s');   
                $this->user_created = Yii::$app->user->id;
            }
            return true;
        }
    }
    
    /**
     * get list
     */
    public function getList()
    {
        return ArrayHelper::map($this::find()->all(), 'slug', 'name');
    }
    
    /**
     * get list
     */
    public function getListName()
    {
        return ArrayHelper::map($this::find()->all(), 'name', 'name');
    }
    
    /**
     * get number post has this tag
     */
    public function getNumberNewsHasThisTag(){
        return Posts::find()->andFilterWhere(['like', 'tags', $this->slug])->count();
    }
    
    /**
     * seo
     */
    public function getSeoTitle(){
        return $this->seo_title == null ? $this->name : $this->seo_title;
    }
    
    public function getSeoDescription(){
        return $this->seo_description == null ? '' : $this->seo_description;
    }
}
