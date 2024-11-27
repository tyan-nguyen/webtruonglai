<?php 
use app\modules\dashboard\models\Links;

function getChildCatalog($pid){
    $childLinks = Links::find()->where(['pid'=>$pid])->andFilterWhere(['type'=>'MENU_TOP'])->all();
    foreach ($childLinks as $iLinkChid=>$linkChid){
        if($linkChid->numberChildren()==0){
            echo '<li><a href="'.$linkChid->link.'">'.$linkChid->name.'</a></li>';
        } else {
            echo
            '<li class="dropdown-submenu">
            <a href="'.$linkChid->link.'" class="dropdown-toggle" data-toggle="dropdown">'.$linkChid->name.'</a>
            <ul class="dropdown-menu">
            ' .
            getChild2nd($linkChid->id)
            . '</ul>
            </li>';
        }
    }
}

function getChild2nd($pid){
    $result = '';
    $childLinks = Links::find()->where(['pid'=>$pid])->andFilterWhere(['type'=>'MENU_TOP'])->all();
    foreach ($childLinks as $iLinkChid=>$linkChid){
        $result .= '<li><a href="'.$linkChid->link.'">'.$linkChid->name.'</a></li>';
    }
    return $result;
}

$langid = Yii::$app->params['mainLang'];
$parentLinks = Links::find()->where("pid IS NULL OR pid = 0 AND lang = '".$langid."'")->andFilterWhere(['type'=>'MENU_TOP'])->all();
?>

<div class="site-navigation">
<div class="container">
    <div class="row">
      <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-dark p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div id="navbar-collapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav mr-auto">

                  <li class="nav-item nav-item-logo">
                      <a href="#" class="nav-link dropdown-toggle"><img loading="lazy" class="logo-in-nav" src="/ntweb/images/footer-logo.png" alt="Constra"></a>
                  </li>
                  
                  <?php 
                  foreach ($parentLinks as $i=>$link){
                      if($link->numberChildren()==0){
                  ?>
                  <li class="nav-item active">
                      <a href="<?= $link->link ?>" class="nav-link dropdown-toggle"><?= $link->name ?></a>
                  </li>
                  <?php 
                      } else {
                  ?>
                  	<li class="nav-item dropdown">
                      <a href="<?= $link->link ?>" class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $link->name ?> <i class="fa fa-angle-down"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <?php getChildCatalog($link->id) ?>
                      </ul>
                      </li>
                  <?php     
                      }
                  }
                  ?>
                  
                </ul>
            </div>
          </nav>
      </div>
      <!--/ Col end -->
    </div>
    <!--/ Row end -->

    <div class="nav-search">
      <span id="search"><i class="fa fa-search"></i></span>
    </div><!-- Search end -->

    <div class="search-block" style="display: none;">
    <form method="get" action="/search">
      <label for="search-field" class="w-100 mb-0">
      		<input name="search" type="text" class="form-control" id="search-field" placeholder="Nhập thông tin tìm kiếm..." required="required">
      </label>
       </form>
      <span class="search-close">&times;</span>
    </div><!-- Site search end -->
</div>
<!--/ Container end -->

</div>