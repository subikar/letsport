<?php
	defined ('ITCS') or die ("Go away.");
	global $my;
	$project = $this->Refproject;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	  
		<div class="order_nowform">
		 <form name="addTaskForm" id="addTaskForm" method="post" class="wpcf7-form" enctype="multipart/form-data" onsubmit="Project.addTask('this')">
		   <input type="hidden" name="view" value="project" />
		   <input type="hidden" name="task" value="savetask" />
		   <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->project_id; ?>" />
		   <h1 style="float:none;">Please provide Task details</h1>
		   
		   
		   
		   <div class="table_edituser">
		   		<ul>
					<li>Task Name :</li>
					<li>
						<span class="wpcf7-form-control-wrap name">
						<input name="task_name" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input1" required="true"  type="text" />
					   </span><span class="error_tag" id="error_task_name" ></span></li>
					<li>Project Name :</li>
					<li><span class="wpcf7-form-control-wrap organization">
					<?php if($project['project_id'] != 0): 
							echo $project['projectDetails'][0]->project_name; ?>
							<input type="hidden" name="project" value="<?php echo $project['projectDetails'][0]->id; ?>"  />
					<?php else: ?>						
						<input type="text" name="project" id="text_project"/>
					<?php endif; ?>
				   </span>
				   <span class="error_tag" id="error_project" ></span></li>
					<li>&nbsp;</li>
					<li><input type="submit" value="Create Task" id="submitcontact" onclick="Project.addTask('addTaskForm')"/></li>
				</ul>
		   </div>
		   </form>
		
		</div>
	</div>
	</div>
   </div>
</div>
<script>
	jQuery(document).ready(function()
	{
		//jQuery("#project").kendoComboBox();
		var screenwidth = $(document).width();
		 <!--alert(screenwidth);-->
		if(screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%"});
		} 
		else if(screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"60%"});
		} 
		else if(screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%"});
		} 
		else if(screenwidth <= 600) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%"});
		}
		 
		else if(screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"100%"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"100%"});
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
	});
</script>