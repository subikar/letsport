<?php 
  defined ('ITCS') or die ("Go away.");
  global $Config;
  ?>
<div class="wrapper">
        <div class="container" >
        	<div class="col-md-12" >  &nbsp;    </div>
       
  <div class="col-md-7" >      	
 <form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="Name" class="form-control" id="" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="Email" class="form-control" id="" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
      <input type="Phone" class="form-control" id="" placeholder="Phone">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-10">
      <textarea  name="message" placeholder="Address...." required="true" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Messege</label>
    <div class="col-sm-10">
      <textarea  name="message" placeholder="Enter your messege...." required="true" class="form-control"></textarea>
    </div>
  </div>
  
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
			
				
            <div class="clear"></div>
            <div class="btns"><a class="button-1" data-type="reset" href="#"><span></span>Clear</a>
			<div class="none"></div><a onclick="FreeQuote.validateEnquery('contactForm');" class="button-1" href="javascript:void(0);"><span></span>Send</a>
  <p>&nbsp;</p>
  
  
</form>
</div>
</div>
       
<div class="col-md-5">
           
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
          
            <dl class="adress">
	            <!--<dt class="title1">8901 Marmora Road, Glasgow, D04 89GR.</dt>
                <dd><span>Freephone:</span><a href="tel:033-910000000">033-0000</a></dd>
                <dd><span>Telephone:</span><a href="tel:+910000000">+910000000</a></dd>
                <dd><strong>E-mail:</strong> <a href="mailto:letsport@letsport.com">letsport@letsport.com</a></dd>
                <dd><strong>E-mail:</strong> <a href="mainto:letsport.letsport@letsport.com">letsport.letsport@letsport.com</a></dd>
                <dd><strong>skype:</strong> <a href="#">letsport</a></dd>
            </dl>
            -->
        </div>		
        </div>
    </div>