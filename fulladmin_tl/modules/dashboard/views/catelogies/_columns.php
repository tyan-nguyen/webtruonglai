<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\PostStatus;
use app\modules\dashboard\models\Catelogies;
use app\widgets\ShowLangCategories;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
        'format'=>'raw',
        'value'=>function($model){
            return Html::a($model->name, Yii::getAlias('@web/dashboard/catelogies/update-full?id='.$model->id),[
                'data-pjax'=>0
            ]);
        },
        'contentOptions' => ['style' => 'width:35%; white-space: normal;'],
    ],
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name_en',
    ], */
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slug',
    ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'priority',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'filter'=>false,
        'label'=>'Number post',
        'value'=>function($model){
        return number_format($model->getNumberNewsHasThisCatelog());
        }
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'format'=>'raw',
        'value'=>function($model){
            return PostStatus::widget(['value'=>$model->status, 'text'=>$model->getStatusLabel($model->status)]);
        },
        'filter'=>Html::activeDropDownList($searchModel, 'status', (new Catelogies())->getCategoriesStatus(),
            ['prompt'=>Yii::t('app', '--Select--'), 'class'=>'form-control'])
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'lang',
        'format'=>'raw',
        'value'=>function($model){
        return ShowLangCategories::widget(['model'=>$model]);
        },
        'filter'=>Html::activeDropDownList($searchModel, 'lang', Yii::$app->params['langs'],
            ['prompt'=>Yii::t('app', '--Select--'), 'class'=>'form-control'])
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
        'contentOptions' => ['style' => 'width:100px; white-space: normal;text-align:center'],
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => Yii::t('app', 'View in Popup'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        
        'template'=>'{view}{update}',
       /*  'template'=>'{view}{update}{updateFull}{delete}',
        'buttons' => [
            'updateFull' => function ($url, $model, $key) {
                return \yii\helpers\Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
                    Yii::getAlias('@web') . '/dashboard/catelogies/update-full?id='. $model->id, [
                      'data-pjax'=>0  
                    ]);
            },
        ], */
                
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   