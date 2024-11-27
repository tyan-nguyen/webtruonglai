<?php

namespace app\modules\dashboard\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $group_type
 * @property string $name
 * @property string $value
 * @property string $input_type
 */
class Options extends \app\models\Options
{
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
     * get option value by option name
     * @param unknown $name <name of option>
     * @return unknown|NULL <if option exist return value, if not exist return null>
     */
    public static function getOption($name){
        $opt = Options::find()->where(['name'=>$name])->one();
        if($opt != null)
            return $opt->value;
        else 
            return null;
    }
    /**
     * get option list key-value by group type name
     * @param unknown $group <name of group>
     * @return array|\yii\db\ActiveRecord[]|array
     */
    public static function getOptions($group){
        $opts = Options::find()->where(['group_type'=>$group])->one();
        if($opts != null){
            return ArrayHelper::map(Options::find()->where(['group_type'=>$group])->all(), 'name', 'value');
        }
        else
            return [];
    }
}