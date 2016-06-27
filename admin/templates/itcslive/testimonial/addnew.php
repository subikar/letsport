<?php 
	error_reporting(0);
	$testimonial=$this->testimonialData;
	/*global $my;
	$user_id=((int)$testimonial->author)? $testimonial->author : $my->uid;*/
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SavePage" method="POST" enctype="multipart/form-data" onsubmit="return Testimonial.validateForm(this);" >
      <div class="ng-scope" id="page-heading">
        <h1>Add/Edit Testimonial</h1>
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
			  	<a href="index.php?view=testimonial">Cancel</a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create Testimonial</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  	<div class="panel-body-left">
				<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-link"></i></span>
				<input class="form-control" type="text" name="alias" value="<?php echo $this->seoData->seo; ?>" placeholder="Enter alias" onblur="return Testimonial.checkDuplicate(this);" />
				 <span id="error_alias" style="color:#FF00CC;"></span>
				  </div>
					<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i></span>
					<input class="form-control" type="text" name="client_name" id="client_name" value="<?php echo $testimonial->client_name; ?>" placeholder="Enter Name" onblur="return Testimonial.checkDuplicate(this);" />
				 <span id="error_title" style="color:#FF00CC;"></span>
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input class="form-control" type="text" id="client_email" name="client_email" value="<?php echo $testimonial->client_email; ?>" placeholder="Enter Email ID" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
				<input class="form-control" type="text" id="client_phone" name="client_phone" value="<?php echo $testimonial->client_phone; ?>" placeholder="Enter Phone Number" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
					<input class="form-control" type="text" id="client_address" name="client_address" value="<?php echo $testimonial->client_address; ?>" placeholder="Enter Address" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
					<textarea class="tinyEditor" id="editor" name="testimonial_content" placeholder="Enter Content" style="height:400px;" >
					<?php echo $testimonial->testimonial_content; ?>
					</textarea>
				</div>
				 <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-globe"></i></span>
					<input class="form-control" type="text" name="website" value="<?php echo $testimonial->website; ?>" placeholder="Enter Website" />
				  </div>
				</div>
				<div class="panel-body-right"> 				  
				  <div class="input-group">
				  <div id="" class="uploaded_area">				  
				 <?php foreach($testimonial->gallery as $image): ?>
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
								<input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Testimonial.uplodeGallery(this,1);"/>
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
			  <input type="hidden" name="view" value="testimonial" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" name="author" value="<?php echo (int)$user_id; ?>" /> 
			  <input type="hidden" id="testimonial_id" name="testimonial_id" value="<?php echo (int)$testimonial->id; ?>" />
			  <input type="hidden" name="gallery_id" value="<?php echo (int)$testimonial->gallery_id; ?>" /> 			  
			  
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
  