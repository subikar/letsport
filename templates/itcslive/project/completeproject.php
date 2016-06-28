<div class="description_add">
	<form method="post" name="FrmCompleteProject" id="FrmCompleteProject" onsubmit="Project.completeproject('this');">

   		<h4>Do you like to complete the Project?</h4>
		<div class="table_edituser">
		<ul>
			<li>Project Name :</li> <li><?php echo $this->projectDetails->project_name; ?></li>
			<li>Deadline :</li> <li> <?php echo ($this->projectDetails->deadline != 0)?date("d-m-Y", strtotime($this->projectDetails->deadline)):"00-00-0000"; ?>
		
		<li>
			Complete Project within Deadline?</li><li style="text-align:left;"> <input type="checkbox" name="intime" id="intime" value="1" />
		</li>
		</ul>
		<input type="hidden" name="view" value="project" />
		<input type="hidden" name="task" value="closeproject" />
		<input type="hidden" name="project_name" value="<?php echo $this->projectDetails->project_name; ?>" />
		<input type="hidden" name="project_id" value="<?php echo $this->projectDetails->id; ?>" />
	</form>
	<br clear="all" />

	<input type="button" value="Close The Project" onclick="Project.completeproject('FrmCompleteProject');" class="add_task" />
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"300px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"300px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"50%", height:"300px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
});
</script>