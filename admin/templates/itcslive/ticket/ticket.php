<?php  
	error_reporting(0); 
	$post=IRequest::get("POST");
	//print_r($this->formdata); exit;
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
       <h1>Tickets</h1>
        <div class="options" align="left">
      </div>
	  <form name="TicketFrm" id="TicketFrm" method="post">
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
			<div class="panel-heading">
				<h4>Tickets Manager</h4>
				<h4>
				<input type="button" name="Delete" value="delete" onclick="Ticket.multipleDelete('TicketFrm')" />
				</h4>
			</div>   
			<div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
						<th>ID</th>
                        <th>Category ID </th>
                        <th>Ticket Content</th>
                        <th>Contact Type</th>
						<th>Created On</th>
						<th>Status</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php  foreach($this->tickets as $ticket): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $ticket->id; ?>]" value="<?php echo $ticket->id; ?>" /></td>
						<td><?php  echo $ticket->id; ?></td>
						<td><?php echo $ticket->category_id; ?></td>						
                        <td><?php
								$position = strpos($ticket->ticket_content,". ",130);
								if((int)$position > 0 && (int)$position < 200):
									echo substr($ticket->ticket_content, 0 , $position);
								else:
									echo substr($ticket->ticket_content, 0 , 130);
								endif;		
							?>
						</td>						
                         <td><?php echo $ticket->contact_type; ?></td>
						<td><?php  echo $ticket->created_on; ?></td>
						<td><button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$ticket->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button>
						</td>
                        <td class="text-right"><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">  
							<input type="button" onclick="Ticket.delete(<?php echo $ticket->id; ?>)" value="Delete Ticket" />
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
		<input type="hidden" name="view" value="ticket" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>