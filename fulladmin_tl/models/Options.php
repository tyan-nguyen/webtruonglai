<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $group_type
 * @property string $name
 * @property string $value
 * @property string $input_type
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_type', 'name', 'value', 'input_type'], 'required'],
            [['value'], 'string'],
            [['group_type', 'input_type'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_type' => Yii::t('app', 'Group Type'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'input_type' => Yii::t('app', 'Input Type'),
        ];
    }
}
