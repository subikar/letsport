<?php
	global $my,$Config;
?>

<div class="clock"><script src="<?php echo $Config->site; ?>templates/itcslive/js/clock/clock.js"></script></div>
<div class="total_area">
   <div class="break_list">
   		<?php  $startedBreak= false; $b_start = NULL; ?>
   		<?php if(!empty($this->breakDetails)): ?>
		<?php $count=1; $breakList = $this->breakDetails; ?>
		
		<ul>
			<li>Serial</li>
			<li>Break Start</li>
			<li>Break Stop</li>
			<?php foreach($breakList as $break):?>
			<?php //if($break->break_stop == "0000-00-00 00:00:00") 
					if(is_null($break->break_stop)){
							$startedBreak = true;
							$b_start = $break->break_start;
					}
			?>
			
			<li><?php echo $count++; ?></li>
			<li><?php echo $break->break_start; ?></li>
			<li><?php echo $break->break_stop; ?></li>
			<?php endforeach; ?>
			<?php endif; ?>
			
			<li>
				<form method="post" name="breakForm" id="breakForm" >
					<input type="hidden" name="view" value="user" />
					<input type="hidden" name="task" value="recordBreak" />
					<input type="hidden" name="user_id" value="<?php echo $my->uid; ?>" />
					
					<?php if($startedBreak): ?>
					<input type="hidden" name="b_start" value="<?php echo $b_start; ?>" />
					<input type="hidden" name="break_status" value="2" />
					<p><input type="submit" value="Stop Break" /></p>
					<?php else: ?>
					<input type="hidden" name="break_status" value="1" />
					<input type="submit" class="start_break" value="Start Break" />
					<?php endif; ?>
				</form>
			</li>
		</ul>
		
   		<!--table here-->
   </div>
   <div class="form_area">
   		
   </div>
  
</div>