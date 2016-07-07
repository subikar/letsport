<?php 
 $WorkData=$this->WorkData;
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
			  	<a href="index.php?view=ourworks">Cancel</a>
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
				  	<span class="input-group-addon">Start Location</span>
					<input class="placepicker form-control" type="start_location" name="start_location" value="<?php echo $WorkData->start_location; ?>" placeholder="Start Location"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>
                  <div class="input-group">
				  	<span class="input-group-addon">End Location</span>
					<input class="placepicker form-control" type="end_location" name="end_location" value="<?php echo $WorkData->end_location; ?>" placeholder="End Location"  />
				 	<span id="error_title" style="color:#FF00CC;"></span>
				  </div>				  
				   <div class="input-group">
				  	<span class="input-group-addon">Avaliable Date</span>
					<input class="form-control" type="date" name="avaliable_date" id="avaliable_date" value="<?php echo $WorkData->avaliable_date; ?>" placeholder="Avaliable Date"  />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Vehicle Type</span>
					<input class="form-control" type="text" name="vehicle_type" value="<?php echo $WorkData->vehicle_type; ?>" placeholder="Vehicle Type" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Reporting Time</span>
					<input class="form-control" type="time" name="reporting_time" id="reporting_time" value="<?php echo $WorkData->reporting_time; ?>" placeholder="Reporting Time" style="width:70%" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Material Type</span>
					<input class="form-control" type="text" name="material_type" value="<?php echo $WorkData->material_type; ?>" placeholder="Material Type" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Consignment Weight</span>
					<input class="form-control" type="text" name="consignment_weight" value="<?php echo $WorkData->consignment_weight; ?>" placeholder="Consignment Weight" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Owner ID</span>
					<input class="form-control" type="text" name="owner_id" value="<?php echo $WorkData->owner_id; ?>" placeholder="Owner ID" />
				  </div>
				</div>
				
				 <div class="clear"></div>
			  </div>
			  <input type="hidden" name="view" value="ourworks" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="work_id" name="work_id" value="<?php echo (int)$WorkData->id; ?>" />
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
  