<?php
defined ('ITCS') or die ("Go away.");
$Driver = $this->driverdetails;
global $my,$mainframe;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	 <form action="" id="addContactForm" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<div style="display: none;">
		   <input type="hidden" name="view" value="dashboard" />
		   <input type="hidden" name="task" value="savedriver" />
		   <input type="hidden" name="driver_owner" value="<?php  echo $my->uid;  ?>" />
		   <input type="hidden" name="driver_id" value="<?php  echo $Driver->driver_id;  ?>" />
		</div>
		
		<div class="table_edituser">
			<ul>
 
				<li>Driver Nme:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="name" size="40" required="true"  type="text" value="<?php   echo $Driver->name; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Address:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="address" size="40" required="true"  type="text" value="<?php   echo $Driver->address; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Phone No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="phone" size="40" required="true"  type="text" value="<?php   echo $Driver->phone; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Place:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="place" size="40" required="true"  type="text" value="<?php echo $Driver->place; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>State:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="state" size="40" required="true"  type="text" value="<?php echo $Driver->state; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Driving License No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="driving_license_no" size="40" required="true"  type="text" value="<?php echo $Driver->driving_license_no; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Adhar / Votrer ID:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="adhar_voter_id" size="40" required="true"  type="text" value="<?php echo $Driver->adhar_voter_id; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Driver Avatar:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="driver_avatar" size="40" required="true"  type="file" />
					<?php 
					//print_r($Driver); 
					if($Driver->driver_avatar != ''):?>
					<img src="images/driver_avatar/<?php echo $Driver->driver_avatar ?>" />
					<?php endif; ?>
				</li>
					<li>&nbsp;</li>
				<li><input type="submit" value="<?php echo ((int)$Driver->driver_id == 0)?'Create Drive':'Update Driver'; ?>" id="submitcontact" /></li>
			</ul>
		</div>
	 </form>
		    
		 </div>
	  </div>
   </div>
</div>



