<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my;
	$post = IRequest::get('post');
	if(strtolower($my->usertype) == 'employee'):
?>
Sorry you con't access this section.
<?php else: ?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	  
	<div class="order_nowform">
	<form name="addCompanyForm" id="addCompanyForm" method="post" class="wpcf7-form" enctype="multipart/form-data"  onsubmit="Project.addCompany('this');">
		   <input type="hidden" name="view" value="project" />
		   <input type="hidden" name="task" value="savecompany" />
		   <input type="hidden" name="comppany_id" value="" />
		   <h1 style="float:none;">Please provide Company details : </h1>
		   <div class="table_edituser">
		   		<ul>
					<li>Company Name :</li>
					<li><span class="wpcf7-form-control-wrap name">
				<input name="company_name" size="40" class="input1" required="true"  type="text" value="" />
					   </span><span class="error_tag" id="error_name" ></span> </li>
				 	<li>Owner :</li>
					<li><span class="wpcf7-form-control-wrap organization">
					<?php  if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin'): ?>
						<input type="text" name="owner_id" id="text_owner_company"/>
					<?php  else : ?>
						<?php echo $my->name; ?>
						<input type="hidden" name="owner_id" value="<?php echo $my->uid; ?>"  />
					<?php endif; ?>
				   </span> <span class="error_tag" id="error_organization" ></span>
				   </li>
				   <li>&nbsp;</li>
				   <li><input type="submit" value="Create Company" id="submitcontact" onclick="Project.addCompany('addCompanyForm');"/></li>
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
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"300px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"300px"});
		} 
		else if(screenwidth > 600 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"250px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 600) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"300px"});
		}
		 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"300px"});
		}
		jQuery("#text_owner_company").kendoComboBox({	
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
						url: "project?view=project&task=getUsersForCompany_fromAjax",
						method: "post"
					}
				}
			}
		});		
	});
</script>