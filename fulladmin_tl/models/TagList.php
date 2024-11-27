<?php

namespace app\models;

use Yii;

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
class TagList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag_list';
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_description' => Yii::t('app', 'Seo Description'),
        ];
    }
}
