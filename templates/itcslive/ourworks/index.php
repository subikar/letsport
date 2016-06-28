<?php
	defined ('ITCS') or die ("Go away.");
	global $Config;
?>
please write html here



<div class="container">
<div class="panel panel-orange">
<div class="panel-body tab-pane "> 
						<form method="POST">
							<div class="row" style="margin-left:0px;margin-right:0px;">
								<div class="col-md-3" style="padding-bottom: 5px;">
									<input placeholder="Enter From Location" value="" name="from_location" id="from_location" type="text" class="form-control" autocomplete="off">
									<input type="hidden" name="from_lat" id="load_from_lat" value="">
									<input type="hidden" name="from_lng" id="load_from_lng" value="">
								</div>
								<div class="col-md-3" style="padding-bottom: 5px;">
									<input placeholder="Enter To Location" value="" name="to_location" id="to_location" type="text" class="form-control" autocomplete="off">
									<input type="hidden" name="to_lat" id="load_to_lat" value="">
									<input type="hidden" name="to_lng" id="load_to_lng" value="">
								</div>					
								<div class="col-md-3" style="padding-bottom: 5px;">
									<div class="input-group">
										<input type="text" name="fromavailability_date" value="" style="background-color:white" id="fromavailability_date" placeholder="From Date" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     </div>
								</div>
								<div class="col-md-3" style="padding-bottom: 5px;">
									<div class="input-group">
										<input type="text" name="toavailability_date" value="" style="background-color:white" id="toavailability_date" placeholder="To Date" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     </div>
                                    	
								</div>								
							</div>
							<div class="row" style="margin-left:0px;margin-right:0px;">
								<div class="col-md-3">
									<input type="button" name="btnsearch" id="btnsearch" class="btn btn-success" value="Search">
									<input type="button" id="go" value="Reset"  class="btn btn-success">
								</div>
								<div class="col-md-9"> 
								</div>
							</div>
					</form>
					</div>
			</div>
<div class="tip">			
<table style="width:100%">
<?php foreach($this->workList as $work): ?>	
  <tr>
    <td>From</td>
    <td>To</td> 
    <td>Available For</td>
    <td>Reporting Time</td>
  </tr>
<tr><td><b><?php echo $work->start_location?></b></td><td><b><?php echo $work->end_location?></b></td><td><b><?php echo $work->avaliable_date?></b></td><td><b><?php echo $work->reporting_time?></b></td></td>

  <tr>
    <td>Vehicle Type</td>
    <td>Material Type</td> 
    <td>Consignment Weight(MT)</td>
    <td>Post ID</td>
  </tr>
<tr><td><b><?php echo $work->vehicle_type?></b></td><td><b><?php echo $work->material_type?></b></td><td><b><?php echo $work->consignment_weight?></b></td><td><b>PL<?php echo $work->id?></b></td></tr>

  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td><button type="button" name="btn" class="btn btn-sm btn-success filter-submit"   value=""  style="width:130px;">
	<i class="fa fa-send"></i>&nbsp;Submit Quote
</button></td>
  </tr>  
  <?php endforeach; ?>
</table>	
</div>
			</div>