<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$post=IRequest::get("POST");
?>
<h3 class="bot-1">My Contacts</h3>
<div class="row10">
	<div class="box_area">
		<form name="tSearchForm" action="" method="post" id="form">
		   <label class="name">
				<input placeholder="Name" type="text" name="name" id="name" size="25" value="<?php echo $post['name'];  ?>" />
		   </label>
		   <label class="name">
				<input placeholder="Email" type="text" name="email" id="email" size="25" value="<?php  echo $post['email'];  ?>"  />
		   </label>
		   <label class="name">
			  <input placeholder="Phone Number" type="text" name="phone" id="phone" size="25" value="<?php  echo $post['phone'];  ?>" />
		   </label>
		   <label class="name">
			  <input placeholder="Designation" type="text" name="designation" id="designation" size="25" value="<?php  echo $post['designation'];  ?>" />
		   </label>
		   <div class="clear"></div>
		   <label class="name">
			  By Requirement : <input  type="checkbox" name="hasrequirement" id="hasrequirement" />
		   </label>
		   <input value="Search" class="button-1" id="search_adbuttn" type="submit">
		   <div class="clear"></div>
		</form>   
	</div>
	<div class="clear"></div>	
<br clear="all">
	<div class="boiteHeader">
		<ol>
			<li>
				<a href="<?php echo $Config->site."addcontact"; ?>" class="icon addcontact" title="Add Contact">
					<span class="fa add"></span>
				Add</a>
			</li>
		</ol>
		<h5><span class="fa fa-tasks"></span> <?php echo $this->countofcontacts; ?> Contacts Found</h5>
	</div>
	<div class="line"></div>
	<div class="boiteContent" id="ContactsView">
	<?php if(count($this->contactsDetails) > 0): ?>
		<div class="defaultBoxLine">
			<table cellpadding="3" cellspacing="3" id="mycontact">
				<thead>
					<th>Name</th>
					<th>Email ID</th>
					<th>Phone Number</th>
					<th>Ticket</th>
					<th></th>
				</thead>
				<tbody>
				<?php foreach($this->contactsDetails as $contacts): ?>
					<tr>
						<td><?php echo $contacts->name;  ?>
							<?php if($contacts->designation!=''): ?>
								<br />(<small><?php echo $contacts->designation; ?></small>)
							<?php endif; ?>
						</td>
						<td><?php echo $contacts->email;  ?></td>
						<td><?php echo $contacts->phone;  ?></td>
						<td><?php if($contacts->ticket > 0):?>
				             <a  href="<?php echo $Config->site."modifyticket?ticket_id=".$contacts->ticket; ?>" class="modify_ticket cboxElement" title="Ticket for <?php echo $contacts->name;  ?>">Ticket</a>
							 <p>Alert : <?php echo date('d M Y',strtotime($contacts->alert))?></p>
							 <?php else: ?>
							<?php if($contacts->hasrequirement == 1):?>
							 <span style="color:#FF0000; text-decoration:blink;">Has Requirement</span>
							<?php endif;?>
						    <?php endif;?>
						</td>
						<td>
				        <a  href="<?php echo $Config->site."addcontact?uid=".$contacts->uid; ?>" class="icon addcontact" title="Edit Contact">Edit</a>
						</td>
						<td><input type="hidden" name="uid" id="uid" value="<?php   echo $contacts->uid;  ?>" /></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>	
		<div id="pagination"><?php echo $this->Pagination; ?></div>
	</div>
	<div class="clear"></div>
	<?php else: ?>
			<p>Sorry!! You Have No Contacts.</p>
	<?php endif; ?>	
	</div>
</div>
<div class="clear"></div>	

<script>
			$(document).ready(function(){
                   $(".addcontact").colorbox({iframe:true, width:"45%", height:"70%"});	
                   $(".addticket").colorbox({iframe:true, width:"80%", height:"90%"});
			       $(".modify_ticket").colorbox({iframe:true, width:"65%", height:"80%"});			
			});
</script>