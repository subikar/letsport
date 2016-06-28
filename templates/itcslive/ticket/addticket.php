<?php
defined ('ITCS') or die ("Go away.");
global $my;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7">
	 <form action="" method="post" enctype="multipart/form-data" onsubmit="return Ticket.validateEnquery(this);">
		<div style="display: none;">
		   <input type="hidden" name="view" value="myticket" />
		   <input type="hidden" name="task" value="saveticket" />
		   
		</div>
		<div class="order_nowform">
		<div class="each_block_fullwidth">
		<h4>Enter Messege :</h4>
			  <span class="saysomethng">
			  <textarea name="message"class="tinyEditor" id="editor" placeholder="Enter your messege...."></textarea>
			  </span>
			  </div>
			  <div class="each_block">
			  <span class="error_tag" id="error_message" ></span>
			 <br clear="all" />
			 <ul class="add_ticket_form">
		   		  <li><strong>Select a category to help us route your request:</strong></li>
				  <li><select name="category" id="text_category" required="true" class="add_ticket_drop" />
					 <?php foreach($this->Category as $Cat):?>
					 <option value="<?php echo $Cat->id; ?>"><?php echo $Cat->category_name; ?></option>
					 <?php endforeach; ?>
				  </select>
				  <span class="error_tag" id="error_category" ></span>
				  </li>
			  </ul>
			</div>
			<div class="clear"></div>
			<?php if(in_array(strtolower($my->usertype),array("telecaller","admin"))): ?>
			<div class="each_block">
			<ul class="add_ticket_form">
				<li><strong>Select Contact:</strong></li>
		 		<li><input name="contact" placeholder="type customer name.." id="text_user_ticket" required="true" class="add_ticket_drop" /></li>
			</div>
			<?php else: ?>
			<div class="each_block">
				<ul class="add_ticket_form">
					<li><strong>Contact Name:</strong></li>
					<li><?php echo $my->name; ?><input type="hidden" name="contact" class="add_ticket_drop" value="<?php echo $my->uid ;?>" /></li>
			 	</ul>
			 </div> 
			 <?php endif; ?>
			 <div class="clear"></div>
			 <?php if(strtolower($my->usertype)=="admin"): ?>
			 <div class="each_block">
				 <ul class="add_ticket_form">
					 <li><strong>Select Telecaller: </strong></li>
					 <li><input name="caller_id" placeholder="type telecaller name.." class="add_ticket_drop" id="telecaller_for_admin" required="true" /></li>
				 </ul>
			</div>
			 <?php else: ?>
			 <input type="hidden" name="caller_id" value="<?php echo $my->uid; ?>" class="add_ticket_drop" />
			 <?php endif; ?>
			 
			<div class="clear"></div>
		   <!--<div class="each_block_fullwidth">
			  <h4>How would Customer like us to respond?</h4>
			  <span class="wpcf7-form-control wpcf7-radio" id="respondtype">
			  <span class="wpcf7-list-item first">
			<input type="radio" name="respondtype" id="phone" class="css-checkbox" value="Phone" checked="checked" />
			<label for="phone" class="css-label radGroup2">Phone</label>
				 </span>
				 <span class="wpcf7-list-item last">
				 <input type="radio" name="respondtype" id="email" class="css-checkbox" />
				 <label for="email" class="css-label radGroup2">Email</label>
				 </span></span>
		   </div>-->
			   <div class="login_btns" style="text-align:center;">
				  <input value="Add Ticket" id="submitcontact" type="submit" class="add_ticket_btn">
			   </div>
			</div>
		 </form>
		  </div>
	  </div>
   </div> 
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
var screenwidth = $(document).width();
		 <!--alert(screenwidth);-->
		if(screenwidth <= 320) {parent.jQuery.colorbox.resize({iframe:true, width:"100%", height:"700px"});}
		else if(screenwidth <= 480) {parent.jQuery.colorbox.resize({iframe:true, width:"90%", height:"700px"});} 
		else if(screenwidth <= 600) {parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"600px"});} 
		else if(screenwidth <= 768) {parent.jQuery.colorbox.resize({iframe:true, width:"90%", height:"600px"});} 
		else if(screenwidth <= 996) {parent.jQuery.colorbox.resize({iframe:true, width:"78%", height:"600px"});} 
		else  {parent.jQuery.colorbox.resize({iframe:true, width:"60%", height:"600px"});} 
});
</script>
<style>
.each_block{ padding:6px;}
</style>
