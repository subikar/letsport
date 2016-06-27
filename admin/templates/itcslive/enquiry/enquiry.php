<?php  
	error_reporting(0); 
	$post=IRequest::get("POST");
	//print_r($this->formdata); exit;
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
       <h1>Enquiry</h1>
        <div class="options">
      </div>
	  <form name="EnqueryFrm" id="TicketFrm" method="post">
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">  
			<div class="panel-heading">
				<h4>Enquiry Manager</h4>
				<h4><input type="button" name="Delete" value="delete" onclick="Enquery.multipleDelete('EnqueryFrm')" /></h4>
			</div>    
			<br clear="all" />  
			<div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
						<th>ID</th>
                        <th>Name </th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Available Date</th>
                        <th>Vehcle Type</th>
						<th>Submitted On</th>
						<th>Status</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php  foreach($this->formdata as $ticket): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $ticket->id; ?>]" value="<?php echo $ticket->id; ?>" /></td>
						<td><?php  echo $ticket->id; ?></td>
						<td><?php echo $ticket->form_data['name']; ?></td>
                         <td><?php echo $ticket->form_data['phone']; ?></td>						
                        <td><?php echo $ticket->form_data['from_location']; ?> - <?php echo $ticket->form_data['to_location']; ?></td>
                        <td><?php echo $ticket->form_data['availability_date']; ?></td>
                        <td><?php echo $ticket->form_data['vehicle_type_id']; ?></td>
						<td><?php  echo $ticket->form_submitted_on; ?></td>
						<td><button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$ticket->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button></td>
                        <td class="text-right"><div class="btn-group">
							<input type="button" onclick="Enquery.delete(<?php echo $ticket->id; ?>)" value="Delete Enquiry" /> 
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
		<input type="hidden" name="view" value="enquiry" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>