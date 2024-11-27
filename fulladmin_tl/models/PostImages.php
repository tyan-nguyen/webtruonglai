<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_images".
 *
 * @property int $id
 * @property int $pid
 * @property string|null $name
 * @property string|null $url
 * @property string|null $img_name
 * @property string|null $img_extension
 * @property float|null $img_size
 * @property string|null $img_wh
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class PostImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'required'],
            [['pid', 'user_created'], 'integer'],
            [['img_size'], 'number'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['name', 'url', 'img_name'], 'string', 'max' => 255],
            [['img_extension'], 'string', 'max' => 10],
            [['img_wh'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pid' => Yii::t('app', 'Pid'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'img_name' => Yii::t('app', 'Img Name'),
            'img_extension' => Yii::t('app', 'Img Extension'),
            'img_size' => Yii::t('app', 'Img Size'),
            'img_wh' => Yii::t('app', 'Img Wh'),
            'summary' => Yii::t('app', 'Summary'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
        ];
    }
}
