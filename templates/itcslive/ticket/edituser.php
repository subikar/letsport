<?php
	error_reporting(0); 
	defined ('ITCS') or die ("Go away.");
	global $my;
	$user = $this->userDetails;
?>
	 <form id="edituserForm" method="post" class="form" novalidate="novalidate" enctype="multipart/form-data" >
		
		   <input type="hidden" name="view" value="user" />
		   <input type="hidden" name="task" value="saveuser" />
		   <input type="hidden" name="user_id" id="user_id" value="<?php echo $user[0]->uid; ?>" />
		
		<div class="table_edituser">
		
			<ul>
				<li>Name :</li>
				<li>
					<input name="name" size="40"  required="true" type="text" value="<?php  echo $user[0]->name;  ?>" />
					<span class="error_tag" id="error_name" ></span> 
				</li>
				<li>Designation :</li>
				<li>
					<input name="designation" size="40"  required="true" type="text" value="<?php  echo $user[0]->designation;  ?>" />
				    <span class="error_tag" id="error_designation" ></span>
				</li>
				<li>Organization :</li>
				<li>
					<input name="Company" size="40"  required="true" type="text" value="<?php  echo $user[0]->Company;  ?>" />
				    <span class="error_tag" id="error_organization" ></span>
				</li>
				<li>Country :</li>
				<li>
					<input name="country" size="40"  required="true" type="text" value="<?php  echo $user[0]->country;  ?>" />
					 <span class="error_tag" id="error_country" ></span>
				</li>
				<li>Email ID:</li>
				<li>
					<input name="email" size="40" type="text" value="<?php  echo $user[0]->email ?>" onblur="return User.checkEmail(this);" />
					<span class="error_tag" id="error_email" ></span>
				</li>
				<li>Phone No :</li>
				<li>
					<input name="phone" size="40" type="text" value="<?php  echo $user[0]->phone;  ?>" />
					<span class="error_tag" id="error_phonenunber" ></span>
				</li>
				<li>Address :</li>
				<li>
					<input name="address" size="40" type="text" value="<?php  echo $user[0]->address;  ?>" />
					<span class="error_tag" id="error_address" ></span>
				</li>
				<li>Postal Code :</li>
				<li>
					<input name="postal" size="40" type="text" value="<?php  echo $user[0]->postal;  ?>" />
					<span class="error_tag" id="error_postal" ></span>
				</li>
				<li>City :</li>
				<li>
					<span class="wpcf7-form-control-wrap phonenunber">
					   <input name="city" size="40" class="wpcf7-form-control wpcf7-text input1" type="text" value="<?php  echo $user[0]->city;  ?>" />
					   </span><span class="error_tag" id="error_city" ></span>
				</li>
				<li>State :</li>
				<li><span class="wpcf7-form-control-wrap phonenunber">
					   <input name="state" size="40" class="wpcf7-form-control wpcf7-text input1" type="text" value="<?php  echo $user[0]->state;  ?>" />
					   </span><span class="error_tag" id="error_state" ></span></li>
				<li>Profile Picture :</li>
				<li><span id="imgMessage"></span>
					
					   <input name="avatar" size="40" class="wpcf7-form-control wpcf7-text input1" type="file" onchange="User.imageupload(this)" style="padding:0 0 0 5px;" />
					   <br clear="all" />
					   <span><img id="img_progress" src="<?php echo $Config->site; ?>images/photo_loader.gif" style="width:200px; height:20px; display:none;"/></span>
					   <span class="error_tag" id="error_avatar" ></span>
					   <span class="sp_image_upload" id="uploadedImage">
					   <?php   	if($user[0]->avatar != ''):		   ?>
					   		<img src="<?php echo $Config->site.$user[0]->avatar; ?>" style="height:100px; width:100px;" />
						<?php  endif; ?>
					</span></li>
					<li>&nbsp;</li>
					<li><input type="button" value="Update" id="submitcontact" onclick="User.submitForm('edituserForm');" /></li>
			</ul>
		
		   </div>
		</div>
	 </form>
	 
	  
	