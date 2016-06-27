var Attendance=new function()
{
	this.date_time=function(id)
	{
			date = new Date;
			year = date.getFullYear();
			month = date.getMonth();
			months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
			d = date.getDate();
			day = date.getDay();
			days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			h = date.getHours();
			if(h<10)
			{
					h = "0"+h;
			}
			m = date.getMinutes();
			if(m<10)
			{
					m = "0"+m;
			}
			s = date.getSeconds();
			if(s<10)
			{
					s = "0"+s;
			}
			result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
			document.getElementById(id).innerHTML = result;
			setTimeout('Attendance.date_time("'+id+'");','1000');
			return true;
	}
	this.getDateFormat=function()
	{
		 var now = new Date();
		 var year = "" + now.getFullYear();
		 var month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
		 var day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
		 var hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
		 var minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
		 var second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
		 return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
	}
	this.validateAttendance=function(input_id)
	{
		var i;
		var input=document.getElementById(input_id);
		var eduInput = document.getElementsByName('leave_reason[]');
		for (i=0; i < eduInput.length; i++)
		{
			if (eduInput[i].value == "")
			{
			 alert('Please fillup all the fields');		 
			 return false;
			}
		}
		if(eduInput.length==i)
		{
			var formURL="user?view=user&task=validateLocalDateFromAjax";
			jQuery.post(formURL,{ localdate:input.attendance_time.value},
				function(data){
					var response=JSON.parse(data,true);
					if(parseInt(response["status"])==1){ /*alert(response["message"]);*/  input.submit(); } else { alert(response["message"]); }
				}).fail(function(data,status,message) {
					alert(message); 
				});
		}
	}
	this.validateAttendanceOut=function(input_id)
	{
		var input=document.getElementById(input_id);
			var formURL="user?view=user&task=validateLocalDateFromAjax";
			jQuery.post(formURL,{ localdate:input.attendance_time.value},
				function(data){
					var response=JSON.parse(data,true);
					if(parseInt(response["status"])==1){ /*alert(response["message"]);*/  input.submit(); } else { alert(response["message"]); }
				}).fail(function(data,status,message) {
					alert(message); 
				});
		
	}
}
jQuery(document).ready(function() {		
								
	Attendance.date_time('date_time');		
	var timezone = jstz.determine(); 
	jQuery("#time_zone").val(timezone.name());
	jQuery("#attendance_time").val(Attendance.getDateFormat());
});