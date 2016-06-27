<?php defined ('ITCS') or die ("Go away.");
global $Config,$my;
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
       <h1>Leave Manager</h1>
	   <div class="options extrapad">
		<a onclick='jQuery.colorbox({href:"index.php?view=leavemanager&task=addyearlyLeave", iframe:true, width:"520px", height:"500px", scrolling:false, overlayClose:true, title:"Add Yearly Leave"});' href="javascript:void(0);" style="text-decoration:none;">Add Yearly Leave</a>
      </div>
        <div class="options extrapad">
		<a onclick='jQuery.colorbox({href:"index.php?view=leavemanager&task=addmonthlyLeave", iframe:true, width:"620px", height:"600px", scrolling:false, open:true, overlayClose:true, title:"Update Monthly Leave"});' href="javascript:void(0);" style="text-decoration:none;">Update Monthly Leave</a>
      </div>
	  <form name="LeaveForm" id="LeaveForm" method="post">
      <div class="container ng-scope">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">  
			<div class="panel-heading">
				<h4>Leave Manager</h4> &nbsp;
				<span><input type="text" placeholder="Search by Name" name="filter_name" id="filter_name" value="<?php echo $this->filter_name; ?>"></span>
				<span><input type="text" placeholder="Search By date" name="filter_date" id="filter_date" value="<?php echo $this->filter_date; ?>"></span>
				<input type="submit" value="Go" />
				<input type="hidden" name="view" value="leavemanager"/>
			</div> 
			<div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th>Name </th>
						<th>Month</th>
						<th>Year</th>
                        <th>Leave</th>
						<th>Paid Leave</th>
						<th class="text-right">Option</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					<?php foreach($this->LeaveList as $list): ?>
					<tr>
					<td><?php echo $list->name; ?></td>
					<td><?php echo $list->month; ?></td>
					<td><?php echo $list->year ?></td>
					<td><?php echo $list->leave_deduct; ?></td>
					<td><?php echo $list->no_of_paid_leave; ?></td>
					<td class="text-right">
					<div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
						<a onclick='jQuery.colorbox({href:"index.php?view=leavemanager&task=editLeaveRecord&record_id=<?php echo (int)$list->id; ?>", iframe:true, width:"620px", height:"600px", scrolling:false, open:true, overlayClose:true, title:"Update Leave Record"});' href="javascript:void(0);" style="text-decoration:none;"><i class="fa fa-fw fa-pencil"></i></a>
						</span>
                    </div>
					</td>
					</tr>
					<?php endforeach; ?>
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
		</form>
		<div class="clear"></div>
       </div> 
      <!-- container -->
    </div> 
    <!--wrap -->
  </div> 
  <!-- page-content -->
  <div class="clear"></div>
<style>
.extrapad{ padding:10px;}
</style>