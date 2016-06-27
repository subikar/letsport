<form action="" method="post" class="form-horizontal getofferForm" name="GetFreeQuote" id="GetFreeQuote" target="_parent">
<div class="container popupform">

			<div class="grid_4">

				<label class="control-label" for="name">Name *:</label>

				<input name="name" id="name" title="Name" value="" class="required-entry validate_me span12" type="text" placeholder="Enter Name">

				<span style="display: none;" class="error error-empty error_tag">*This is not a valid name.</span>

				<span style="display: none;" id="error_name" class="empty error-empty error_tag">*This field is required.</span> </label>

                <i class="icon-user-2"></i>

			</div>

			<div class="grid_4">

				 <label class="control-label" for="email">Email*:</label>

				 <input name="email" id="email" title="Email" value="" class="input-xlarge required-entry validate-email validate_me span12" type="email" placeholder="Enter Email">

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

			<div class="grid_12 pro-description-frame">
				<label class="labelprjectdescription control-label" for="projectdescription">Requirement & Time Frame:</label>
				<div class="clear"></div>
					<textarea name="message" placeholder="Enter your messege(within 2000 letters)...." required="true"  onkeyup="getfreequote.CheckLength(this,'textcounter');"></textarea>
         				<input size=1 value=2000 name="text_num" class="textcounter" readonly="true">
          			<span style="display: none;" id="error_message" class="empty error_tag">*This field is required.</span>
			</div>		 		
		 </div>   
							<input type="hidden" name="view" value="contact" />
							<input type="hidden" name="task" value="createticket" />
							<input type="hidden" name="form" value="GetFreeQuote" />
							<input type="hidden" name="category" value="15" />
							<script type="text/javascript">
							  jQuery(document).ready(function(){
							    getfreequote.addKey('GetFreeQuote');
                                })
							</script>
							<div class="clear"></div>
							<label class="message">
							<p><center>I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of iTCSLive.</center></p>
							</label>			

		<div class="clear"></div>
		<p>
		<div class="btn-get-free-quote-holder"><input class="btn btn-success btn-block btn-get-free-quote" type="button" value="Submit" onclick="getfreequote.validateEnquery('GetFreeQuote');" /></div></p>
        </div>
</form> 