<?php 
	global $my,$Config;
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	$accessForUser=array("customer","telecaller","Admin");
?>
<div class="clear"></div>
<div class="widget_pages">
  <div class="menu-our-services-container">
  <?php if(in_array($my->usertype,$accessForUser)):?>
    <select id="create_addtype" name="create_addtype" onchange="Project.callpage();"> 
		  <option value=""><i class="fa fa-fw fa-plus-square"></i>Create</option>
		  <option value="company"><i class="fa fa-fw fa-plus-square"></i>Company</option>
		  <option value="project"><i class="fa fa-fw fa-plus-square"></i>Projects</option>
		  <option value="task"><i class="fa fa-fw fa-plus-square"></i>Tasks</option>
	</select>
	<input type="hidden" id="baseUri" value="<?php echo $Config->site; ?>" />
<?php else: ?>
	<p>Assigned Project</p>
<?php endif; ?>	
  </div>
</div>
<!--<br clear="all" />-->

<div class="widget_pages">
	<?php if(strtolower($my->usertype) != "customer"): ?>
	<div class="menu_list"><a href="#myattendance">
	<i class="fa fa-fw fa-clock-o"></i><?php if(strtolower($my->usertype) == 'admin'): ?> Attendance List<?php else: ?>My attendance <?php  endif; ?></a></div>
	<?php endif; ?>
	
	<div class="menu_list"><a href="#timetracking"><i class="fa fa-fw fa-clock-o"></i>Time Tracking</a></div>
	
	<?php if(strtolower($my->usertype)=="admin" || strtolower($my->usertype)=="telecaller"): ?>
	<div class="menu_list"><a href="#archive"><i class="fa fa-archive"></i> Archive</a></div>
	<?php endif; ?>
	 <div class="projectList"><i class="fa fa-fw fa-building-o"></i><b>My Projects</b></div>
	 <div class="div-mpsearch">
     <form id="myproject">
		<input type="text" onkeyup="Project.searchLeftbar();" placeholder="Search Company/Project" name="project_search_text" id="project_search_text" />
		<a class="search_button" onclick="Project.searchLeftbar();" href="javascript:void(0);"></a>
		<textarea style="display:none;" id="result_allData"><?php echo json_encode($this->companyList); ?> </textarea>
     </form>	
	   <div class="clear"></div>
	 </div>
	<?php 	foreach($this->companyList as $company):  ?>
	    <div class="company" id="comp<?php echo $company->id; ?>">
		<div class="menu_list menu_list_background">
  		<?php  echo $company->company_name;   ?>
		<?php if(strtolower($my->usertype)=="admin" || strtolower($my->usertype)=="telecaller"): ?>
		<span class="fa-right"><a href="#company/<?php echo $company->id; ?>"><i class="fa fa-user_1"></i></a></span>
		<span class="fa-right"><a title="Add to Archive" href="javascript:void(0);" onclick="Project.setToArchive('company','<?php echo $company->id; ?>');"><i class="fa fa-archive_1"></i></a></span> 
		<?php endif; ?>
		</div>
			<?php foreach( $company->projectList as $project): ?>
				<div class="projectList"  id="project<?php echo $project->id; ?>">
					<a href="#project/<?php  echo $project->id; ?>"><i class="fa fa-fw fa-building-o"></i><?php  echo $project->project_name; ?></a> 
					<?php if($project->status == 1): ?>
					<i class="fa fa-check"></i>
					<?php endif; ?>
					<input type="hidden" name="project_id" id="project_id" value="<?php  echo $project->id;  ?>" />
					<?php if(strtolower($my->usertype)=="admin" || strtolower($my->usertype)=="telecaller"): ?>
					<span class="fa-right">
					<a title="Add to Archive" href="javascript:void(0);" onclick="Project.setToArchive('project','<?php echo $project->id; ?>');"><i class="fa fa-archive"></i></a>
					</span> 
					<?php endif; ?>
				</div>
			<?php  endforeach;   ?>
			<br clear="all" />
  		</div>
	<?php   endforeach;  ?>	
	
</div>