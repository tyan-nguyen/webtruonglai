 <?php
 	use webvimark\modules\UserManagement\models\User;
    use app\modules\dashboard\models\PostType;
    use app\modules\dashboard\models\Links;
use app\modules\dashboard\models\Contact;
 ?>
      <ul class="sidebar-menu" data-widget="tree">
      	<li>
          <a href="<?= Yii::getAlias('@web') ?>/">
            <i class="fa fa-home" aria-hidden="true"></i> <span><?= Yii::t('app', 'Home Page')?> . (<?= Yii::$app->language ?>)</span>
          </a>
        </li>
        
        <li class="header"><?= Yii::t('app', 'POSTS GROUP')?></li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span><?= Yii::t('app', 'POSTS')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
    		<ul class="treeview-menu">
            <?php if(User::hasRole('bientapvien')) { ?> 
            <?php 
                $postTypes = PostType::find()->where(['enable'=>1])->all();
                foreach ($postTypes as $iPostType=>$postType){
            ?>
            <li><a href="<?= $postType->adminLink ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', $postType->code) ?></a></li> 
            <?php 
                }
            ?>
            
            <?php } ?>
            <?php if(User::hasRole('bientapvien')) { ?> 
            <li><a href="<?= Yii::getAlias('@web') ?>/dashboard/catelogies"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Catelogies')?></a></li> 
            <?php } ?>
             <?php if(User::hasRole('bientapvien')) { ?> 
            <li><a href="<?= Yii::getAlias('@web') ?>/dashboard/tag-list"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Tags')?></a></li> 
            <?php } ?>
           
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>LINKS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
    		<ul class="treeview-menu">
    			<?php 
    			$linkTypes = (new Links())->getTypeLink();
    			foreach ($linkTypes as $indexType=>$nameType){
    			?>
           		<li><a href="/dashboard/links/index?type=<?= $indexType ?>"><i class="fa fa-circle-o"></i><?= $nameType ?></a></li>
           		<?php }?>
          	</ul>
        </li>
        
         <?php if(User::hasRole('thongketruycap')) { ?>
          <li>
              <a href="<?= Yii::getAlias('@web') ?>/dashboard/thong-ke-truy-cap">
              
                <i class="fa fa-line-chart"></i> <span><?= Yii::t('app', 'USER ACCESS')?></span>
              </a>
        	</li>
        	
         	<li>
              <a href="<?= Yii::getAlias('@web') ?>/dashboard/contact">
              
                <i class="fa fa-envelope"></i> <span><?= Yii::t('app', 'CONTACT')?></span> <span class="badge"><?= (new Contact())->getCountNewContact() ?></span>
              </a>
        	</li>
        	
          
        <?php } ?>
         <li class="header"><?= Yii::t('app', 'ACCOUNT')?></li>
        <?php if(User::hasRole('Admin')) { ?> <li><a href="<?= Yii::getAlias('@web') ?>/user-management/user"><i class="fa fa-circle-o text-red"></i> <span><?= Yii::t('app', 'Manage Account')?></span></a></li> <?php } ?>
        <li><a href="<?= Yii::getAlias('@web') ?>/user-management/auth/change-own-password"><i class="fa fa-circle-o text-yellow"></i> <span><?= Yii::t('app', 'Change Password')?></span></a></li>
        <li><a href="<?= Yii::getAlias('@web') ?>/user-management/auth/logout"><i class="fa fa-circle-o text-aqua"></i> <span><?= Yii::t('app', 'Log out')?></span></a></li>
      </ul>



