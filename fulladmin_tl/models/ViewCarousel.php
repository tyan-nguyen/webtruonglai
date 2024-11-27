<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_carousel".
 *
 * @property int $id
 * @property string|null $image
 * @property string $title_small
 * @property string|null $title_small_en
 * @property string $title_large
 * @property string|null $title_large_en
 * @property int $default_button
 * @property int|null $priority
 * @property string|null $link_button1
 * @property string|null $text_button1
 * @property string|null $link_button2
 * @property string|null $text_button2
 * @property int|null $user_created
 * @property string|null $date_created
 */
class ViewCarousel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_carousel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_small', 'title_large'], 'required'],
            [['title_small', 'title_small_en'], 'string'],
            [['priority', 'user_created'], 'integer'],
            [['date_created', 'default_button'], 'safe'],
            [['image', 'title_large', 'title_large_en', 'link_button1', 'link_button2'], 'string', 'max' => 200],
            [['text_button1', 'text_button2'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'title_small' => Yii::t('app', 'Title Small'),
            'title_small_en' => Yii::t('app', 'Title Small En'),
            'title_large' => Yii::t('app', 'Title Large'),
            'title_large_en' => Yii::t('app', 'Title Large En'),
            'default_button' => Yii::t('app', 'Default Button'),
            'priority' => Yii::t('app', 'Priority'),
            'link_button1' => Yii::t('app', 'Link Button1'),
            'text_button1' => Yii::t('app', 'Text Button1'),
            'link_button2' => Yii::t('app', 'Link Button2'),
            'text_button2' => Yii::t('app', 'Text Button2'),
            'user_created' => Yii::t('app', 'User Created'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }
}
