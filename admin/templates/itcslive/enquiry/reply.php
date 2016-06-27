<?php
	$QueryDetails = $this->QueryDetails;
?>

<div class="total_reply_area">
   <div class="user_section">
	   <h3>Enquery For: <?php  echo $QueryDetails['categoryName'];  ?></h3>
		<p>User Name: <?php echo $QueryDetails["name"]; ?></p>
		<p>User Email: <?php echo $QueryDetails["email"]; ?></p>
		<?php if(isset($QueryDetails["phonenunber"]) && $QueryDetails["phonenunber"] !="" ): ?>
			<p>Phone No: <?php echo $QueryDetails["phonenunber"]; ?></p>
		<?php endif; ?>
		  	<p>Users Message:</p>
		  <?php echo $QueryDetails["message"]; ?> 
	</div>
   <div class="reply_form_area">
      <p>Query From Admin: </p>
      <form method="post" name="replyFrm" id="replyFrm">
         Reply :
         <textarea name="ticket_content" id="ticket_content"></textarea><br />
		 <p>Telecaller :</p>
		<select name="user_id" id="user_id">
			<option value="">Select Telecaller</option>
			<?php foreach($QueryDetails['user'] as $user):  
					$userSelect = ((int)$user->uid==(int)$post["user_id"]) ? "selected='selected'" : '';?>
			<option value="<?php echo $user->uid; ?>" <?php echo $userSelect; ?>>
					<?php echo $user->name; ?>
			</option>
			<?php endforeach; ?>
		</select><br />
         <input type="submit" value="Submit" />
         <input type="hidden" name="view" value="enquiry" />
         <input type="hidden" name="task" value="savepage" />
         <input type="hidden" name="ticket_id" value="<?php echo $this->Enquiry_id; ?>" />
      </form>
   </div>
</div>

<script>
	jQuery(document).ready(function()
	{
		jQuery("#user_id").kendoComboBox();
	});
</script>