<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use app\modules\dashboard\models\Catelogies;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Catelogies */
?>
<div class="catelogies-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'name_en',
            'slug',
            'pid'=>[
                'attribute'=>'pid',
                'value'=>$model->showParent
            ],
            'priority',
            'level',
            'seo_title',
            'seo_description',
            'lang'=>[
                'attribute'=>'lang',
                'format'=>'raw',
                'value'=>function($model){
                    $html = '';
                    foreach ($model->langList as $key=>$val){
                        if($model->lang != $val['lang']){
                            $html .= '&nbsp;' . Html::a($val['lang'], Yii::getAlias('@web/dashboard/catelogies/view?id='.$val['id']), 
                                ['role'=>'modal-remote'],
                            );
                        } else {
                            $html .= '&nbsp;' . $val['lang'];
                        }
                    }
                    return $html;
                }
            ],
            'code',
            [
                'attribute'=>'url',
                'value'=>$model->url
            ],
        ],
    ]) ?>

</div>
