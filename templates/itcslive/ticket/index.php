<?php
defined ('ITCS') or die ("Go away.");
global $Config,$my;
?>
<div class="container-fluid">
     	<div class="row">
		<h2>Welcome <?php echo $my->name; ?>!</h2>
			<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="col-xs-11 col-sm-11 col-md-11 padDiv">
			<h2 class="boiteHeader">Dashboard <span class="right"><a  href="<?php echo $Config->site."edituser" ?>" class="truckavailibilty" title="Update Details"><span class="fa fa-fw fa-user"></span>Modify</a> </span></h2>	
				<?php if($my->Company!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->Company; ?></div>
				<?php endif; ?>
				<div class="defaultBoxLine"><?php echo $my->name; ?></div>
				<div class="defaultBoxLine"><?php echo $my->email; ?></div>
				<?php if($my->address!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->address; ?></div>
				<?php endif; ?>
				<?php if($my->city!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->city; ?></div>
				<?php endif; ?>
				<?php if($my->country!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->country; ?></div>
				<?php endif; ?>
				<?php if($my->postal!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->postal; ?></div>
				<?php endif; ?>
				<?php if($my->phone!=''): ?>
				<div class="defaultBoxLine"><?php echo $my->phone; ?></div>
				<?php endif; ?>
				<?php if($my->avatar!=''): ?>
				<div class="defaultBoxLine">
				<div class="image_avatar"><img src="<?php echo $Config->site.$my->thumb; ?>" style="height:100px; width:100px;" align="right"  /></div></div>
				<?php endif; ?>
                <a href="<?php echo $Config->site."changepassword" ?>" class="change_password" title="Change Password"><span class="fa fa-fw fa-user"></span>Change Password</a>
			</div>	
			 </div>
		
			<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="col-xs-11 col-sm-11 col-md-11 padDiv">
			 <h2 class="boiteHeader">My Truck <span class="right"><a  href="<?php echo $Config->site."addtruck" ?>" class="truckavailibilty" title="Add Truck"><span class="fa fa-fw fa-truck"></span>Add Truck</a> </span></h2>
			 <div class="col-xs-12"><div class="col-xs-12 col-sm-4 col-md-4">Truck No</div><div class="col-xs-12 col-sm-4 col-md-4">Status</div><div class="col-xs-12 col-sm-4 col-md-4">Action</div></div>
			 <?php 
			 //print_r($this->Trucks); exit;
			 foreach($this->Trucks as $Truck):?>
			 <div class="col-xs-12"><div class="col-xs-12 col-sm-4 col-md-4"><?php echo $Truck->truck_no?></div><div class="col-xs-12 col-sm-4 col-md-4"><?php echo ($Truck->status == 0)?'<span class="cross"><i class="fa fa-times" aria-hidden="true"></i>
</span>':'<span class="tick"><i class="fa fa-check" aria-hidden="true"></i></span>';?></div><div class="col-xs-12 col-sm-4 col-md-4"><a  href="<?php echo $Config->site."addtruck?id=".$Truck->truck_id; ?>" class="truckavailibilty" title="Modify Truck">Modify</a></div></div>
			 <?php endforeach; ?>
			</div> 
			</div>


			<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="col-xs-11 col-sm-11 col-md-11 padDiv">
			 <h2 class="boiteHeader">My Drivers <span class="right"><a  href="<?php echo $Config->site."adddriver" ?>" class="truckavailibilty" title="Add Truck"><span class="fa fa-fw fa-truck"></span>Add Driver</a> </span></h2>
			 <div class="col-xs-12"><div class="col-xs-12 col-sm-4 col-md-4">Driver Name</div><div class="col-xs-12 col-sm-4 col-md-4">Status</div><div class="col-xs-12 col-sm-4 col-md-4">Action</div></div>
			 <?php foreach($this->Drivers as $Driver):?>
			 <div class="col-xs-12"><div class="col-xs-12 col-sm-4 col-md-4"><?php echo $Driver->name?></div><div class="col-xs-12 col-sm-4 col-md-4"><?php echo ($Driver->status == 0)?'<span class="cross"><i class="fa fa-times" aria-hidden="true"></i>
</span>':'<span class="tick"><i class="fa fa-check" aria-hidden="true"></i></span>';?></div><div class="col-xs-12 col-sm-4 col-md-4"><a  href="<?php echo $Config->site."adddriver?id=".$Driver->driver_id; ?>" class="truckavailibilty" title="Modify Truck">Modify</a></div></div>
			 <?php endforeach; ?>
			</div> 
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-12 col-sm-12 col-md-12 padDiv">
			 <?php if($this->TrucksAvailable[0]->operation_type=='truck'): ?>
			 <h2 class="boiteHeader">My Truck Listing <span class="right"><a  href="<?php echo $Config->site."add-truck-available" ?>" class="truckavailibilty" title="Add Truck"><span class="fa fa-fw fa-truck"></span>Add Truck Availability</a> </span></h2>
			 <div class="col-xs-12">
			 <div class="col-xs-12 col-sm-2 col-md-2">Start Date Time</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Location</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Vehicle Type</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Material Type</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Consignment Weight</div>
			 <div class="col-xs-12 col-sm-2 col-md-1">Bids Recieved</div>
			 <div class="col-xs-12 col-sm-2 col-md-1">Close</div>
			 </div>
			<?php //print_r($this->TrucksAvailable);exit; ?>
			
			 <?php foreach($this->TrucksAvailable as $Available):?>
				
					 <div class="col-xs-12">
					 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo date('d M Y',strtotime($Available->avaliable_date))?> <?php echo $Available->reporting_time; ?></div>
					 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->start_location?> <?php echo $Available->end_location; ?></div>
					 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->vehicle_type; ?></div>
					 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->material_type; ?></div>
					 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->consignment_weight; ?></div>
					 <div class="col-xs-12 col-sm-2 col-md-1"><a  href="<?php echo $Config->site."bidstruck?id=".$Available->id; ?>" class="truckavailibilty" title="Modify Truck">Bids</a></div>
					 <div class="col-xs-12 col-sm-2 col-md-1"><a  href="<?php echo $Config->site."closetruck?id=".$Available->id; ?>" class="truckavailibilty" title="Modify Truck">close</a></div>
					 </div>
				
		 <?php endforeach; ?>
			<?php endif; ?>
			</div> 
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-12 col-sm-12 col-md-12 padDiv">
				 <?php if($this->LoadAvailable[0]->operation_type=='load'): ?>
			 <h2 class="boiteHeader">My Load Listing <span class="right"><a  href="<?php echo $Config->site."add-truck-available" ?>" class="truckavailibilty" title="Add Truck"><span class="fa fa-fw fa-truck"></span>Add Load</a> </span></h2>
			 <div class="col-xs-12">
			 <div class="col-xs-12 col-sm-2 col-md-2">Start Date Time</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Location</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Vehicle Type</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Material Type</div>
			 <div class="col-xs-12 col-sm-2 col-md-2">Consignment Weight</div>
			 <div class="col-xs-12 col-sm-2 col-md-1">Bids Recieved</div>
			 <div class="col-xs-12 col-sm-2 col-md-1">Close</div>
			 </div>
			 <?php //print_r($this->LoadAvailable);exit; ?>
		<?php foreach($this->LoadAvailable as $Available):?>
		   
			 <div class="col-xs-12">
			 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo date('d M Y',strtotime($Available->avaliable_date))?> <?php echo $Available->reporting_time; ?></div>
			 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->start_location?> <?php echo $Available->end_location; ?></div>
			 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->vehicle_type; ?></div>
			 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->material_type; ?></div>
			 <div class="col-xs-12 col-sm-2 col-md-2"><?php echo $Available->consignment_weight; ?></div>
			 <div class="col-xs-12 col-sm-2 col-md-1"><a  href="<?php echo $Config->site."bidsload?id=".$Available->id; ?>" class="truckavailibilty" title="Modify Truck">Bids</a></div>
			 <div class="col-xs-12 col-sm-2 col-md-1"><a  href="<?php echo $Config->site."closeload?id=".$Available->id; ?>" class="truckavailibilty" title="Modify Truck">close</a></div>
			 </div>
		  
		 <?php endforeach; ?>
			 <?php endif; ?>
			</div> 
			</div>
			

		</div>
</div>