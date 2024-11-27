<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\dashboard\models\Links;

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
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'link',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name_en',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'link_en',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'open_new_tab',
        'value'=>function($model){
            return $model->open_new_tab ? 'YES' : 'NO';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'priority',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'filter' => Html::activeDropDownList($searchModel, 'type', (new Links())->typeLink, [
            'prompt' => '-Tất cả-',
            'class' => 'form-control'
        ] ),
        'value' => function($model){
            return $model->getTypeLinkLabel();  
        },
        'format'=>'raw',
        'group' => true,  // enable grouping,
        'groupedRow' => true,                    // move grouped column to a single grouped row
        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
        
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
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