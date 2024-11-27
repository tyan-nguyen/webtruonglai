<?php

use yii\helpers\Html;

$this->title = 'Add new ' . ($static == 'true' ? 'Page' : 'Post');
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */

?>

<div class="news-create">
    <?= $this->render('_form', [
        'model' => $model,
        'catalogLists' => $catalogLists,
        'lang'=>$lang,
        'static'=>$static
    ]) ?>
</div>
