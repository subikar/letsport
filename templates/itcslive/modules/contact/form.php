<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>
<div>
       <h3 class="bot-1 ptm">Quick Quote</h3>
            <div class="success_wrapper">
            <div style="display: none;" class="success">Contact form submitted!<br>
            <strong>We will be in touch soon.</strong> </div></div>
            <fieldset> 
			<form action="" method="post"  name="TicketContactForm" id="TicketContactForm" class="form" >
		    <input type="hidden" name="view" value="contact" />
			<input type="hidden" name="task" value="createticket" />
			<input type="hidden" name="category" value="15" />
			<input type="hidden" name="form" value="TicketContactForm" />
			<script type="text/javascript">
			  jQuery(document).ready(function(){
				FreeQuote.addKey('TicketContactForm');
				})
			</script>			
            <label class="name">
            <input type="text" name="name"  placeholder="Enter Name" />
            <br class="clear">
            <span class="error_tag" id="error_name" ></span>
			</label>
			
            <label class="email">
             <input type="text" name="email"  placeholder="Enter Email" />
            <br class="clear">
            <span class="error_tag" id="error_email" ></span></label>
			
            <label class="phone">
            <input type="text" name="phone"  placeholder="Enter Phone" />
            <br class="clear">
            <span style="display: none;" id="error_phonenunber" class="error error-empty">*This is not a valid phone number.</span></label>
            <label class="message">
            <textarea name="message" placeholder="Enter Message"></textarea>
            <br class="clear">
			   <span class="error_tag" id="error_message" ></span></label>
            <div class="clear"></div>
            <label class="message">
            I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of iTCSLive.
		    </label>			
			<div class="btns">
			<a class="button-1" data-type="reset" onclick="document.getElementById('TicketContactForm').reset();" href="javascript:void(0);"><span></span>Clear</a>
			<div class="none"></div>
			<a onclick="FreeQuote.validateEnquery('TicketContactForm');" class="button-1" data-type="submit" href="javascript:void(0);"><span></span>Send</a>
            <div class="clear"></div>
            </div>
			</form>
			</fieldset>
</div>