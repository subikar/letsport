<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="wpcf7">
		<div class="our_work">
				<div class="heder_left">
					<img src="<?php echo $this->workDetails->gallery; ?>" />
				</div>
					<div class="descrip_slide">
					<div class="description">
					<?php echo $this->workDetails->project_description; ?>			
				  </div>
				  </div>
		 </div>
		 </div>
      </div>
   </div>
   
</div>
<div class="contact-us"><a class="get-free-quote free-quote" title="Get A Free Quote" href="https://www.itcslive.in/get-free-quote">
Any Question ? Call 033-68888449(10 AM - 7PM IST) OR : +91 9836892283 (24 Hours Online ) skype: itcslive or Get A Free Quote</a>
</div>

<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"600px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"600px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"600px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"600px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"600px"});
		}
});
</script>