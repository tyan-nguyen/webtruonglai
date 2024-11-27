<?php 
//set route, if route is search change ?->&
if(isset($route) && $route != null){
    $route = $route . '&';
} else {
    $route = '?';
}
?>
<div class="posts-wrap">
	<?php 
	foreach ($listPosts as $iPost=>$post){
	?>
	 <div class="post"> 
	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="post-body">
                    <div class="entry-header">        
                        <div class="post-meta"></div>
	    		 	</div>
	    		 </div>
                        
	    		<a href="<?= $post->url ?>" class="latest-post-img">
                    <img loading="lazy" class="img-fluid" src="<?= $post->imgCover ?>" alt="img">
                </a>
	    	</div>
	    	<div class="col-md-8">    
                <div class="post-body">
                    <div class="entry-header">
        
                        <div class="post-meta">
                           
                            <span class="post-cat">
                                <i class="far fa-folder-open"></i>
                                <?= $post->getCategoriesView() ?>
                            </span>
                            <span class="post-meta-date"><i class="far fa-calendar"></i> <?= $post->dateCreated ?></span>
                            
                        </div>
                        <h2 class="entry-title">
                            <a href="<?= $post->url ?>"><?= $post->title ?></a>
                        </h2>
        
                    </div><!-- header end -->
                    <div class="entry-content">
                        <p><?= $post->getSummaryByChars() ?></p>
                    </div>
                    
            	</div><!-- post-body end -->
            </div>
        </div>
    </div><!-- post end -->
	<?php } ?>

</div><!-- wrap -->
<nav class="paging" aria-label="Page navigation example">
    <ul class="pagination">
    	<?php 
    	for($iPage=1;$iPage<=$total;$iPage++){
    	    if($iPage==1){
    	?>
    	<li class="page-item <?= $iPage==$current?'disabled':'' ?>"><a class="page-link" href="<?= $route ?>page=1"><i class="fas fa-angle-double-left"></i></a></li>
    	
    	<?php         
    	    }
    	?>
    	
    	<li class="page-item <?= $current==$iPage?'disabled active':'' ?>"><a class="page-link <?= $current==$iPage?'active':'' ?>" href="<?= $route ?>page=<?= $iPage ?>"><?= $iPage ?></a></li>
    	
    	<?php 
    	if($iPage==$total){
    	?>
    	<li class="page-item <?= $iPage==$current?'disabled':'' ?>"><a class="page-link" href="<?= $route ?>page=<?= $total ?>"><i class="fas fa-angle-double-right"></i></a></li>
    	<?php         
    	    }
    	?>
    	
    	<?php } ?>
    
    
       <!--  <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li> -->
    </ul>
</nav>