<?php
defined ('ITCS') or die ("Go away.");
global $Config,$my;
?>
<div class="padDiv row1">
  <div class="boiteHeader">
    <ol>
      <!--<li><a href=""><span class="fa fa-fw fa-user"></span></a><a href="">Details</a></li>-->
      <li><a  href="<?php echo $Config->site."edituser" ?>" class="modifydetails" title="Update Details"><span class="fa fa-fw fa-user"></span>Modify</a></li>
    </ol>
    <h5><span class="fa fa-fw fa-user-1"></span><a href="#" class="titleLink"><?php echo ucwords(strtolower($my->usertype)); ?> #<?php echo $my->uid; ?></a></h5>
	<div class="clear"></div>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
  	<div class="details">
  	<?php if($my->Company!=''): ?>
    <div class="defaultBoxLine"><?php echo $my->Company; ?></div>
	<?php endif; ?>
    <div class="defaultBoxLine"><?php echo $my->name; ?></div>
	<div class="defaultBoxLine"><?php echo $my->email; ?></div>
	<?php if($my->address!=''): ?>
    <div class="defaultBoxLine"><?php echo $my->address; ?></div>
    <?php endif; ?>
	<?php if($my->city!=''): ?>
	<div class="defaultBoxLine"><?php echo $my->city; ?></div>
	<?php endif; ?>
	<?php if($my->country!=''): ?>
    <div class="defaultBoxLine"><?php echo $my->country; ?></div>
	<?php endif; ?>
	<?php if($my->postal!=''): ?>
    <div class="defaultBoxLine"><?php echo $my->postal; ?></div>
	<?php endif; ?>
	<?php if($my->phone!=''): ?>
    <div class="defaultBoxLine"><?php echo $my->phone; ?></div>
	<?php endif; ?>
	 </div>
	<?php if($my->avatar!=''): ?>
    <div class="defaultBoxLine">
	<div class="image_avatar"><img src="<?php echo $Config->site.$my->thumb; ?>" style="height:100px; width:100px;" align="right"  /></div></div>
	<?php endif; ?>
 
  </div>
  <div class="boiteContent">
  <a  href="<?php echo $Config->site."changepassword" ?>" class="change_password" title="Change Password"><span class="fa fa-fw fa-user"></span>Change Password</a>
  </div>
  
  <?php if(in_array(strtolower($my->usertype),array("employee","telecaller","teamleader","fieldexecutive"))): ?>
  <div class="line"></div>
  <div class="boiteContent" id="attendance">
  <?php if(!isset($this->attendance->attendance_in) && !isset($this->attendance->attendance_out)): ?>
  <div class="defaultBoxLine"><a href="<?php  echo $Config->site.'makeattendance'; ?>" class="attendance">Make Attendance</a></div>
  <?php elseif( !isset($this->attendance->attendance_out) && isset($this->attendance->attendance_in)): ?>
  <div class="defaultBoxLine">Attendance In: <?php echo date("j F Y h:i A",strtotime($this->attendance->attendance_in)); ?></div>
  <div class="defaultBoxLine">
	<a href="<?php  echo $Config->site.'makeattendance'; ?>" class="attendance">Make Attendance Out</a> <br>
	<a title="BreakTime" href="<?php  echo $Config->site.'breaktime'; ?>" class="breaktime">BreakTime</a>
  </div>
  <?php elseif(!isset($this->attendance->attendance_in) && isset($this->attendance->attendance_out)): ?>
  <div class="defaultBoxLine">Attendance Out: <?php echo date("j F Y h:i A",strtotime($this->attendance->attendance_out)); ?></div>
  <div class="defaultBoxLine"><a href="<?php  echo $Config->site.'makeattendance'; ?>" class="attendance">Make Attendance In</a></div>
  <?php else: ?>
  <div class="defaultBoxLine">Attendance In: <?php echo date("j F Y h:i A",strtotime($this->attendance->attendance_in)); ?></div>
  <div class="defaultBoxLine">Attendance Out: <?php echo date("j F Y h:i A",strtotime($this->attendance->attendance_out)); ?></div>
  <?php endif; ?>
  </div>
  <?php endif; ?> 
</div>

<div class="padDiv row2">
  <div class="boiteHeader">
    <ol>
      <li><a href="<?php echo $Config->site."addcontact" ?>" class="icon addcontact" title="Add Your Contact"><span class="fa add"></span>Add</a></li>
    </ol>
    <h5><span class="fa contact"></span><a href="<?php echo $Config->site."mycontacts" ?>" class="titleLink">Contacts</a></h5>
  </div>
   <div class="line"></div>
  <div class="boiteContent">
   <?php if(count($this->Contacts) > 0): ?>
			<table cellpadding="3" cellspacing="3" id="mycontact">
				<thead>
					<th>Name</th>
					<th>Email ID</th>
					<th>Phone Number</th>
				</thead>
				<tbody>
	<?php foreach($this->Contacts as $contact): ?>
      <tr><td><?php echo $contact->name; ?></td><td><?php echo $contact->email; ?></td><td><?php echo $contact->phone; ?></td></tr>
		<?php endforeach; ?>
	  </tbody>
	  </table>
	<?php else: ?>
	<p>Sorry!! You Have No Contacts.</p>
	<?php endif; ?>
  </div>
