<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$post=IRequest::get("POST");
	$restrictUser=array("employee","customer");
	$rowClass=(!in_array($my->usertype,$restrictUser)) ? "row2" : "row10";
?>

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
	  <div class="box_area">
			<form name="tSearchForm" action="" method="post">
               <div class="each_box_area">
                  <input placeholder="Search By Text.." name="text_content" id="text_content" value="<?php echo $post["text_content"] ?>" size="25" type="text">
               </div>
			   <?php if($my->usertype=="telecaller"): ?>
               <div class="each_box_area">
               <select name="text_user" id="text_user">
			   <option value="">Select Customer</option>
			   	<?php foreach($this->RefUsers as $user):  $userSelect=((int)$user->uid==(int)$post["text_user"]) ? "selected='selected'" : '';?>
				  <option value="<?php echo $user->uid; ?>" <?php echo $userSelect; ?>><?php echo $user->name; ?></option>
				 <?php endforeach; ?>
				</select>		
               </div>
			   <?php endif; ?>
               <div class="each_box_area">
                  <input placeholder="Search By Date.." name="text_date" id="text_date" type="text" value="<?php echo $post["text_date"] ?>">
               </div>
			   <div class="login_btns">
               <input value="Search" class="login" id="search_adbuttn" type="submit">
			   </div>
               <div class="clear"></div>
			</form>   
            </div>
            <div class="line"></div>
         <div class="padDiv <?php echo $rowClass; ?>">
            <div class="boiteHeader">
               <ol>
                  <li>
                     <?php if($my->usertype=="telecaller" || $my->usertype=="customer"): ?>
                     <a href='<?php echo $Config->site."addticket" ?>' class="addticket" title="Add Ticket"><span class="fa add"></span>Add Ticket</a>
                     <?php endif; ?>
                  </li>
               </ol>
               <h5><span class="fa fa-tasks"></span><a href="#" class="titleLink">Tickets</a></h5>
            </div>
            <div class="line"></div>
            <div class="boiteContent">
               <?php if(count($this->Tickets) > 0): ?>
               <?php foreach($this->Tickets as $Thread): ?>
               <div class="defaultBoxLine">
                  <div><?php echo date("j F Y h:i A",strtotime($Thread->created_on)); ?></div>
                  <div> <a href="<?php echo $Config->site."ticket/".$Thread->id; ?>"><?php echo substr(strip_tags($Thread->ticket_content), 0, 30)."...." ?></a></div>
               	 <?php if($my->usertype=="telecaller"): ?> 
				  <div style="text-align:right;"><a onclick='jQuery.colorbox({href: "<?php echo $Config->site."modifyticket?ticket_id=".$Thread->id; ?>", iframe:true, width:"720px", height:"500px", scrolling:false, open:true, overlayClose:true,title:"View Ticket"});' href="javascript:void(0);">View</a></div>
				  <?php endif; ?>
			   </div>
               <div class="clear"></div>
               <?php endforeach; ?>
               <?php else: ?>
               <p>Sorry!! You Have No Tickets.</p>
               <?php endif; ?>
            </div>
         </div>
		 <?php if(!in_array($my->usertype,$restrictUser)): ?>
		 <div class="padDiv row1">
		 <span class="fa fa-tasks"></span>Today Alert
		 <div class="line"></div>
		 <?php if(isset($this->Alerts) && count($this->Alerts) > 0): ?>
		 <?php foreach($this->Alerts as $alert): ?>
		  <div class="defaultBoxLine">
                  <div><?php echo $alert->alert_date; ?></div>
                  <div><?php echo $alert->name; ?></div>
				 <div><a href="<?php echo $Config->site."ticket/".$alert->id; ?>"><?php echo $alert->Company; ?></a></div> 
               </div>
               <div class="clear"></div>
		 <?php endforeach; ?>   
		  <?php else: ?>
           <p>Sorry!! You Have No Alerts.</p>
           <?php endif; ?>
		 </div>
		 <?php endif; ?>
         <div class="clear"></div>
      </div>
   </div>
</div>
<script>
			$(document).ready(function(){
                   $(".addticket").colorbox({iframe:true, width:"80%", height:"90%"});		
			});
</script>