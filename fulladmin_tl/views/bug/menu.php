<?php 
use app\modules\dashboard\models\Catelogies;


$langck = \Yii::$app->getRequest()->getCookies()->getValue('site_lang');
echo 'Your cookie value is: ' . $langck;

?>

<br/>

<ul>
<?php 
    //show menu language
foreach (Yii::$app->params['langs'] as $indexLang => $lang){
?>
	<li><a href="/lang/<?= $indexLang ?>"><?= $lang ?></a></li>
<?php 
}
?>
</ul>

<br/>
Menu:
<br/>
<ul>
<?php 
$cats = (new Catelogies())->getListSlug($langck);
foreach ($cats as $slug=>$catName){
?>
<li><a href="/cat/<?= \app\components\Common::showLangSlug($slug) ?>"><?= $catName ?></a></li>
<?php 
}
?>
</ul>