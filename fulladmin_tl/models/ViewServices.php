<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_services".
 *
 * @property int $id
 * @property string $name
 * @property string|null $name_en
 * @property string|null $summary
 * @property string|null $summary_en
 * @property string|null $image
 * @property string|null $link
 * @property string|null $link_en
 * @property int|null $priority
 * @property string|null $date_created
 * @property int|null $user_created
 */
class ViewServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['summary', 'summary_en'], 'string'],
            [['priority', 'user_created'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'name_en', 'image', 'link', 'link_en'], 'string', 'max' => 200],
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
            'name_en' => Yii::t('app', 'Name En'),
            'summary' => Yii::t('app', 'Summary'),
            'summary_en' => Yii::t('app', 'Summary En'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'link_en' => Yii::t('app', 'Link En'),
            'priority' => Yii::t('app', 'Priority'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
        ];
    }
}
