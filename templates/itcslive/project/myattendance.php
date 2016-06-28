<?php  global $Config,$my;  ?>
 <?php if(strtolower($my->usertype)=="admin"): ?>		
<div class="attendencediv">
Find User Attendence : <input type="text" style="background:#fff;" name="user" id="text_user" onchange="Calendar.dafaultevent();"/>
</div>
<?php endif; ?>

<div class="prev_next_btns fa-right">
<input type="button" name="prev" id="my-prev-button" value="< Previous" />
<input type="button" name="next" id="my-next-button" value="Next >" />
</div>
<div id='calendar'></div>
<div id='total_attendance'>
<table style="border:1px solid #FFFFFF; width:100%; text-align:center">
        <thead>
            <th>User Name</th>
            <th>Total Attendance</th>
        </thead>
        <tbody id="attendance_details">
        </tbody>
    </table>    
</div>
<div class="clear"></div>

<link href='<?php echo $Config->site; ?>templates/itcslive/js/calendar/fullcalendar.css' rel='stylesheet' />
<script src='<?php echo $Config->site; ?>templates/itcslive/js/calendar/moment.min.js'></script>
<script src='<?php echo $Config->site; ?>templates/itcslive/js/calendar/fullcalendar.min.js'></script>
<script>	
var Calendar=new function()
{
	var monthlyData=new Array();
	this.dafaultevent = function(uid)
	{
		uid = uid || null;
		var myevents = new Array();
		var user_id = 0;
		if(jQuery('#text_user').attr('id')){
			if(uid == null)
			{
				user_id = document.getElementById("text_user").value;
			}
			else
			{
				user_id = uid;
			}
		}
		var moment = jQuery('#calendar').fullCalendar('getDate');
		var Caldate = new Date(moment);
		var thisMonth = parseInt(Caldate.getMonth()+1);
		var formURL = "project?view=project&task=getDefaultAttendanceDetails"; 
		jQuery.post(formURL,{user_id:user_id,month:thisMonth},
		function(data){
		//alert(data); 
			var result = jQuery.parseJSON(data);
			monthlyData["days"]=result.total_day;	
			var attendance = result.defaultsattendance;
			var breaktime = result.defaultsbreaktime;
			for(var i=0; i<attendance.length; i++)
			{
				if(attendance[i].reason == '' && attendance[i].inhour != 0)
				{
					myevents.push({
						title: attendance[i].name+'\nAttendance In: \n'+attendance[i].inhour+':'+attendance[i].inminute+'\nAttendance Out: \n'+attendance[i].outhour+':'+attendance[i].outminute,
						start: attendance[i].today
					});
				}
				else if(attendance[i].inhour == 0)
				{
					myevents.push({
						title: attendance[i].name+'\nReason: \n'+attendance[i].reason,
						start: attendance[i].today
					});
				}
				else
				{
					myevents.push({
						title: attendance[i].name+'\nAttendance In: \n'+attendance[i].inhour+':'+attendance[i].inminute+'\nAttendance Out: \n'+attendance[i].outhour+':'+attendance[i].outminute+'\nReason: \n'+attendance[i].reason,
						start: attendance[i].today
					});
				}
			}
			for(var i=0; i<breaktime.length; i++)
			{
				myevents.push({
                	title: breaktime[i].name+'\nBreak Start: '+breaktime[i].starthour+':'+breaktime[i].startminute+'\nBreak Stop: '+breaktime[i].stophour+':'+breaktime[i].stopminute+'\nBreak Difference \n:'+breaktime[i].break_diff,
                    start: breaktime[i].break_start
                });
			}
			jQuery('#calendar').fullCalendar('removeEvents');
            jQuery('#calendar').fullCalendar('addEventSource', myevents);
			jQuery("#calendar").fullCalendar(
			{
				header: {
				right: '',
				center: 'title',
				left: ''
				},
				editable: false,
				eventLimit: 2,
				events: myevents
			});
			Calendar.CalculateHour();
		});
	}
	this.CalculateHour = function()
	{
		//alert(monthlyData["days"]); return false;
		if(monthlyData["days"]!=null)
		{
			jQuery("#attendance_details").html(monthlyData["days"]);
		}
		else
		{
			jQuery("#attendance_details").html("<tr><td colspan='2'>No Attendance Found!!</td></tr>");
		}
	}
	this.userevent=function(id)
	{
		var user_id = id;
		Calendar.dafaultevent(user_id);
	}
}
	jQuery(document).ready(function() {	
		if(jQuery('#text_user').attr('id')){
			jQuery("#text_user").kendoComboBox({		
				dataTextField: "text",
				dataValueField: "value",
				filter: "contains",
				minLength: 2,
				dataSource: {
					type: "json",
					serverFiltering: true,
					transport: {
						read: {
							dataType: "json",
							url: "project?view=project&task=getUser_fromAjax",
							method: "post"
						}
					}
				}
			});
		}
		jQuery('#my-next-button').click(function() {
			jQuery('#calendar').fullCalendar('next');
			Calendar.dafaultevent();
			Calendar.CalculateHour();
		});
		jQuery('#my-prev-button').click(function() {
			jQuery('#calendar').fullCalendar('prev');
			Calendar.dafaultevent();
			Calendar.CalculateHour();
		});
		Calendar.dafaultevent();
	});
</script>