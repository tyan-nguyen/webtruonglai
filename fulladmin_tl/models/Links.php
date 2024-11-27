<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $link
 * @property string $link_en
 * @property int $open_new_tab
 * @property int|null $pid
 * @property int $priority
 * @property string|null $type
 * @property string|null $lang
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_en', 'link', 'link_en', 'open_new_tab', 'priority'], 'required'],
            [['open_new_tab', 'pid', 'priority'], 'integer'],
            [['name', 'name_en', 'link', 'link_en'], 'string', 'max' => 200],
            [['type', 'lang'], 'string', 'max' => 20],
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
            'link' => Yii::t('app', 'Link'),
            'link_en' => Yii::t('app', 'Link En'),
            'open_new_tab' => Yii::t('app', 'Open New Tab'),
            'pid' => Yii::t('app', 'Pid'),
            'priority' => Yii::t('app', 'Priority'),
            'type' => Yii::t('app', 'Type'),
            'lang' => Yii::t('app', 'Lang'),
        ];
    }
}
