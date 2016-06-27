<?php error_reporting(0);  
$post=IRequest::get("POST"); 
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Projects</h1>
        <div class="options">
          <div class="btn-toolbar">
            
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
	  <form name="ProjectForm" id="ProjectForm" method="post" >
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Project Manager</h4>
                <div class="options"> 
				  <input class="form-control" type="text" name="title_text" value="<?php echo $post["title_text"]; ?>" placeholder="Search here" /> 
				  <input type="button" name="Go" value="Go" onclick="document.ProjectForm.submit();" />
				  </div>
				  <h4>
				<input type="button" name="Delete" value="delete" onclick="Project.multipleDelete('ProjectForm')" />
				</h4>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
                        <th class="col-xs-1 col-sm-1">Project ID</th>
                        <th class="col-xs-9 col-sm-4">Project Name</th>
                        <th class="col-sm-5 hidden-xs">Company Name</th>
                        <th class="col-sm-5 hidden-xs">Created on</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects" style="font-size:13px;">
					   <?php  foreach($this->Projects as $project): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $project->id; ?>]" value="<?php echo $project->id; ?>"  /></td>
                         <td><?php echo $project->id; ?></td>
						<td><?php echo $project->project_name; ?></td>
                        <td><?php echo $project->company_name; ?></td>
                        <td><?php echo $project->create_date; ?></td>
                        <td class="text-right"><div class="btn-group">
							<span class="btn btn-xs btn-default-alt">
							<a href="javascript:void(0);" title="Delete" onclick="Project.Remove(<?php echo $project->id; ?>);" /><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div></td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php  endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;">
						<div class="clearfix">
                          <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
						  </div>
						  </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
	  <input type="hidden" name="view" value="project" />
	  </form>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>