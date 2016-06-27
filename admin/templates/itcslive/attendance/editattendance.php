<?php 
	error_reporting(0);
	$attendance=$this->attendaceDetails;
	//print_r($attendance); exit;
	/*global $my;
	$user_id=((int)$testimonial->author)? $testimonial->author : $my->uid;*/
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	
	<form name="SavePage" action="" method="post" enctype="multipart/form-data" onsubmit="return Testimonial.validateForm(this);">
	
      <div class="ng-scope" id="page-heading">
        <h1>Edit Attendance</h1>
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
			  	<a href="index.php?view=attendance">Cancel</a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Edit Attendance</h4>
              </div>
			  <div class="input_fieldsArea">
			  	User Name : <input class="form-control" type="text" name="user_name" value="<?php echo $attendance->name; ?>" /><br />
				Attendance In : <input class="form-control" type="text" id="text_dateIn" name="attendance_in" value="<?php echo $attendance-> attendance_in; ?>" /><br />
				Attendance Out : <input class="form-control" type="text" name="attendance_out" id="text_dateOut" value="<?php echo $attendance->attendance_out; ?>" width="85%" /><br />
				Reason(if late) : 
				<textarea name="reason" ><?php echo $attendance->reason; ?></textarea><br />
				IP Address : <input class="form-control" type="text" name="ip_address" value="<?php echo $attendance->ip; ?>" /><br />
				Timezone : <input class="form-control" type="text" name="timezone" value="<?php echo $attendance->timezone; ?>" />
				 <div class="clear"></div>
			  </div>
			  <input type="hidden" name="view" value="attendance" />
			  <input type="hidden" name="task" value="saveattendance" />
			  <input type="hidden" id="attendance_id" name="attendance_id" value="<?php echo (int)$attendance->id; ?>" />		  
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
<script>
	jQuery(document).ready(function() {
		jQuery("#text_dateOut").kendoDateTimePicker({ format: "yyyy-MM-dd HH:mm" });
		jQuery("#text_dateIn").kendoDateTimePicker({ format: "yyyy-MM-dd HH:mm" });
	});	
</script>