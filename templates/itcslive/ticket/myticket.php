<?php
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$post=IRequest::get("POST");
	$restrictUser=array("employee","customer");
	$rowClass=(!in_array($my->usertype,$restrictUser)) ? "row2" : "row10";
?>
		<h3 class="bot-1">My Tickets</h3>
		<div class="row10">
	       <div class="box_area">
			<form name="tSearchForm" action="" method="post" id="form">
               <label class="name">
                  <input placeholder="Search By Text.." name="text_content" id="text_content" value="<?php echo $post["text_content"] ?>" type="text">
               </label>
			   <?php if(strtolower($my->usertype) == "telecaller" || strtolower($my->usertype) == "admin"): ?>
               <label class="name">
				<input type="text" name="text_user" id="text_user" placeholder="Search By User.." value="<?php echo $post['text_user']; ?>" />		
               </label>
			   <?php endif; ?>
               <label class="name">
                  <input placeholder="Search By Date.." name="text_date" id="text_date" type="text" value="<?php echo $post["text_date"] ?>">
               </label>
               <label class="name">
                  <input placeholder="Search By Email.." name="text_email" id="text_email" type="text" value="<?php echo $post["text_email"] ?>">
               </label>
               <label class="name">
                  <input placeholder="Search By Phone.." name="text_mobile" id="text_mobile" type="text" value="<?php echo $post["text_mobile"] ?>">
               </label>
               <input value="Search" id="search_adbuttn" type="submit" class="button-1">
               <div class="clear"></div>
			</form>   
            </div>
            <div class="line"></div>
			<br clear="all" />
         <div class="padDiv <?php echo $rowClass; ?>">
            <div class="boiteHeader">
               <ol>
                  <li>
                     <?php if(strtolower($my->usertype) == "telecaller" || strtolower($my->usertype) == "customer" || strtolower($my->usertype) == "admin"): ?>
                     <a href='<?php echo $Config->site."addticket" ?>' class="addticket" title="Add Ticket"><span class="fa add"></span>Add</a>
					 <a href='<?php echo $Config->site."myappointment" ?>' title="Appointment"><span class="fa add"></span>Appointments</a>
                     <?php endif; ?>
                  </li>
               </ol>
               <h5><span class="fa fa-tasks"></span><a href="#" class="titleLink">Tickets</a> &nbsp;&nbsp;(<?php echo $this->countoftickets; ?>)</h5>
            </div>
            <div class="line"></div>
            <div class="boiteContent">
               <?php if(count($this->Tickets) > 0): ?>
			   
  			<table cellpadding="3" cellspacing="3" id="myticket">
				<thead>
					<th>Created On</th>
					<th>Ticket</th>
					<th>Created By</th>
					<th></th>
				</thead>
				<tbody>
			   
               <?php foreach($this->Tickets as $Thread): ?>
               <tr>
				  <td><?php echo $Thread->subject; ?><br /><small><?php echo date("M d h:i A",strtotime($Thread->created_on)); ?><?php echo (int)$Thread->activity_status==0 ? "(<span style='color:#ee6647;'>Closed</span>)" : ""; ?></small></td>
          		  <td> <a href="<?php echo $Config->site."ticket/".$Thread->id; ?>"><?php echo substr(strip_tags($Thread->ticket_content), 0, 40)."...." ?></a></td>
				  <td><?php echo $Thread->name;  echo ($Thread->Company!="")? "<br><small>(".$Thread->Company.")</small>": ""; ?></td>
               	 <?php if(strtolower($my->usertype) == "telecaller" || strtolower($my->usertype) == "admin"): ?> 
				  <td><a class="modify_ticket" title="View Ticket" href="<?php echo $Config->site."modifyticket?ticket_id=".$Thread->id; ?>" >View</a></td>
				  <?php endif; ?> 
			   </tr>
               <?php endforeach; ?>
			   </tbody>
			   </table>
               <?php else: ?>
               <p>Sorry!! You Have No Tickets.</p>
               <?php endif; ?>
            </div>
         </div>
		 <?php if(!in_array($my->usertype,$restrictUser)): ?>
		 <div class="padDiv row1">
		 <div class="boiteHeader"><h5><span class="fa fa-tasks"></span>Today's Alert(<?php echo count($this->Alerts); ?>)</h5>
		 </div>
		 <?php if(isset($this->Alerts) && count($this->Alerts) > 0): ?>
		 <?php foreach($this->Alerts as $alert): ?>
		  <div class="defaultBoxLine">
              <div style="width:40%;"><?php echo $alert->show_date; ?></div>
              <div style="width:40%;"><a href="<?php echo $Config->site."ticket/".$alert->id; ?>"><?php echo $alert->name; ?><?php echo ($alert->Company!="") ? "(".$alert->Company.")" : ""; ?></a></div>
			  <div style="width:15%;"><a class="modify_ticket" title="View Ticket" href="<?php echo $Config->site."modifyticket?ticket_id=".$alert->id; ?>" >View</a></div>
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
 <script>
			$(document).ready(function(){
                   $(".addticket").colorbox({iframe:true, width:"80%", height:"90%"});
				    $(".modify_ticket").colorbox({iframe:true, width:"65%", height:"80%"});			
			});
</script>