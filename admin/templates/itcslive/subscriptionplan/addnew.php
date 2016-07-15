<?php 
 $WorkData=$this->SubscriptionPlan;
// print_r($WorkData);//exit;
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SavePage" action="" method="post" enctype="multipart/form-data">
      <div class="ng-scope" id="page-heading">
        <h1>Add/Edit Availibility</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-group" dropdown="">
			 <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save" value="Save" />
			  </div>
              <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save_close" value="Save&Close" />
			  </div>
			  <div class="btn btn-default dropdown-toggle btn-save">
			  	<a href="index.php?view=subscriptionplan">Cancel</a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create Availibility</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  	<div class="panel-body-left">
					<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Subscription Name</span>
					<input class="form-control" type="text" name="subscription_name" value="<?php echo $WorkData->subscription_name; ?>" placeholder="Subscription Name"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>
                  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Amount</span>
					<input class="form-control" type="text" name="amount" value="<?php echo $WorkData->amount; ?>" placeholder="Amount"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>				  
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Bids Number</span>
					<input class="form-control" type="text" name="bids_number" value="<?php echo $WorkData->bids_number; ?>" placeholder="Bids Number" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Status </span>
					<input class="form-control" type="text" name="status" value="<?php echo $WorkData->status; ?>" placeholder="Status" />
				</div>
				<div class="panel-body-right"> 				  
				  <div class="input-group">
				  <div id="" class="uploaded_area">		
				  			  
				 <?php foreach($WorkData->image as $image): ?>
				 <span class="total_uploaded_pic">
					 <span>
					 	<img src="../images/gallery/<?php echo $image; ?>"/>
					 </span>
					 <span>				 
					 	<input type="checkbox" name="remove_gallery[]" value="<?php echo $image; ?>" />Delete:
					 </span>
					 <div class="clear"></div>
				 </span>
				 <?php endforeach; ?>
				  </div>
				  <div class="clear"></div>
				  	<div class="upload_area"><span><i class="fa fa-upload"></i></span><span class="upload_div">Upload Gallery:</span></div>
						<div id="prevworkGroup" class="galleryarea">
							<div class="add_image">
								<div id="prevworkBoxDiv1" class="input_browse">
								<div id="message1"></div>
								<label>Gallery#1: </label>
								<input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Ourworks.uplodeGallery(this,1);"/>
							  	</div>
								<img id="img_progress1" src="../images/photo_loader.gif" style="width:200px; height:20px; display:none;"/>
							  <span class="sp_image_upload"><img id="blah1" src="../images/no_image_found.jpg" style="height:100px; width:100px;" align="right" /></span>
							  <div class="clear"></div>
							  </div>
						  </div>
						  <input type='button' value='+' id='addButton'>
						 <input type='button' value='-' id='removeButton'>
				  </div> 
				 </div>
				 <div class="clear"></div>
			  </div>
			  <input type="hidden" name="view" value="subscriptionplan" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="work_id" name="subscription_id" value="<?php echo (int)$WorkData->subscription_id; ?>" />
			  <input type="hidden" name="gallery_id" value="<?php echo (int)$WorkData->gallery_id; ?>" /> 			  
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
    </div>
	</form>
  </div>
  <div class="clear"></div>
  </div>
  <style>
  .page{ width:300px;}
  </style>
  