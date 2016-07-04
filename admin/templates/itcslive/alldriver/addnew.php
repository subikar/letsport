<?php 
 $WorkData=$this->Drivers;
 print_r($WorkData);//exit;
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
			  	<a href="index.php?view=alldriver">Cancel</a>
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
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Name</span>
					<input class="form-control" type="start_location" name="name" value="<?php echo $WorkData->name; ?>" placeholder="Start Location"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>
                  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Address</span>
					<input class="form-control" type="end_location" name="address" value="<?php echo $WorkData->address; ?>" placeholder="End Location"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>				  
				   <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-link"></i>Phone</span>
					<input class="form-control" type="text" name="phone" id="avaliable_date" value="<?php echo $WorkData->phone; ?>" placeholder="Avaliable Date"  style="width:70%"/>
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Place</span>
					<input class="form-control" type="text" name="place" value="<?php echo $WorkData->place; ?>" placeholder="Vehicle Type" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>State</span>
					<input class="form-control" type="text" name="state" id="reporting_time" value="<?php echo $WorkData->state; ?>" placeholder="Reporting Time" style="width:70%" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Driving License No</span>
					<input class="form-control" type="text" name="driving_license_no" value="<?php echo $WorkData->driving_license_no; ?>" placeholder="Material Type" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Adhar Voter Id</span>
					<input class="form-control" type="text" name="adhar_voter_id" value="<?php echo $WorkData->adhar_voter_id; ?>" placeholder="Consignment Weight" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Status ID</span>
					<input class="form-control" type="text" name="status" value="<?php echo $WorkData->status; ?>" placeholder="Owner ID" />
				  </div>
				    <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Driver Owner</span>
					<input class="form-control" type="text" name="driver_owner" value="<?php echo $WorkData->driver_owner; ?>" placeholder="Owner ID" />
				  </div>
				  
				</div>
				<div class="panel-body-right"> 				  
				  <div class="input-group">
				  <div id="" class="uploaded_area">		
				  			  
				 <?php foreach($WorkData->driver_avatar as $image): ?>
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
			  <input type="hidden" name="view" value="alldriver" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="work_id" name="driver_id" value="<?php echo (int)$WorkData->driver_id; ?>" />
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
  