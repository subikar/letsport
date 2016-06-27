<?php
	global $Config,$my; ?>
	<form method="post" id="assignTask" name="assignTask">
<?php	foreach($this->assignUser as $value): ?>
		<input type="checkbox" name="users[]" value="<?php echo $value->relation_id; ?>" /> <?php echo $value->name; ?><br />
		<input type="hidden" name="email[]" value="<?php echo $value->email; ?>" />
<?php	endforeach; ?>
		<input type="hidden" name="task_id" value="<?php echo $this->task_details['task_id']; ?>" />
		<input type="hidden" name="project_id" value="<?php echo $this->task_details['project_id']; ?>" />
		<input type="hidden" name="task_name" value="<?php echo $this->task_details['task_name']; ?>" />
		<input type="hidden" name="view" id="view" value="project" />
		<input type="hidden" name="task" id="task" value="saveAssignTask" />
		<input type="submit" value="Assign Task" class="login" />
	</form>

<script type="text/javascript">
jQuery(document).ready(function()
{
	parent.jQuery.colorbox.resize({width:"50%", height:"70%"});
});
</script>
