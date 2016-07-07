<?php global $mainframe ?>
<form action="" method="post" class="form-horizontal getofferForm" name="AddTruck" id="AddTruck" target="_parent">
<div class="container popupform">

			<div class="grid_4"> 

				<label class="control-label" for="name">From Location:</label>

				<input name="from_location" id="from_location" title="From Location" value="" class="required-entry validate_me span12 placepicker" type="text" placeholder="From Location" data-type="geo_code">
                <input type="hidden" name="from_lat" id="load_from_lat" value="">
				<input type="hidden" name="from_lng" id="load_from_lng" value=""> 
				<span style="display: none;" class="error error-empty error_tag">*This is not a valid Form Location.</span>

				<span style="display: none;" id="error_name" class="empty error-empty error_tag">*This field is required.</span> </label>

                <i class="icon-user-2"></i>

			</div>

			<div class="grid_4">

				 <label class="control-label" for="email">To Location:</label>

				 <input name="to_location" id="to_location" title="Enter To Location" value="" class="input-xlarge required-entry validate-email validate_me span12 placepicker" data-type="geo_code" type="email" placeholder="Enter To Location">
				 <input type="hidden" name="to_lat" id="load_to_lat" value="">
				 <input type="hidden" name="to_lng" id="load_to_lng" value="">

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid email address.</span>

				<span style="display: none;" id="error_email" class="empty error-empty error_tag">*This field is required.</span> </label>

				<i class="icon-mail-2"></i>

			</div>
			<div class="grid_4">

				 <label class="control-label" for="email">Available Date:</label>

				 <input type="date" name="availability_date" value=""  id="availability_date" placeholder="From Date" class="input-xlarge required-entry validate-email validate_me span12" required="">

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid email address.</span>

				<span style="display: none;" id="error_email" class="empty error-empty error_tag">*This field is required.</span> </label>

				<i class="icon-mail-2"></i>

			</div>
			<div class="grid_4">

				 <label class="control-label" for="email">Vehcle Type:</label>

				 <select id="trucktype" name="vehicle_type_id" class="input-xlarge required-entry validate-email validate_me span12" required="" placeholder="Select Truck Type">
										<span class="wpcf7-form-control-wrap name">
					<?php $mainframe->selectbox('vehicle_type',$this->VehcleType,select); ?>
					</span>
				</select>

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid email address.</span>

				<span style="display: none;" id="error_email" class="empty error-empty error_tag">*This field is required.</span> </label>

				<i class="icon-mail-2"></i>

			</div>
			<div class="grid_4">

				 <label class="control-label" for="email">Name:</label>

				 <input type="text" name="name" value=""  id="name" placeholder="Enter Name" class="input-xlarge required-entry validate-email validate_me span12" required="">

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid email address.</span>

				<span style="display: none;" id="error_email" class="empty error-empty error_tag">*This field is required.</span> </label>

				<i class="icon-mail-2"></i>

			</div>

			<div class="grid_4">

				<label class="control-label quote-phone-no" for="phone">Phone No*:</label>
				<div class="clear"></div>
				<input type="text" maxlength="3" value="+91" class="validate_me span2" id="pop_phone_code-16543" name="phonecode">
				<input type="tel" name="phone" class="required-entry validate-custommobile validate_me span10 field-call" id="phone" title="Telephone" value="" maxlength="10" placeholder="Enter Phone No">
				<span style="display: none;" class="error error-empty error_tag">*This is not a valid phone number.</span>
				<span style="display: none;" id="error_phone" class="empty error-empty error_tag">*This field is required.</span> </label>
				<i class="icon-phone-2"></i>
			</div>	
		 </div>   
							<input type="hidden" name="view" value="contact" />
							<input type="hidden" name="task" value="createticket" />
							<input type="hidden" name="form" value="AddTruck" />
							<input type="hidden" name="category" value="15" />
							<script type="text/javascript">
							  jQuery(document).ready(function(){
							    getfreequote.addKey('AddTruck');
                                })
							</script>
							<div class="clear"></div>
							<label class="message">
							<p><center>I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of Letsport.</center></p>
							</label>			

		<div class="clear"></div>
		<p>
		<div class="btn-get-free-quote-holder"><input class="btn btn-success btn-block btn-get-free-quote" type="button" value="Submit" onclick="getfreequote.ValidateAddTruck('AddTruck');" /></div></p>
        </div>
</form> 