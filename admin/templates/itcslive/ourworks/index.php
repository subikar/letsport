<?php  error_reporting(0); 
 $post=IRequest::get("POST"); ?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h4>Availibility Manager</h4>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=ourworks&task=addnew">Add Availibility</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                
				<form name="ourworksForm" id="ourworksForm" method="post">
                
                	<input type="hidden" name="operation_type" value="load" />
					<input class="form-control placepicker" type="text" name="start_location" value="<?php echo $post["start_location"]; ?>" placeholder="search with start location" />			
					<input class="form-control placepicker" type="text" name="end_location" value="<?php echo $post["end_location"]; ?>" placeholder="End Location" />			
					<input type="submit" value="Go" onclick="document.ourworksForm.submit()" />	
		        </form>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
						<th>Post ID</th>
                        <th>Start Location</th>
                        <th>End Location </th>
						 <th>Avaliable Date Time</th>
                        <th>Vehicle Type</th>
						<th>Material Type</th>
						<th>Consignment Weight</th>
						<th>Submitted By</th>
                        <th>Created On</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php  foreach($this->Works as $work): ?>   
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $work->id; ?>]"  /></td>
                         <td><?php echo $work->id; ?></td>
						<td><a href="index.php?view=ourworks&task=addnew&work_id=<?php echo (int)$work->id; ?>"><?php echo $work->start_location; ?></a></td>
                        <td><?php echo $work->end_location; ?></td>
						<td><?php echo $work->avaliable_date; ?> : <?php echo $work->reporting_time; ?></td>
						<td><?php echo $work->vehicle_type; ?></td>
						<td><?php echo $work->material_type; ?></td>
						<td><?php echo $work->consignment_weight; ?></td>
						<td><?php echo $work->owner_id; ?></td>
                       <td><?php echo $work->created_on; ?></td>
                        <td class="text-right"><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=ourworks&task=addnew&work_id=<?php echo (int)$work->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$work->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button>
							<span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=ourworks&task=Removework&work_id=<?php echo (int)$work->id; ?>"><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div></td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php  endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;"><div class="clearfix">
                            <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
                          </div></td>
                      </tr>
                    </tfoot>  
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="operation_type" value="truck" />
		<input type="hidden" name="view" value="ourworks" />
		
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>
  