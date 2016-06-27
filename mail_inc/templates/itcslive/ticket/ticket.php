<?php
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$Threads=$this->Tickets;
?>
<div id="primary">
<div role="main" id="contactus">
	<div class="article-body">
<div class="padDiv row10">
  <div class="boiteHeader">
    <ol>
      <li>
	  <?php if((int)$my->uid > 0): ?>
	  <a href="<?php echo $Config->site."mytickets"; ?>" class="icon"><span class="fa add"></span>Add</a>
	  <?php else: ?>
	  <a href="<?php echo $Config->site."contact-us"; ?>" class="icon"><span class="fa add"></span>Add</a>
	  <?php endif; ?>
	  </li>
      <li><span class="fa fa-reply"></span><a href="#replyDiv">Reply</a></li>
    </ol>
    <h5><span class="fa fa-tasks"></span><?php echo $Threads["main"]->subject; ?></h5>
  </div>
  <div class="line"></div>
  <div class="boiteContent" id="threadContent">
    <div>
	From : <?php echo $Threads["main"]->owner_name; ?> <br/>
	<?php echo $Threads["main"]->ticket_content; ?><br/>
	<span class="right small">Created On: <?php echo date("j F Y h:i A",strtotime($Threads["main"]->created_on)); ?></span>
	</div>
    <div class="line"></div>
	<?php foreach($Threads["thread"] as $Thread): ?>
    <div class="defaultBoxLine">
	From : <?php echo $Thread->owner_name; ?> <br/>
	<?php echo $Thread->ticket_content; ?><br />
	<span class="right small">Created On: <?php echo date("j F Y h:i A",strtotime($Thread->created_on)); ?></span>
	</div>
    <div class="line"></div>
	<?php endforeach; ?>
	<?php if($Threads["files"]):
	echo '<ul>';
	foreach($Threads["files"] as $fileinarray):
	?>
	<li><?php echo $fileinarray['attach_file_name']; ?></li>
	<img src="<?php echo $Config->site.$fileinarray['attach_file_link']; ?>" width="50" height="50"  />
	<?php endforeach;
	echo '</ul>';
	 endif;?>
  </div>
</div>
<div class="clear"></div>
<div class="padDiv row10">
  <div class="boiteHeader">
    <h5><span class="fa fa-user"></span>Add a comment to an existing request</h5>
  </div>
  <div class="boiteHeader">
    <h5><span class="fa fa-request"></span>Request number :#<span id="req_no"><?php echo $Threads["Request_no"]; ?></span></h5>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
  <div id="error_com" style="display:none;"></div>
   <form name="addCommentForm" action="" id="addCommentForm" method="post" onsubmit="return Ticket.validateComment(this);">
    <textarea name="comment" id="editor" required="true" placeholder="Write Comment.."></textarea>
	<ul id="allAttechFile"></ul>
	<div class="attchfile"><a title="Attach File" href="<?php echo $Config->site.'attach?linkId=ticket_'.$Threads["main"]->id; ?>" class="attachment">Attach files</a></div>
	<input type="hidden" name="view" value="ticket" />
	<input type="hidden" name="task" value="addcomment" />
	<input type="hidden" id="getlinkId" name="ticket_id" value="<?php echo $Threads["main"]->id; ?>" />
	<input type="hidden" id="user_id" name="user_id" value="<?php echo (int)$my->uid; ?>" />
	<?php if($my->usertype == 'telecaller' || $my->usertype == 'admin'):?>
	<select name="no-email-customer"><option value="0">Don't send email to customer</option><option value="1">Send email to Customer</option></select>
	<?php endif; ?>
	</form>
	<div class="login_btns" style="text-align:center;">    
	<input class="login" type="button" value="Reply" onclick="Ticket.validateComment('addCommentForm');" />
	</div>
  </div>
</div>
<div class="clear"></div>
</div>
</div>
</div>