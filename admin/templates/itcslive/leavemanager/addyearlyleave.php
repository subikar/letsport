<?php global $Config; ?>
<form name="yearlyLeave_addForm" id="yearlyLeave_addForm" action="" method="post" enctype="multipart/form-data">
   <span class="error_form_area" style="color:#FF0099;"></span>
   <div class="input_fieldsArea"> 
  <p>Select User: <input type="text" name="user" id="text_user" required="true" /></p>
  <p>Select Year: <input type="text" name="text_year" id="text_year" required="true" /></p>
  <p>No. of Allocated Leave: <input type="text" name="text_leave" id="text_leave" required="true" /></p>
      <div class="clear"></div>
   </div>
   <input type="hidden" name="view" value="leavemanager" />
   <input type="hidden" name="task" value="saveYearlyLeave" />
</form>
<input type="submit" name="Save" value="Save" onclick="leavemanager.validateYearlyLeave('yearlyLeave_addForm');" />
<script>
jQuery(document).ready(function() {
parent.jQuery.colorbox.resize({width:"50%", height:"70%"});
});	
</script>
