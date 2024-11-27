<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TagList */
?>
<div class="tag-list-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'seo_title',
            'seo_description',
            'date_created',
        ],
    ]) ?>

</div>
