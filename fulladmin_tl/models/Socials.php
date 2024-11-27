<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socials".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $link
 * @property int $priority
 */
class Socials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon', 'link', 'priority'], 'required'],
            [['priority'], 'integer'],
            [['name', 'icon', 'link'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
            'link' => 'Link',
            'priority' => 'Priority',
        ];
    }
}
