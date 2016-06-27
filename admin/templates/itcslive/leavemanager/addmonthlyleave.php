<?php global $Config; ?>
<form name="monthlyLeave_addForm" id="monthlyLeave_addForm" action="" method="post" enctype="multipart/form-data">
	<span class="error_form_area" style="color:#FF0099;"></span>
   <div class="input_fieldsArea"> 
	  <p>Select User: <input title="Select User" type="text" name="user" id="text_user" required="true"/></p>
	  <p>Select Month: <input title="Select Month" type="text" name="text_month" id="text_date" required="true" /></p>
	  <p>No. of Leave Taken: <input title="No. of Leave Taken" type="text" name="text_leave" id="text_leave" required="true" /></p>
      <div class="clear"></div>
   </div>
   <input type="hidden" name="view" value="leavemanager" />
   <input type="hidden" name="task" value="saveLeave" />
</form>
 <input type="submit" name="Save" value="Save" onclick="leavemanager.validateMonthlyLeave('monthlyLeave_addForm');" />
<script>
jQuery(document).ready(function() {
parent.jQuery.colorbox.resize({width:"40%", height:"60%"});
});	
</script>
