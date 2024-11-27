<?php
use yii\helpers\Url;

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
        'attribute'=>'viewed',
        'format'=>'html',
        'value'=>function($model){
            return $model->viewed == 0 ? '<span class="label label-warning">New</span>' : '<span class="label label-default">Viewed</span>';
        },
        'contentOptions'=>['style'=>'text-align:center;']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'subject',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'message',
        'format'=>'html'
    ],
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'message',
    ], */
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'services',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'viewed',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'date_created',
         'value'=>function($model){
             return $model->dateCreated;
         }
     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template' => '{view}',
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'View'),'data-toggle'=>'tooltip', 'class'=>'btn btn-primary btn-xs'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'Update'), 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'class'=>'btn btn-danger btn-xs',
                          'data-confirm-title'=>Yii::t('app', 'Are you sure?'),
                          'data-confirm-message'=>Yii::t('app', 'Are you sure want to delete this item')], 
    ],

];   