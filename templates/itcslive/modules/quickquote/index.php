<div class="clear"></div>
<form action="" method="post" class="form-horizontal getofferForm" name="DiscountFreeQuote" id="DiscountFreeQuote" >
 <div id="contact_form" class="popupform">
	<div class="container">
		<div class="container_12">
			<div class="grid_4">
				<label class="control-label" for="name">Name *:</label>
				<input name="name" id="name" title="Name" value="" class="required-entry validate_me span12 inputname" type="text" autocomplete="on" placeholder="Enter Name">
              <span style="display: none;" class="error error-empty">*This is not a valid name.</span>
			  <span style="display: none;" id="error_name" class="empty error-empty">*This field is required.</span>
			  <i class="icon-user-2"></i>
			</div>
			<div class="grid_4">
				 <label class="control-label" for="email">Email*:</label>
				 <input name="email" id="email" title="Email" value="" class="input-xlarge required-entry validate-email validate_me span12 inputname" type="email" autocomplete="on"placeholder="Enter Email" >
				 <span style="display: none;" class="error error-empty">*This is not a valid email address.</span> <span style="display: none;" id="error_email" class="empty error-empty">*This field is required.</span>
				 <i class="icon-mail-2"></i>
			</div>
			<div class="grid_4">
				<label class="control-label quote-phone-no" for="phone">Phone No*:</label>
				
				<input type="text" maxlength="3" value="+91" class="validate_me span2" id="pop_phone_code-16543" name="phonecode" autocomplete="on">
			    <input type="tel" name="phone" class="required-entry validate-custommobile validate_me span10 inputph" id="phone" title="Telephone" value="" maxlength="10" autocomplete="off"  placeholder="Enter Phone No">
              <span style="display: none;" class="error error-empty">*This is not a valid phone number.</span> 
			  <span style="display: none;" id="error_phone" class="empty error-empty">*This field is required.</span>
			  <i class="icon-phone-2"></i>
			  
			</div>	

			<div class="grid_12 topsp1 pro-description-frame">
				<label class="labelprjectdescription control-label" for="projectdescription">Project Description & Time Frame:</label>
				
				<div class="project-description-fi">
					<textarea name="message" placeholder="Enter your messege(within 2000 letters)...." required="true"  onkeyup="FreeQuote.CheckLength(this,'textcounter');"></textarea>
         				<input size=1 value=2000 name="text_num" class="textcounter">
          			<span style="display: none;" id="error_message" class="empty">*This field is required.</span>
				</div>
			</div>
			<div class="grid_12">
							<input type="hidden" name="view" value="contact" />
							<input type="hidden" name="task" value="createticket" />
							<input type="hidden" name="form" value="DiscountFreeQuote" />
							<input type="hidden" name="category" value="15" />
							<script type="text/javascript">
							  jQuery(document).ready(function(){
							    FreeQuote.addKey('DiscountFreeQuote');
                                })
							</script>
							<label class="message">
							<center>I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of iTCSLive.</center>
							</label>			
						  <center><input class="btn btn-success btn-block btn-get-free-quote" type="button" value="Submit" onclick="FreeQuote.validateEnquery('DiscountFreeQuote');" /></center>
									  
							 		
			</div>
	</div>
</div>
</div>
</form>
