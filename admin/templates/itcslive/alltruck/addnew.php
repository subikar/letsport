<?php 

 $Trucks = $this->Trucks;
 //print_r($this->Trucks);//exit;
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
			  	<a href="index.php?view=alltruck">Cancel</a>
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
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Truck Type</span>
					<input class="form-control" type="start_location" name="truck_type" value="<?php echo $Trucks->truck_type; ?>" placeholder="Truck Type"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>
                  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i> Registration No</span>
					<input class="form-control" type="end_location" name="registration_no" value="<?php echo $Trucks->registration_no; ?>" placeholder="Registration No"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>				  
				   <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-link"></i>Chasis No</span>
					<input class="form-control" type="text" name="chasis_no" id="avaliable_date" value="<?php echo $Trucks->chasis_no; ?>" placeholder="Chasis No"  style="width:70%"/>
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Engine No</span>
					<input class="form-control" type="text" name="engine_no" value="<?php echo $Trucks->engine_no; ?>" placeholder="Engine No" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Truck Registration Date</span>
					<input class="form-control" type="text" name="truck_registration_date" id="reporting_time" value="<?php echo $Trucks->truck_registration_date; ?>" placeholder="Truck Registration Date" style="width:70%" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Insurance Date</span>
					<input class="form-control" type="text" name="insurance_date" value="<?php echo $Trucks->insurance_date; ?>" placeholder="Insurance Date" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i>Truck No</span>
					<input class="form-control" type="text" name="truck_no" value="<?php echo $Trucks->truck_no; ?>" placeholder="Truck No" />
				  </div>
				</div>
				<div class="panel-body-right"> 				  
				  <div class="input-group">
				  <div id="" class="uploaded_area">				  
				 <?php foreach($WorkData->gallery as $image): ?>
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
			  <input type="hidden" name="view" value="alltruck" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="work_id" name="truck_id" value="<?php echo (int)$Trucks->truck_id; ?>" />
			  <input type="hidden" name="gallery_id" value="<?php echo (int)$Trucks->gallery_id; ?>" /> 			  
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
  