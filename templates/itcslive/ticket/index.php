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
			</div> 
			</div>

		</div>
</div>