<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_branches".
 *
 * @property int $id
 * @property string $name
 * @property string|null $country
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $website
 * @property string|null $twiter
 * @property string|null $facebook
 * @property string|null $likein
 * @property string|null $instagram
 * @property string|null $other
 * @property string|null $image
 * @property int|null $priority
 * @property int|null $show_homepage
 * @property string|null $date_created
 * @property int|null $user_created
 */
class ViewBranches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['address', 'other'], 'string'],
            [['priority', 'show_homepage', 'user_created'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'twiter', 'facebook', 'likein', 'instagram', 'image'], 'string', 'max' => 200],
            [['country', 'email', 'phone', 'website'], 'string', 'max' => 100],
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
            'country' => Yii::t('app', 'Country'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'website' => Yii::t('app', 'Website'),
            'twiter' => Yii::t('app', 'Twiter'),
            'facebook' => Yii::t('app', 'Facebook'),
            'likein' => Yii::t('app', 'Likein'),
            'instagram' => Yii::t('app', 'Instagram'),
            'other' => Yii::t('app', 'Other'),
            'image' => Yii::t('app', 'Image'),
            'priority' => Yii::t('app', 'Priority'),
            'show_homepage' => Yii::t('app', 'Show Homepage'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
        ];
    }
}
