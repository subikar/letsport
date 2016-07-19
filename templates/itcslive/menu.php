<?php defined ('ITCS') or die ("Go away.");
  global $Config; 
  if($this->MenuID=="user-menu" || $this->MenuID=="top-menu"):
  $ulClass="sf-menu"; $ulID="";
  else:
  $ulID="menu-".$this->MenuID;
  $ulClass="list";
  endif;
  
	$current_url=trim($this->curPageURL());
?>		  
	  <ul class="<?php echo $ulClass; ?>" id="<?php echo $ulID; ?>">
	  <?php foreach($this->MenuInArray as $Menu):   $activeClass=(strcasecmp(trim($Config->site.$Menu->alias),$current_url)==0) ? "sfHover" : ""; ?>
	  <li class="<?php echo $activeClass; ?> dropdown">
	  <a href="<?php echo $Config->site.$Menu->alias; ?>"><?php echo $Menu->title?></a>
	  	<?php if(count($Menu->submenu) > 0): ?>
		<ul class="dropdown-content">
		<?php foreach($Menu->submenu as $Submenu): ?>
		 <li >
		 <?php if($Submenu->title == 'Submit Truck' || $Submenu->title == 'Submit Load') {?>	
	  	<a class="truckavailibilty" href="<?php echo $Config->site.$Submenu->alias; ?>"><?php echo $Submenu->title?></a>
	  	<?php }
  		else { ?>
	  	<a href="<?php echo $Config->site.$Submenu->alias; ?>"><?php echo $Submenu->title?></a>
	  	<?php } ?>
	  	
	  	</li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	  </li>
	<?php endforeach; ?> 
	</ul>
	<?php

?>