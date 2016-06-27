<?php
	global $my;
	$taskDetails = $this->taskDetails['task'];
?>

<h4>Add Task Description </h4>
<form method="post" name="FrmtaskDescription" id="FrmtaskDescription" onsubmit="Project.taskdescription(this);">
	<div> Add Description for <?php echo $taskDetails->task_name; ?> :</div>
	<div>
		<textarea name="description" id="editor"><?php echo $taskDetails->task_description; ?></textarea>
	</div>
	<input type="hidden" name="view" value="project" />
	<input type="hidden" name="task" value="savedescription" />
	<input type="hidden" name="task_id" id="task_id" value="<?php echo $this->taskDetails['task_id']; ?>" />
	<input type="hidden" id="user_id" name="user_id" value="<?php echo (int)$my->uid; ?>" />
</form>
<br clear="all" />
<div class="login_btns" style="text-align:center;">
<input class="login" type="button" value="Add Description" onclick="Project.taskdescription('FrmtaskDescription');" />
</div>
<script>
	jQuery(document).ready(function()
	{
		parent.jQuery.colorbox.resize({width:"55%", height:"80%"});
	});
</script>