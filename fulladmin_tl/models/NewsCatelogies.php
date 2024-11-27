<?php

namespace app\models;

use Yii;

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
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_image
 * @property string|null $lang
 * @property string|null $code
 * @property string|null $status
 * @property string|null $post_type
 * @property string|null $date_created
 * @property int|null $user_created
 */
class NewsCatelogies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_catelogies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['pid', 'priority', 'level', 'user_created'], 'integer'],
            [['description', 'content', 'seo_description'], 'string'],
            [['date_created'], 'safe'],
            [['cover', 'seo_image'], 'string', 'max' => 255],
            [['name', 'slug', 'seo_title', 'code'], 'string', 'max' => 200],
            [['lang', 'status', 'post_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cover' => Yii::t('app', 'Cover'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'pid' => Yii::t('app', 'Pid'),
            'priority' => Yii::t('app', 'Priority'),
            'level' => Yii::t('app', 'Level'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'seo_image' => Yii::t('app', 'Seo Image'),
            'lang' => Yii::t('app', 'Lang'),
            'code' => Yii::t('app', 'Code'),
            'status' => Yii::t('app', 'Status'),
            'post_type' => Yii::t('app', 'Post Type'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
        ];
    }
}
