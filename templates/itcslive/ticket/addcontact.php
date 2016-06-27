<?php
defined ('ITCS') or die ("Go away.");
$Details = $this->editDetails;
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
		
		<div class="table_edituser">
			<ul>
				<li>Name :</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="name" size="40" required="true"  type="text" value="<?php   echo $Details[0]->name; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Organization :</li>
				<li><span class="wpcf7-form-control-wrap organization">
					<input name="Company" size="40" required="true"  type="text" value="<?php  echo $Details[0]->Company; ?>" >
				   </span> <span class="error_tag" id="error_organization" ></span>
				</li>
				<li>Designation :</li>
				<li><span class="wpcf7-form-control-wrap organization">
					<input name="designation" size="40" required="true"  type="text" value="<?php  echo $Details[0]->designation; ?>" >
				   </span> <span class="error_tag" id="error_organization" ></span>
				</li>
				<li>Email :</li>
				<li><span class="wpcf7-form-control-wrap email">
					<input name="email" size="40" type="text" value="<?php  echo $Details[0]->email;  ?>">
					</span> <span class="error_tag" id="error_email" ></span>
				</li>
				<li>Phone No :</li>
				<li><span class="wpcf7-form-control-wrap phonenunber">
					<input name="phone" size="40" type="text" value="<?php  echo $Details[0]->phone;  ?>">
					</span><span class="error_tag" id="error_phonenunber" ></span>
				</li>
				<li>Land Phone No :</li>
				<li><span class="wpcf7-form-control-wrap phonenunber">
					<input name="landphone" size="40" type="text" value="<?php  echo $Details[0]->landphone;  ?>">
					</span><span class="error_tag" id="error_landphone" ></span>
				</li>
				<li>Skype ID :</li>
				<li><span class="wpcf7-form-control-wrap phonenunber">
					<input name="skype_id" size="40" type="text" value="<?php  echo $Details[0]->skype_id;  ?>">
					</span><span class="error_tag" id="error_skype_id" ></span>
				</li>
				<li>Country :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<input name="country" size="40" required="true" type="text" value="<?php  echo $Details[0]->country;  ?>">
					</span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>State :</li>
				<li><span class="wpcf7-form-control-wrap country">
					   <input name="state" size="40" required="true" type="text" value="<?php  echo $Details[0]->state;  ?>">
					   </span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>City :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<input name="city" size="40" required="true" type="text" value="<?php  echo $Details[0]->city;  ?>">
					</span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>Postal Code :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<input name="postal" size="40" required="true" type="text" value="<?php  echo $Details[0]->city;  ?>">
					</span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>Address :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<input name="address" size="40" required="true" type="text" value="<?php  echo $Details[0]->address;  ?>">
					</span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>Has Requirement? :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<input name="hasrequirement" type="checkbox" <?php  echo $Details[0]->hasrequirement?'checked="checked"':'';  ?> >
					</span><span class="error_tag" id="error_hasrequirement" ></span>
				</li>
				<li>Note :</li>
				<li><span class="wpcf7-form-control-wrap country">
					<textarea name="note"><?php  echo $Details[0]->note; ?></textarea>
					</span><span class="error_tag" id="error_country" ></span>
				</li>
				<li>&nbsp;</li>
				<li><input type="button" value="<?php echo ((int)$Details[0]->uid == 0)?'Create Contact':'Update Contact'; ?>" id="submitcontact" onclick="Ticket.validateAddContact('addContactForm');" /></li>
			</ul>
		</div>
	 </form>
		    
		 </div>
	  </div>
   </div>
</div>
<!--<script type="text/javascript">
jQuery(document).ready(function(){
parent.jQuery.colorbox.resize({width:"50%", height:"120%"});
});
</script>-->

<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"550px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"550px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"475px", height:"550px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"550px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"550px"});
		}
});
</script>


