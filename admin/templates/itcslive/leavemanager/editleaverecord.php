<?php global $Config; ?>
<form name="updateRecord" id="updateRecord" action="" method="post" enctype="multipart/form-data">
   <span class="error_form_area" style="color:#FF0099;"></span>
   <div class="input_fieldsArea"> 
  <p>User: <?php echo $this->leaveRecord->name; ?></p>
  <p>Month and Year: <?php echo $this->leaveRecord->month."/".$this->leaveRecord->year; ?></p>
  <p>No. of Allocated Leave: <input type="text" name="text_leave" id="text_leave" value="<?php echo $this->leaveRecord->leave_deduct; ?>" required="true" /></p>
      <div class="clear"></div>
   </div>
   <input type="hidden" name="employee_id" value="<?php echo $this->leaveRecord->employee_id; ?>" />
   <input type="hidden" name="record_id" value="<?php echo $this->leaveRecord->id; ?>" />
   <input type="hidden" name="view" value="leavemanager" />
   <input type="hidden" name="task" value="updateLeaveRecord" />
   <input type="submit" name="Save" value="Save" />
</form>
<!--<input type="button" name="Save" value="Save" onclick="leavemanager.validateYearlyLeave('yearlyLeave_addForm');" />-->
<script>
jQuery(document).ready(function() {
parent.jQuery.colorbox.resize({width:"50%", height:"60%"});
});	
</script>