</div>
<div class="clear"></div>
<br clear="all" />
<div class="padDiv row1">
  <div class="boiteHeader">
    <ol>
      <li><a href="<?php echo $Config->site."invoice" ?>"><span class="fa fa-search"></span>Details</a></li>
    </ol>
    <h5><span class="fa fa-usd"></span><a href="<?php echo $Config->site."invoice" ?>" class="titleLink">Finance</a></h5>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
  <?php if(count($this->TotalDue) > 0): ?> 
    <div class="defaultBoxLine">
		<div>Amount Due: <br clear="all" />INR <?php echo $this->TotalDue['totalINR']; ?> </div>
		<div>Amount Due: <br clear="all" />$ <?php echo $this->TotalDue['totallDoller']; ?> </div>
		<?php if($my->usertype=="customer" && (int)$this->TotalDue['totalDue'] != 0 ): ?>
		<!--<div><a href="<?php //echo $Config->site."payment?token=".base64_encode(json_encode($this->TotalDue)); ?>">Pay Now</a></div> -->
		<?php endif; ?>
   </div>
	<?php else:?>
	<div class="defaultBoxLine">No Record Found!</div>
	<?php endif; ?>
  </div>
</div>
<div class="padDiv row2">
  <div class="boiteHeader">
    <ol>
      <li><a href="" class="icon"><span class="fa fa-search"></span></a><a href="<?php echo $Config->site."mytickets" ?>">Details</a></li>
    </ol>
    <h5><span class="fa fa-question-circle"></span><a href="<?php echo $Config->site."mytickets" ?>" class="titleLink">Technical Support</a></h5>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
	 <?php if(count($this->Tickets) > 0): ?>
  			<table cellpadding="3" cellspacing="3" id="myticket">
				<thead>
					<th>Created On</th>
					<th>Ticket</th>
					<th>Created By</th>
				</thead>
				<tbody>
	<?php foreach($this->Tickets as $ticket): ?>
	<tr>
		<td><?php echo date("M d h:i A",strtotime($ticket->created_on)); ?></td>
		<td> <a href="<?php echo $Config->site."ticket/".$ticket->id; ?>"><?php echo substr(strip_tags($ticket->ticket_content), 0, 30)."...." ?></a></td>
		<td><?php echo $ticket->name;  echo ($ticket->Company!="")? "<br><small>(".$ticket->Company.")</small>": ""; ?></td>
	</tr>
  	<?php endforeach; ?>
	</tbody>
	</table>
	<?php else: ?>
	<p>Sorry!! You Have No Tickets.</p>
	<?php endif; ?>	
  </div>
</div>
<div class="clear"></div>
<br clear="all" />
<!------------Service Link-------------->
<div class="padDiv row1">
  <div class="boiteHeader">
  <h5>Services to connect</h5>
  </div>
	<div class="line"></div>
	<div class="boiteContent">
	  <div class="defaultBoxLine">
	  <div>Google<br>
	  	<?php if(count($this->googleToken) != 0): 
			$link_email = json_decode($this->googleToken->linking_email); 
			echo "Linked as : ".$link_email->email; endif; ?></div>
	  	<div>
			<?php if(count($this->googleToken) == 0): ?>
			<a href="<?php echo $Config->site."startapi"; ?>">Link Account</a>
			<?php else: ?>
				<a href="<?php echo $Config->site."unlink"; ?>">Unlink Account</a>
			<?php endif; ?>
		</div>
	  </div>
	</div>	
</div>
<!------------Service Link END-------------->
<div class="padDiv row2"> 
  <div class="boiteHeader">
    <ol>
      <li><a href="<?php echo $Config->site."myprojects/"; ?>" class="icon"><span class="fa fa-search"></span>Details</a></li>
    </ol>
    <h5><span class="fa fa-tasks"></span><a href="<?php echo $Config->site."myprojects/"; ?>" class="titleLink">Projects</a></h5>
  </div>
  <div class="line"></div>
   <?php if(count($this->Projects) > 0): ?>
  <?php foreach($this->Projects as $project): ?>
  <div class="boiteContent">
    <div class="defaultBoxLine">
		<div><?php echo date("M d h:i A",strtotime($project->create_date)); ?></div>
		<div><a href="<?php echo $Config->site."myprojects/#project/".$project->id; ?>"><?php echo $project->project_name; ?></a></div>
		</div>
  </div>
  <?php endforeach; ?>
  <?php else: ?>
	<p>Sorry!! You Have No Projects.</p>
	<?php endif; ?>	
</div>


<div class="clear"></div>
<br clear="all" />
<?php if(!in_array(strtolower($my->usertype),array("customer","admin"))): ?>
<div class="padDiv row10">
	<div class="boiteHeader">
	<h5><span class="fa fa-tasks"></span>Leave Record</h5>
	</div>
	<div class="line"></div>
	<div class="leave_record_box">
		<div class="singleRecord">Monthly Leave Deduction>></div>
		<div class="boiteContent">
			<div class="defaultBoxLine"><div>Month</div><div>Leave(days)</div></div>
		</div>	
		<?php foreach($this->leaveDetail["leave_record"] as $eachRecord): ?>
		<div class="boiteContent">
		 <div class="defaultBoxLine">
		<div><?php echo $eachRecord->month."/".$eachRecord->year; ?></div><div><?php echo $eachRecord->leave_deduct; ?></div>

		</div>
		</div>
		<?php endforeach; ?>
</div>

<div class="leave_record_box">
	<div class="singleRecord">Yearly Leave Allocation>></div>
	<div class="boiteContent">
		<div class="defaultBoxLine"><div>Year</div><div>Leave(days)</div></div>
	</div>
		<?php foreach($this->leaveDetail["allocation_record"] as $eachAlloc): ?>
		<div class="boiteContent">
		 <div class="defaultBoxLine">
		<div><?php echo $eachAlloc->year; ?></div><div><?php echo $eachAlloc->leave_allocated; ?></div>
		</div>
		</div>
		<?php endforeach; ?>
	</div>
<div class="line"></div>
<div class="singleRecord"> Total Leave Balance(Paid Leave): <?php echo $this->leaveDetail["paid_leave"]; ?></div>
</div>
<div class="clear"></div>
<?php endif; ?>