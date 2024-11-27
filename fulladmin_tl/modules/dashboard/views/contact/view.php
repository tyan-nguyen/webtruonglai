<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contact */
?>
<div class="contact-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'email:email',
            'phone',
            'subject:ntext',
            'message:ntext',
            'services'=>[
                'attribute' => 'services',
                'value'=>$model->serviceName
            ],
            'viewed'=>[
                'attribute'=>'viewed',
                'format'=>'html',
                'value'=>$model->viewed == 0 ? '<span class="label label-warning">New</span>' : '<span class="label label-default">Viewed</span>'
            ],
            'date_created'=>[
                'attribute' => 'date_created',
                'value' => $model->dateCreated
            ],
        ],
    ]) ?>

</div>
