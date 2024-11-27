<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_documents".
 *
 * @property int $id
 * @property int $pid
 * @property string|null $name
 * @property string|null $url
 * @property string|null $file_name
 * @property string|null $file_extension
 * @property float|null $file_size
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class PostDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'required'],
            [['pid', 'user_created'], 'integer'],
            [['file_size'], 'number'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['name', 'url', 'file_name'], 'string', 'max' => 255],
            [['file_extension'], 'string', 'max' => 10],
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
            'file_name' => Yii::t('app', 'File Name'),
            'file_extension' => Yii::t('app', 'File Extension'),
            'file_size' => Yii::t('app', 'File Size'),
            'summary' => Yii::t('app', 'Summary'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_created' => Yii::t('app', 'User Created'),
        ];
    }
}
