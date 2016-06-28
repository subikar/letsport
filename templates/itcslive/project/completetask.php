<?php
	global $my,$Config;
	$users = $this->completeTask['users'];
?>
<link rel="stylesheet" type="text/css" href="<?php echo $Config->site; ?>templates/itcslive/js/starRating/jRating.jquery.css" media="screen" />
<script type="text/javascript" src="<?php echo $Config->site; ?>templates/itcslive/js/starRating/jRating.jquery.js"></script>
<form method="post" name="FrmCompleteTask" id="FrmCompleteTask" onsubmit="Project.completetask('this');">
<div>
   <h4>Do you like to complete the task?</h4>
</div>
<?php if(count($users) >0): ?>
<div>Please Review How Our Employee Work on your task?</div>
<div>
      <?php $i=1; foreach($users as $user):  ?>
	  <div class="rating_name">
     <?php echo $user->name; ?>
      <div class="basic" data-average="0" data-id="<?php echo $i; ?>" id="<?php echo $user->uid; ?>"></div>
      <input type="hidden" name="rating_user[<?php echo $user->uid; ?>]" id="rating_user_<?php echo $user->uid; ?>" />
      </div>
	  <?php $i++; endforeach; ?>
</div>
<?php endif; ?>
<br clear="all">
<div>Do you like to add your valuable comment How our team can improve?<br />
   <textarea name="comment" id="editor"></textarea>
</div>
<input type="hidden" name="view" value="project" />
<input type="hidden" name="user_id" value="<?php echo $my->uid; ?>" />
<input type="hidden" name="task" value="customerreview" />
<input type="hidden" name="task_id" value="<?php echo $this->completeTask['task_id'] ?>" />
</form>
<br clear="all" />
<div class="login_btns" style="text-align:center;">
<input type="button" value="Close The Task" onclick="Project.completetask('FrmCompleteTask');" class="login" />
</div>

<script type="text/javascript">
$(document).ready(function(){

		var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"300px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"300px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"300px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
		
      $(".basic").jRating({
        onClick : function(element,rate) {
        	jQuery("#rating_user_"+element.id).val(rate);
        }
      });
});
</script>



<style>
.rating_name{ float:left; min-width:25%; padding:6px;}
</style>