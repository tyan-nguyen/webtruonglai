<?php

namespace app\models;

use Yii;

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
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'summary', 'summary_one', 'summary_two', 'content', 'content_one', 'seo_description'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'cover' => Yii::t('app', 'Cover'),
            'categories' => Yii::t('app', 'Categories'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'summary' => Yii::t('app', 'Summary'),
            'summary_one' => Yii::t('app', 'Summary One'),
            'summary_two' => Yii::t('app', 'Summary Two'),
            'content' => Yii::t('app', 'Content'),
            'content_one' => Yii::t('app', 'Content One'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_updated' => Yii::t('app', 'Date Updated'),
            'user_created' => Yii::t('app', 'User Created'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'seo_image' => Yii::t('app', 'Seo Image'),
            'post_status' => Yii::t('app', 'Post Status'),
            'tags' => Yii::t('app', 'Tags'),
            'lang' => Yii::t('app', 'Lang'),
            'post_type' => Yii::t('app', 'Post Type'),
        ];
    }
}
