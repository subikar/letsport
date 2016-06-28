<?php 
defined ('ITCS') or die ("Go away.");
	global $my;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
	  <span id="error_pass_update"></span>
         <div class="wpcf7" id="pass_update_form_div">
		 	
            <form id="editpassForm" method="post" class="wpcf7-form"  onsubmit="return false;">
                  <input type="hidden" name="view" value="user" />
                  <input type="hidden" name="task" value="updatePassword" />
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo (int)$my->uid; ?>" />
				  
				  <div class="table_edituser">
				  <ul>
				  	<li><label>Type Your Old Password:</label></li>
					<li><input type="password" name="old_pass" id="old_pass" required="true" /></li>
				  	<li><label>Type New Password:</label></li> 
					<li><input type="password" name="new_pass" id="new_pass" required="true" /></li>
				  	<li><label>Retype New Password:</label></li> 
					<li><input type="password" name="retype_new_pass" id="retype_new_pass" required="true" /></li>
					<li>&nbsp;</li>
					<li><input type="button" name="save" value="Save" onclick="Ticket.UpdatePassword('editpassForm');" /></li>
				  </ul>
				  </div>
            </form>
			
			
         </div>
      </div>
   </div>
</div>
