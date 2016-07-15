<?php  error_reporting(0); 
 $post=IRequest::get("POST"); ?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Availibility</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=alltruck&task=addnew">Add Truck</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Availibility Manager</h4>
				<form name="ourworksForm" id="ourworksForm" method="post">
                <div class="options">
					<input class="form-control" type="text" name="search_txt" value="<?php echo $post["search_txt"]; ?>" placeholder="Enter type here" />			
					<input type="submit" value="Go" onclick="document.ourworksForm.submit()" />	
				</div>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
						<th>Truck Id</th>
						<th>Truck Type</th>
                        <th>Registration No</th>
                        <th>Chasis No </th>
						 <th>Engine No</th>
                        <th>Registration Date</th>
						<th>Insurance Date</th>
						<th>Truck No.</th>
						<th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
                    	<?php  //print_r($this->Trucks); ?>
					   <?php  foreach($this->Trucks as $truck): ?>   
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $truck->truck_id; ?>]"  /></td>
                         <td><?php echo $truck->truck_id; ?></td>
						<td><a href="index.php?view=alltruck&task=addnew&truck_id=<?php echo (int)$truck->truck_id; ?>"><?php echo $truck->truck_type; ?></a></td>
                        <td><?php echo $truck->registration_no; ?></td>
						<td><?php echo $truck->chasis_no; ?> : <?php //echo $work->reporting_time; ?></td>
						<td><?php echo $truck->engine_no; ?></td>
						<td><?php echo $truck->truck_registration_date; ?></td>
						<td><?php echo $truck->insurance_date; ?></td>
						<td><?php echo $truck->truck_no; ?></td>
						
                        <td class="text-right"><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=ourworks&task=addnew&truck_id=<?php echo (int)$truck->truck_id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$truck->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button>
							<span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=ourworks&task=Removework&truck_id=<?php echo (int)$truck->truck_id; ?>"><i class="fa fa-fw fa-times"></i></a>
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
        <input type="hidden" name="operation_type" value="alltruck" />
		<input type="hidden" name="view" value="alltruck" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>
  