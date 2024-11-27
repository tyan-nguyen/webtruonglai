<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Links */
?>
<div class="links-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'link',
            'name_en',
            'link_en',
            'open_new_tab'=>[
                'attribute' => 'open_new_tab',
                'value'=> $model->open_new_tab ? 'YES' : 'NO'
            ],
            'priority',
            'type'
        ],
    ]) ?>

</div>
