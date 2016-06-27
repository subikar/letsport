<?php
	global $my,$Config;
?>
<script src="<?php echo $Config->site; ?>templates/itcslive/js/timezone/jstz-1.0.4.min.js" ></script>
<script src="<?php echo $Config->site; ?>templates/itcslive/js/attendance.js"></script>
<div class="clock"><script src="<?php echo $Config->site; ?>templates/itcslive/js/clock/clock.js"></script></div>
<div class="total_area">
   <div class="clock_area">
	<p align="center"><strong>Date and Time: </strong><span id="date_time"></span></p>  
   </div>
   <div class="form_area" align="center">
      <form method="post" name="attendanceForm" id="attendanceForm" >
         <input type="hidden" name="view" value="user" />
         <input type="hidden" name="task" value="addAttendance" />
         <input type="hidden" name="user_id" value="<?php echo $my->uid; ?>" />
		  <?php if((int)$this->attendance == 2): ?>
		  <input type="hidden" name="attendance_type" value="2" />
		  <input type="hidden" name="attendance_time" id="attendance_time" value="" />
		  <input type="button" class="clock_area_button"  name="Attendence" value="Make Attendance Out" onclick="Attendance.validateAttendanceOut('attendanceForm');" />
         <?php else: 
		 if(count($this->absentDays) > 0){  ?>
		 <div class="absent_area">
		<h5>Reason For absent: </h5>
		<?php for($i=0;$i<count($this->absentDays); $i++): ?>
			<div class="each_absent"><?php echo $this->absentDays[$i]; ?> : <textarea name="leave_reason[]" required="true"></textarea></div>
			<input type="hidden" name="leave_days[]" value="<?php echo $this->absentDays[$i]; ?>" />
		<?php endfor; ?>
		</div>
		<?php } ?>
        <p> Reason (if you are late): </p>
         <textarea name="reason" id="reason" ></textarea>
		 <input type="hidden" name="time_zone" id="time_zone" value="" />
		 <input type="hidden" name="attendance_time" id="attendance_time" value="" />
		 <input type="hidden" name="attendance_type" value="1" />
		 <p align="center"><input type="button" class="clock_area_button" value="Attendance In" name="Click" onclick="Attendance.validateAttendance('attendanceForm');" /></p>
		 <?php endif; ?>
      </form>
   </div>
</div>
<!--<script type="text/javascript">
jQuery(document).ready(function(){
parent.jQuery.colorbox.resize({width:"60%", height:"90%"});
});
</script>-->

<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"500px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"500px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"500px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"500px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"500px"});
		}
});
</script>