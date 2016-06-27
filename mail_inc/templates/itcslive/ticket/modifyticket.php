<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config;
$Threads=$this->TicketDetails; //print_r($Threads["thread"]);exit;
?>
<style>
</style>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body rowticket">
	  <div>
	  <h3><?php echo $Threads["main"]->owner_name; ?></h3>
	  <?php if($Threads["main"]->owner_name!=""): ?>
	  <p>Company:<?php echo $Threads["main"]->Company; ?></p>
	  <?php endif; ?>
	   <?php if($Threads["main"]->address!=""): ?>
	  <p>Address:<?php echo $Threads["main"]->address; ?></p>
	  <?php endif; ?>
	  </div>
	  <div class="left_side clearfix">
	  
	    <h3><?php echo $Threads["main"]->subject; ?></h3>  
         <div class="padDiv left_part">
                      
            <div class="boiteHeader">
               <div class="title">Reply number :</div><div id="req_no" class="info"><?php echo $Threads["Request_no"]; ?></div>
            </div>
				<a class="close_ticket" onclick="Ticket.closeTicket(<?php echo $Threads["main"]->id; ?>);">Close Ticket</a>
			<br clear="all" />
			 <div class="line"></div>
			 
		   <div id="error_com" style=" color:#CC0066; display:none;"></div>
		   <form name="addCommentForm" action="" id="addCommentForm" method="post" onsubmit="return Ticket.validateModifyTicket(this.id);">
			 <div class="view_ticket">
			 <ul>
				<li><label>Set Alert Date</label></li>
				<li><input placeholder="Set alert date.." type="text" name="alert_date" id="text_date" /></li>
				<li><label>Set Visit Date</label></li>
				<li><input placeholder="Visit Date" type="text" name="visit_datetime" id="text_datetime"/></li>
				<li><label>Select Field Executive:</label></li>
				<li><input name="field_executive" id="field_executive" type="text" /></li>
				<li><label>Write Your Comment</label></li>
				<li><textarea name="comment" required="true" placeholder="Write Comment.." cols="35" rows="4"></textarea></li>
				<li>&nbsp;</li>
				<li>
					  <input type="submit" value="Reply" />
					  <input type="hidden" name="view" value="myticket" />
					  <input type="hidden" name="task" value="saveComment" />
					  <input type="hidden" name="ticket_id" value="<?php echo $Threads["main"]->id; ?>" />
					  <input type="hidden" id="user_id" name="user_id" value="<?php echo (int)$my->uid; ?>" />
					  </li>
			 </ul>
			 </div>
			</form>	 
			</div>
		 </div>
        
		 <div class="right_side clearfix">
		   <h3>Comments</h3> 
         <div class="padDiv right_part">
            <div class="description" id="threadContent">
               <?php foreach($Threads["thread"] as $Thread): ?>
               <div class="defaultBoxLine1"> 
			   <div class="header">
			   <div class="user"><?php echo $Thread->owner_name; ?></div>
			   <div class="date_time small"><?php echo date("j F Y h:i A",strtotime($Thread->created_on)); ?></div>
			    <div class="clear"></div>
			   </div>
			   <!--<br clear="all" />-->
                  <div class="site_description"><?php echo $Thread->ticket_content; ?></div>
				  </div>
               <div class="line"></div>
               <?php endforeach; ?>
			    <div class="defaultBoxLine2">
				<div class="header">
				<div class="user"><?php echo $Threads["main"]->owner_name; ?> </div>
				 <div class="date_time small"><?php echo date("j F Y h:i A",strtotime($Threads["main"]->created_on)); ?></div>
				 <div class="clear"></div>
				 </div>
				<!-- <br clear="all" />-->
                  <div class="site_description"><?php echo $Threads["main"]->ticket_content; ?></div>
                 </div>
            </div>
         </div>
		 </div>
      </div>
   </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
var screenwidth = $(document).width(); 
		 <!--alert(screenwidth);-->
		if(screenwidth <= 320) {parent.jQuery.colorbox.resize({iframe:true, width:"100%", height:"900px"});}
		else if(screenwidth <= 480) {parent.jQuery.colorbox.resize({iframe:true, width:"90%", height:"900px"});} 
		else if(screenwidth <= 600) {parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"580px"});} 
		else if(screenwidth <= 768) {parent.jQuery.colorbox.resize({iframe:true, width:"90%", height:"580px"});} 
		else if(screenwidth <= 996) {parent.jQuery.colorbox.resize({iframe:true, width:"78%", height:"580px"});} 
		else  {parent.jQuery.colorbox.resize({iframe:true, width:"78%", height:"580px"});} 
});
</script>