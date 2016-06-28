<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my;
	if(strtolower($my->usertype) == 'employee'):
?>
Sorry you con't access this section.
<?php else: ?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">

		<div class="order_nowform">
		 <form name="addProjectForm" id="addProjectForm" method="post" class="wpcf7-form" enctype="multipart/form-data" onsubmit="Project.addProject('this')">
		   <input type="hidden" name="view" value="project" />
		   <input type="hidden" name="task" value="saveproject" />
		   <input type="hidden" name="project_id" value="" />
		   <h1 style="float:none;">Please provide Project details</h1>
		   <div class="table_edituser">
		   		<ul>
					<li>Project Name :</li>
					<li><span class="wpcf7-form-control-wrap name">
				<input name="project_name" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input1" required="true"  type="text" value="" />
					   </span><span class="error_tag" id="error_project_name" ></span> </li>
				 	<li>Company :</li>
					<li><span class="wpcf7-form-control-wrap organization">
						<input type="text" name="company_id" id="text_company"/>
				   </span> <span class="error_tag" id="error_company" ></span>
				   </li>
				   <li>Deadline :</li>
					<li>
						<input type="text" name="deadline" id="text_deadline" class="deadline"/>
				   </span> <span class="error_tag" id="error_deadline" ></span>
				   </li>
				   <li>&nbsp;</li>
				   <li><input type="button" value="Create Project" id="submitcontact" onclick="Project.addProject('addProjectForm')"/></li>
				 </ul>
				 </div>
		    </form>
		     
		</div>
		  </div>
	  </div>
   </div>
</div>
<?php  endif; ?>
<script>
	jQuery(document).ready(function()
	{
		var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"500px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"500px"});
		} 
		else if(screenwidth > 600 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"500px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 600) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"500px"});
		}
		 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"500px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"500px"});
		}
		jQuery("#text_company").kendoComboBox({	
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
						url: "project?view=project&task=getCompanyForProject_fromAjax",
						method: "post"
					}
				}
			}
		});
	});
</script>