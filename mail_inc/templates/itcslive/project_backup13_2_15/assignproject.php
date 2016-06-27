<?php
	defined ('ITCS') or die ("Go away.");
	global $my;
?> 

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
            <div class="order_nowform">
			   <h3>Shared Users</h3>
			   <?php if(count($this->RefDetails["assignedUsers"]) > 0): ?>
			   <ol class="shared_list">
			   <?php foreach($this->RefDetails["assignedUsers"] as $assigned): ?>
			   <li><?php echo $assigned->name; ?> (<small><?php echo ucfirst($assigned->usertype); ?></small>)</li>
			   <?php endforeach; ?>
			   </ol>
			   <?php else: ?>
			   Not yet assigned to any user. 
			   <?php endif; ?>
			   <br clear="all" />
               <h3>Assign To Others</h3>
               <form name="addAssignProjectForm" id="addAssignProjectForm" method="post" class="wpcf7-form" enctype="multipart/form-data" onsubmit="Project.assignProject('this')">
                  <input type="hidden" name="view" value="project" />
                  <input type="hidden" name="task" value="saveassignProject" />
                 <input type="hidden" name="project_id" id="project_id" value="<?php  echo $this->RefDetails['project_id'];  ?>" />
				  <select name="user_id[]" id="user_name" ></select>
				  <span class="error_tag" id="error_company" ></span>
				 <br clear="all" />
				 </form>
			   <div class="login_btns" style="text-align:center;">
					  <input type="submit" value="Assign Project" class="login" onclick="Project.assignProject('addAssignProjectForm')"/>
				</div> 
            </div>
         </div>
      </div>
   </div>
</div>
<script>
	jQuery(document).ready(function()
	{
		var project_id = jQuery("#project_id").val();
		var user = jQuery("#user_name").kendoMultiSelect({
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
						url: "project?view=project&task=getEmployeeForProject_fromAjax&project_id="+project_id,
						method: "post"
					}
				}
			},
			autoBind: false}).data("kendoMultiSelect");
		document.getElementById("user_name").value = user.value();
		parent.jQuery.colorbox.resize({width:"60%", height:"80%"});
	});
</script>
