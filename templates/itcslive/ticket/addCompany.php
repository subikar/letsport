<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
$Details = $this->editDetails;
//print_r($this->editDetails); exit;
global $my;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	 <form action="" id="addContactForm" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<div style="display: none;">
		   <input type="hidden" name="view" value="mycontact" />
		   <input type="hidden" name="task" value="savecontact" />
		   <input type="hidden" name="refrer_id" value="<?php echo $my->uid; ?>" />
		   <input type="hidden" name="user_id" value="<?php  echo $Details[0]->uid;  ?>" />
		</div> 
		<div class="order_nowform">
		   <fieldset style="width:700px;">
		   <legend><img src="images/contact_head.png"></legend>
		   <h1>Please provide Customer details</h1>
		   <table style="width:500px;">
			  <tbody>
				 <tr>
					<td width="120"> Company Name :</td>
					<td><span class="wpcf7-form-control-wrap name">
				<input name="company_name" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input1" required="true"  type="text" value="<?php   echo $Details[0]->company_name; ?>">
					   </span><span class="error_tag" id="error_name" ></span> </td>
				 </tr>
				 <tr>
					<td width="120">Owner ID :</td>
					<td><span class="wpcf7-form-control-wrap organization">
					<input name="owner_id" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input1" required="true"  type="text" value="<?php  echo $Details[0]->owner_id; ?>" >
				   </span> <span class="error_tag" id="error_organization" ></span>
				   </td>
				 </tr>
			  </tbody>
		   </table>
		   <p><br>
		   </p>		   
		   </fieldset>
		</div>
	 </form>
	 <p style="margin-left:20px; margin-top:20px;">
			<input type="button" value="Create Contact" id="submitcontact" onclick="Ticket.validateAddContact('addContactForm');">
		   </p>
		  </div>
	  </div>
   </div>
</div>