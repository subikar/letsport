<?php
	defined ('ITCS') or die ("Go away.");
	global $Config;
	$post = IRequest::get('POST');
?>



<div class="container-fluid pagetop">
	<div class="container ">
		
		<div class="topbordr">
	<ul class="nav nav-tabs panel-heading searchtop ">
					<i class="fa fa-search"></i> Search Your <?php echo $post[optn] ;?></ul>
				
	
<div class="panel panel-orange">
<div class="panel-body tab-pane "> 
						<?php includemodule('contentsearch'); ?>
					</div>
			</div>
			
			
			<div class="row">
				
									
										<div class="container-fluid">
											<div class="midilser">
									    	<div class="navbar-header">
										        <button type="button" class="navbar-toggle collapsed filter-toggle-icon" data-toggle="collapse" data-target="#main-nav-search">
										          <b>Filters</b> <i class="text-success fa fa-filter"></i>
										        </button>
									        	
									            	
												
									      	</div>
									    	<div class="" id="main-nav-search">				
									    		<ul class=" navbar-nav navbar-left" style="padding-top: 5px;">
									    		<!-- Category Filter -->
										       	<li class="dropdown filters">
										          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										          		<span style="padding-top:0px;"><i class="text-success fa fa-filter fa-2x"></i>Vehicle Types</span> <i class="fa fa-angle-down fa-2x"></i>
										            </a>
										            <div class="dropdown-menu" style="width:370px;max-width:600px;">
										            <form class="ng-pristine ng-valid" style="margin-left:5px;">
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="1" class="search-filters"> Trailer									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="2" class="search-filters"> Tipper									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="3" class="search-filters"> Container									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="4" class="search-filters"> Tractor									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="5" class="search-filters"> Pick-up									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="6" class="search-filters"> Tempo									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="7" class="search-filters"> Refrigerated									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="8" class="search-filters"> Tanker									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="9" class="search-filters"> Flatbed									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="10" class="search-filters"> 6 Wheel Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="11" class="search-filters"> 10 Wheel Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="12" class="search-filters"> 12 Wheel Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="13" class="search-filters"> 20 Ft Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="14" class="search-filters"> 24 Ft Single-Axle Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="15" class="search-filters"> 24 Ft Multi-Axle Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="16" class="search-filters"> 32 Ft Single-Axle Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="17" class="search-filters"> 32 Ft Multi-Axle Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="18" class="search-filters"> Other Container Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="19" class="search-filters"> 14 Wheel Truck									                               	</div>
										                      	</div>
										                									                        	<div class="form-group filter-items col-lg-6">
										                        	<div class="input-group">
									                                	<input type="checkbox" name="vehiclecheckbox" value="20" class="search-filters"> 19 Ft Open Body Truck									                               	</div>
										                      	</div>
										                										            </form>
										            </div>
										       	</li>
									          <!-- // END Category -->
									      		
												<li class="">
										            
										            	<i class="text-success fa fa-sort fa-2x"></i>
													
										        </li>
										        <li class="filters sort-field-dropdown">
										            <a href="#" class="adate-button">
					                                	<i class="fa fa-sort-amount-asc"></i> Availability Date
					                                </a>
					                           	</li>
										        <li class="filters sort-field-dropdown">
					                                <a href="#" id='mylink' class="cweight-button">
					                                  	<i class="fa fa-sort-amount-asc"></i> Consignment Weight
					                                </a>
										    	</li>
									            <li class="reset-icon">
									                <a href="<?php echo $this->site->leaderboad; ?>">
									                         <i class="fa fa-refresh"></i> Reset
									                </a>
									            </li>
									      	</ul>
									    </div>
									</div></div>
									</div>
			
			
			
			
			
<div class="tip" style="">			
<table style="width:100%; ">
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
    <td><button type="button" name="btn" class="btn btn-sm btn-success filter-submit"   value=""  style="width:130px;margin-bottom: 11px;">
	<i class="fa fa-send"></i>&nbsp;Submit Quote
</button></td>
  </tr>  
  <tr class="bordershadow">
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
  </tr> 
 
  <?php endforeach; ?>
</table>

</div>

</div>
</div>

			</div>

<script type="text/javascript">
var myLink = document.getElementById('mylink');

myLink.onclick = function(){
	window.location.href="leaderboard";
alert("inside");

}


</script>