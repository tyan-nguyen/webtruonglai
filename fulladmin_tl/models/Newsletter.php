<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newsletter".
 *
 * @property int $id
 * @property string $email
 * @property string $site
 * @property string $date_created
 */
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'site', 'date_created'], 'required'],
            [['date_created'], 'safe'],
            [['email', 'site'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'site' => 'Site',
            'date_created' => 'Date Created',
        ];
    }
}
