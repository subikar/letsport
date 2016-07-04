<?php
defined ('ITCS') or die ("Go away.");
$Truck = $this->truckdetails;
global $my,$mainframe;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	 <form action="" id="addContactForm" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<div style="display: none;">
		   <input type="hidden" name="view" value="dashboard" />
		   <input type="hidden" name="task" value="savetruck" />
		   <input type="hidden" name="truck_owner_id" value="<?php  echo $my->uid;  ?>" />
		   <input type="hidden" name="truck_id" value="<?php  echo $Truck->truck_id;  ?>" />
		</div>
		
		<div class="table_edituser">
			<ul>
				<li>Truck Type:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<?php $mainframe->selectbox('truck_type',$this->VehcleType,$Truck->truck_type); ?>
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Driver No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="truck_no" size="40" required="true"  type="text" value="<?php   echo $Truck->truck_no; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Registration No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="registration_no" size="40" required="true"  type="text" value="<?php   echo $Truck->registration_no; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Chasis No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="chasis_no" size="40" required="true"  type="text" value="<?php   echo $Truck->chasis_no; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Engine No:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="engine_no" size="40" required="true"  type="text" value="<?php   echo $Truck->engine_no; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Registration Date:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="truck_registration_date" size="40" required="true"  type="date" value="<?php echo $Truck->truck_registration_date; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
				<li>Insurance Date:</li>
				<li><span class="wpcf7-form-control-wrap name">
					<input name="insurance_date" size="40" required="true"  type="date" value="<?php echo $Truck->insurance_date; ?>">
					</span><span class="error_tag" id="error_name" ></span>
				</li>
					<li>&nbsp;</li>
				<li><input type="submit" value="<?php echo ((int)$Truck->truck_id == 0)?'Create Truck':'Update Truck'; ?>" id="submitcontact" /></li>
			</ul>
		</div>
	 </form>
		    
		 </div>
	  </div>
   </div>
</div>



