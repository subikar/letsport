<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$project_id=isset($this->project_id) ? $this->project_id : 0;
?>

<div class="project_page">
		<div class="wrapper">
              <div class="grid_3 grid-round color1">
				  <?php $this->display('project/left'); ?>
				  <input type="hidden" id="default_project_id" value="<?php echo $project_id; ?>" />
              </div>
              <div class="grid_9 row2 grid_border">
				<div id="projects">
				   <div id="right_area_sidebar"></div>
				   <div id="loading" style="display:none;">
				<img id="loading-image" src="<?php echo $Config->site; ?>images/loading.gif" alt="Loading..." />Loading....
				</div>
				 </div>
              </div>
		</div>	  
</div>