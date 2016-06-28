<?php
	$project = $this->projectDetails;
	$deadline = date("Y-m-d", strtotime($project->deadline));
	$date = date("Y-m-d");
	$deadline = (strtotime($deadline) > 0) ? $deadline : $date;
?>
<form method="post" name="FrmEditDeadline" id="FrmEditDeadline" onsubmit="Project.editdeadline('this');">
	<input type="hidden" name="view" value="project" />
	<input type="hidden" name="task" value="savedeadline" />
	<input type="hidden" name="project_id" id="project_id" value="<?php echo $project->id; ?>" />
	<input type="hidden" id="beforedeadline" value="<?php echo $deadline; ?>" />
	<h1 style="float:none;">Please set Another Deadline</h1>
		<div class="table_edituser">
		   		<ul>
				<li>Previous Deadline :</li>
				<li><?php echo (strtotime($project->deadline) > 0)?date("d-m-Y", strtotime($project->deadline)):"00-00-0000";?></li>
				<li>Deadline :</li>
				<li><input name="deadline" id="text_enddate" class="deadline" required="true"  type="text" /></li>
				<li>Project Name :</li>
				<li><span class="wpcf7-form-control-wrap organization">
						<?php if($project->id != 0): 
							echo $project->project_name; ?>
						<input type="hidden" name="project" value="<?php echo $project->id; ?>"  />
						<?php else: ?>						
						<input type="text" name="project" id="text_project" value=""/>
						<?php endif; ?>
					</span>
					<span class="error_tag" id="error_project" ></span>
				</li>
			<li>&nbsp;</li>
				<li><input type="button" value="Save Deadline" onclick="Project.editdeadline('FrmEditDeadline');" /></li>
</form>

<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"500px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"500px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"50%", height:"500px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"500px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"500px"});
		}
		jQuery("#text_project").kendoComboBox({	
			dataTextField: "text",
			dataValueField: "value",
			filter: "contains",
			minLength: 2,
			dataSource: {
				type: "json",
				serverFiltering: true,
				transport: {
					read: {
						dataType: "json",
						url: "project?view=project&task=getProjectForTask_fromAjax",
						method: "post"
					}
				}
			}
		});
		function onChange()
		{
        	kendoConsole.log("Change :: " + kendo.toString(this.value(), 'd'));
        }
		var deadline = jQuery("#beforedeadline").val();
		jQuery("#text_project").kendoDatePicker({
				value:new Date(deadline),
				change: function() {
					var value = this.value();
					console.log(value); //value is the selected date in the datepicker
				}, format: "yyyy-MM-dd"});
});
</script>