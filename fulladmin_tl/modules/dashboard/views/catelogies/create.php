<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Catelogies */

?>
<div class="catelogies-create">
    <?= $this->render('_form', [
        'model' => $model,
        'code'=>$code
    ]) ?>
</div>
