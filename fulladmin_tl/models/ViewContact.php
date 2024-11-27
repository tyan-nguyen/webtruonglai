<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_contact".
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $subject
 * @property string|null $message
 * @property int|null $services
 * @property int|null $viewed
 * @property string|null $date_created
 */
class ViewContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['subject', 'message'], 'string'],
            [['services', 'viewed'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'email'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 15],
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
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'services' => Yii::t('app', 'Services'),
            'viewed' => Yii::t('app', 'Viewed'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }
}
