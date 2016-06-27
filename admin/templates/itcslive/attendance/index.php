<?php defined ('ITCS') or die ("Go away.");
global $Config,$my;
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
       <h1>Attendance</h1>
        <div class="options">
      </div>
	  <form name="AttendanceForm" id="AttendanceForm" method="post">
      <div class="container ng-scope">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">  
			<div class="panel-heading">
				<h4>Attendance Manager</h4> &nbsp;
				<span><input type="text" placeholder="Search by Name" name="filter_name" id="filter_name" value="<?php echo $this->filter_name; ?>"></span>
				<span><input type="text" placeholder="Search By date" name="filter_date" id="filter_date" value="<?php echo $this->filter_date; ?>"></span>
				<input type="submit" value="Go" />
				<input type="hidden" name="view" value="attendance"/>
			</div>      
			<div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
						<th>Day</th>
                        <th>Name </th>
						<th>Date</th>
                        <th>In Time</th>
                        <th>Out Time</th>
						<th>Reason For Late</th>
						<th>Ip</th>
						<th>Time Zone</th>
						<th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					  <?php  foreach($this->AttendanceList as $attendance):  
					  $day = date('l', strtotime($attendance->today)); 
					  if($day == "Sunday"){ $bgcolor='#FF99CC' ;}
					  elseif($attendance->attendance_in=="0000-00-00 00:00:00" || $attendance->attendance_in==""){ $bgcolor='#00CC66' ;}
					  else {$bgcolor="" ;}
					  ?>   
                      <tr class="ng-scope" bgcolor="<?php echo $bgcolor; ?>" > 
						<td><?php  echo $day; ?></td>
						<td><strong><?php echo $attendance->name; ?></strong></td>
						<td><?php echo $attendance->today; ?></td>	
                        <td><?php echo $attendance->attendance_in; ?></td>						
                        <td><?php echo $attendance->attendance_out; ?></td>
						<td><?php echo $attendance->reason; ?></td>
						<td><?php  echo $attendance->ip; ?></td>
						<td><?php  echo $attendance->timezone; ?></td>
						<td class="text-right"><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=attendance&task=editattendance&attendance_id=<?php echo (int)$attendance->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                          </div></td>
                      </tr>
					<?php  foreach($this->BreakList as $eachBreak): 
								$breakdate=date("Y-m-d",strtotime($eachBreak->break_start));
								if($attendance->user_id == $eachBreak->user_id  && $breakdate == $attendance->today):?>
									<tr class="ng-scope">
										<td colspan="9">
										<div class="all_break">
										<div class="each_break">Break-in: <?php echo $eachBreak->break_start;?></div>
										<div class="each_break">Break-Out: <?php echo $eachBreak->break_stop; ?></div>
										<div class="each_break">Total Time: <?php echo $eachBreak->break_diff; ?></div>
										</div>
										</td>
									</tr>
								<?php endif;?>
						<?php  endforeach; ?> 
					  
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
		</form>
		<div class="clear"></div>
       </div> 
      <!-- container -->
    </div> 
    <!--wrap -->
  </div> 
  <!-- page-content -->
  <div class="clear"></div>
  <style>.each_break{ float:left; width:25%; padding:3px;}</style>