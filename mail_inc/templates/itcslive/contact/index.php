<?php 
  defined ('ITCS') or die ("Go away.");
  global $Config;
  ?>
<div class="wrapper">
        <div class="grid_4">
            <h5 class="bot">A. Can we help you in anyway?</h5>
            <div class="success_wrapper">
            <div style="display: none;" class="success">Contact form submitted!<br>
            <strong>We will be in touch soon.</strong> </div></div>
            <fieldset>
			<form id="contactForm" name="contactForm" method="post" class="form" enctype="multipart/form-data">
            <label class="message">
            <textarea  name="message" placeholder="Enter your messege...." required="true"></textarea>
            <br class="clear">
            <span style="display: none;" class="error">*The message is too short.</span>
			<span style="display: none;" id="error_message" class="empty">*This field is required.</span> </label>
            <label class="message">
			<br />
			<span>Pick any category so that we can process your request</span>
			<br clear="all" />
            <select name="category" required="true">
			  <?php foreach($this->Category as $Cat):?>
				 <option value="<?php echo $Cat->id; ?>"><?php echo $Cat->category_name; ?></option>
				 <?php endforeach; ?>
			</select>            
			<br class="clear">
            </label>
            <div class="clear"></div>
			<br />
            <h5 class="bot">B. Please furnished the following details.</h5>
			<label class="name">
            <input type="text" name="name"  placeholder="Enter Name" required="true"/>
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid name.</span>
			<span style="display: none;" id="error_name" class="empty error-empty">*This field is required.</span> </label>
            <label class="email">
            <input type="text" name="email"  placeholder="Enter Email" required="true" />
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid email address.</span>
			<span style="display: none;" id="error_email" class="empty error-empty">*This field is required.</span> </label>
            <label class="phone">
            <input type="text" name="phone" id="phone"  placeholder="Enter Phone" required="true">
			<span style="display: none;" class="error error-empty error_tag">*This is not a valid phone number.</span>
			<span style="display: none;" id="error_phone" class="empty error-empty error_tag">*This field is required.</span> </label>
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid phone number.</span>
			<span style="display: none;" id="error_phonenunber" class="empty error-empty">*This field is required.</span> </label>
            <label class="organisation">
            <input type="text" name="organization"  placeholder="Enter Company" required="true">
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid Company.</span>
			<span style="display: none;" id="error_company" class="empty error-empty">*This field is required.</span>
			</label>
            <label class="country">
            <input type="text" name="country"  placeholder="Enter Country" required="true" >
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid country.</span>
			<span style="display: none;" id="error_country" class="empty error-empty">*This field is required.</span>
			</label>
            <div class="clear"></div>
			<br />
            <h5 class="bot">C. Please convey the necessary details.</h5>
            <label class="respondtype">
			<ul>
            <li><input name="respondtype" value="Phone" checked="checked" type="radio"></li><li>&nbsp;Phone</li>
			<li>&nbsp;</li>
            <li><input name="respondtype" value="Email" type="radio"></li><li>&nbsp;Email</li>
			</ul>
			<br clear="all" />
            <label class="message">
            I understand and agree to the rules and restrictions and the <a href="/term-and-condition" target="_blank">Terms & Conditions</a> of iTCSLive.
		    </label>			
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid country.</span>
			<span style="display: none;" class="empty error-empty">*This field is required.</span> </label>
			<input type="hidden" name="view" value="contact" />
		    <input type="hidden" name="task" value="createticket" />
			<input type="hidden" name="form" value="contactForm" />
			<script type="text/javascript">
			  jQuery(document).ready(function(){
				FreeQuote.addKey('contactForm');
				})
			</script>
			
			</form>			
            <div class="clear"></div>
            <div class="btns"><a class="button-1" data-type="reset" href="#"><span></span>Clear</a>
			<div class="none"></div><a onclick="FreeQuote.validateEnquery('contactForm');" class="button-1" href="javascript:void(0);"><span></span>Send</a>
            <div class="clear"></div>
            </div></fieldset>
        </div>
<div class="grid_8">
            <h3 class="bot-1">Contact Information</h3>
            <div class="bot">
				<iframe  id="map_canvas" 
					src="https://maps.google.com/maps?f=q&amp;
					source=s_q&amp;
					hl=en&amp;
					geocode=&amp;
					q=iTCSLIVE, Dum Dum kolkata 700074 India West Bengal&amp;
					aq=1&amp;
					oq=333&amp;
					sll=22.614167,88.418479&amp;
					sspn=22.614167,88.418479&amp;
					ie=UTF8&amp;
					hq=&amp;
					hnear=Dum Dum Private Road&amp;
					t=m&amp;
					z=14&amp;
					ll=22.614167,88.418479&amp;
					z=10&amp;
					output=embed">
			</iframe>
            </div>
            <span class="dis-block bot">Any Query! Please Call Us at: 033-68888449 to Talk with one of our Technical Executive.</span>
            <dl class="adress">
	            <!--<dt class="title1">8901 Marmora Road, Glasgow, D04 89GR.</dt>-->
                <dd><span>Freephone:</span><a href="tel:033-68888449">033-68888449</a></dd>
                <dd><span>Telephone:</span><a href="tel:+919051158812">+919051158812</a></dd>
                <dd><span>Telephone:</span><a href="tel:+919836892283">+919836892283</a></dd>
                <dd><strong>E-mail:</strong> <a href="mailto:pradip3@itcslive.com">pradip3@itcslive.com</a></dd>
                <dd><strong>E-mail:</strong> <a href="mainto:subikar.web@gmail.com">subikar.web@gmail.com</a></dd>
                <dd><strong>E-mail:</strong> <a href="mailto:support@itcslive.com">support@itcslive.com</a></dd>
                <dd><strong>skype:</strong> <a href="#">itcslive</a></dd>
            </dl>
            
        </div>		
        
    </div>