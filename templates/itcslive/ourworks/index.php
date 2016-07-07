<?php
	defined ('ITCS') or die ("Go away.");
	global $Config,$my,$template,$mainframe;
	
?>



<div class="container-fluid pagetop">
	<div class="container ">
		
		<div class="topbordr">
	<ul class="nav nav-tabs panel-heading searchtop ">
					<i class="fa fa-search"></i> Search Your <?php echo $this->type; ?></ul>
				
	
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
										            	<?php $template->VehcleType();?>
										            	<?php //print_r($this->VehcleType);exit;?>
										                									                        	
									                                	<?php $mainframe->selectbox('vehicle_type',$this->VehcleType,select); ?>
										                      	
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
	<?php //print_r($this->Subscriber[0]);exit;?>
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
    <td>
	<?php if($this->type == 'truck'  ){?>
		<?php if($my->uid != '') { if($this->Subscriber[0]->lead_count > 0) {?><a class="btn btn-sm btn-success filter-submit truckavailibilty" href="<?php echo $Config->site."addtruckbid?id=".$work->id; ?>">
		<i class="fa fa-send"></i>&nbsp;Submit Quote</a><?php }else { ?>
			 <a class="btn btn-sm btn-success" href="<?php echo $Config->site."mysubscription"; ?>">
		<i class="fa fa-send"></i>&nbsp;Submit Quote</a> <?php }?>
		<?php } else{ ?><a class="btn btn-sm btn-success filter-submit truckavailibilty" href="<?php echo $Config->site."login"; ?>">
		<i class="fa fa-send"></i>&nbsp;Submit Quote</a><?php }?>
		
	<?php }elseif($this->type == 'load'){ ?>
	<?php if($my->uid != '') { if($this->Subscriber[0]->lead_count > 0) {?><a class="btn btn-sm btn-success filter-submit truckavailibilty" href="<?php echo $Config->site."addloadbid?id=".$work->id; ?>">
	<i class="fa fa-send"></i>&nbsp;Submit Quote</a><?php }else { ?>
			 <a class="btn btn-sm btn-success" href="<?php echo $Config->site."mysubscription"; ?>">
		<i class="fa fa-send"></i>&nbsp;Submit Quote</a> <?php }?>
	
	<?php } else{ ?><a class="btn btn-sm btn-success filter-submit truckavailibilty" href="<?php echo $Config->site."login"; ?>">
		<i class="fa fa-send"></i>&nbsp;Submit Quote</a><?php }}?>
	</td>
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

