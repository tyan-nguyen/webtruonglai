 <!-- Button HTML (to Trigger Modal) -->
    <!-- <a href="#myModal" class="btn btn-primary btn-lg" data-toggle="modal">Launch Demo Modal</a> -->
    
    <!-- Modal HTML -->
   <!--  <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">YouTube Video</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="cartoonVideo" class="embed-responsive-item" width="560" height="315" src="//www.youtube.com/embed/YE7VzlLtp-4" allowfullscreen></iframe>
                  </div>
                </div>
            </div>
        </div>
    </div>
     -->
    
    
    <!-- Button to Open the Modal -->
<!--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
  Open modal
</button>
-->
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <!-- <div class="modal-header" style="border-bottom:0px">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>-->

      <!-- Modal body -->
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
        	<!-- <img src="<?= Yii::getAlias('@web/images/icons/loading.gif') ?>" />-->
                    <iframe id="cartoonVideo" class="embed-responsive-item" width="100%" height="315" src="" allowfullscreen></iframe>
                    <!-- //www.youtube.com/embed/YE7VzlLtp-4 -->
                  </div>
      </div>

      <!-- Modal footer -->
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>