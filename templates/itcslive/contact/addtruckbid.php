<?php 
$id = IRequest::getVar('id');
global $my,$mainframe;
//print_r($id);
?>
<form action="" method="post" class="form-horizontal getofferForm" name="AddTruckBid" id="AddTruckBid" target="_parent">
<div class="container popupform">



			<div class="grid_4">

				<label class="control-label" for="material_type">Material Type:</label>
				<span class="wpcf7-form-control-wrap name">
					<?php $mainframe->selectbox('material_type',$this->MaterialType,''); ?>
					</span><span class="error_tag" id="error_name" ></span>
                <i class="icon-user-2"></i>

			</div>


			<div class="grid_4">

				 <label class="control-label" for="amount">Amount :</label>

				 <input name="amount" id="to_location" title="amount" value="" class="input-xlarge required-entry validate-email validate_me span12" type="email" placeholder="Amount">

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid email address.</span>

				<span style="display: none;" id="error_email" class="empty error-empty error_tag">*This field is required.</span> </label>

				<i class="icon-mail-2"></i>

			</div>
			
 
		 </div>   
							<input type="hidden" name="view" value="contact" />
							<input type="hidden" name="task" value="addtruckbid" />
							<input type="hidden" name="form" value="AddTruckBid" />
							
							<script type="text/javascript">
							  jQuery(document).ready(function(){
							    getfreequote.addKey('AddTruckBid');
                                })
							</script>
							<div class="clear"></div>
							<label class="message">
							<p><center>I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of Letsport.</center></p>
							</label>			

		<div class="clear"></div>
		<p>
		<div class="btn-get-free-quote-holder"><input class="btn btn-success btn-block btn-get-free-quote" type="button" value="Submit" onclick="getfreequote.ValidateAddTruckBid('AddTruckBid');" /></div></p>
        </div>
</form> 