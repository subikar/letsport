<?php  global $Config,$my;  ?>
<h4>Time Tracking</h4>
<div class="attendencediv fa-left"> Search By Projects : <input style="background:#fff;" type="text" name="project" id="text_project" onchange="Calendar.dafaultevent();"/>
</div>	
<?php if(strtolower($my->usertype)!="customer"): ?>		
<?php if(strtolower($my->usertype) =="employee"){  ?>
<div class="attendencediv fa-right">
Search By Users : <input type="text" style="background:#fff;" name="user" id="text_user" readonly="true" value="<?php echo $my->name; ?>"/>
</div>
<?php } else{ ?>
<div class="attendencediv fa-right">
Search By Users : <input type="text" style="background:#fff;" name="user" id="text_user" onchange="Calendar.dafaultevent();"/>
</div>
<?php } endif; ?>
<div class="clear"></div>
<br clear="all" />
<div class="prev_next_btns fa-right">
<input type="button" name="prev" id="my-prev-button" value="<" />
<input type="button" name="next" id="my-next-button" value=">" />
</div>
<div id='calendar'></div>
<div id='total_task'>
	 <p><strong>Monthly Total: </strong><span id="total_taskhour"></span></p>
	<table style="border:1px solid #FFFFFF; width:100%; text-align:center">
		<thead>
			<th>Task Name</th>
			<th>User</th>
			<th>Total Time</th>
		</thead>
		<tbody id="task_details">
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
		var project_id = document.getElementById("text_project").value;
		var formURL = "project?view=project&task=getDefaultTaskDetails"; 
		jQuery.post(formURL,{user_id:user_id,project_id:project_id,month:thisMonth},
		function(data){	
			var result = jQuery.parseJSON(data);
			monthlyData["hours"]=result.total_hour;
			monthlyData["detailsHtml"]=result.total_details;
			var projects = result.defaults;
			for(var i=0; i<projects.length; i++)
			{
				myevents.push({
                	title: projects[i].name+'\n'+projects[i].task_name+'\n'+projects[i].task_hour+'hr\nPoint : '+projects[i].point,
                    start: projects[i].create_date
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
	this.CalculateHour=function()
	{
		if(monthlyData["detailsHtml"] !=null)
		{
			jQuery("#task_details").html(monthlyData["detailsHtml"]);
			jQuery("#total_taskhour").html(monthlyData["hours"]+" hrs.");
		}
		else
		{
			jQuery("#task_details").html("<tr><td colspan='3'>No Task Found!!</td></tr>");
			jQuery("#total_taskhour").html("0 hrs");
		}
	}
	this.userevent=function(id)
	{
		var user_id = id;
		if(parseInt(user_id) > 0)
		{
			var formURL = "project?view=project&task=getEmployeeName"; 
			jQuery.post(formURL,{user_id:user_id},
			function(data){	
				var result = jQuery.parseJSON(data);
				if(jQuery('#text_user').attr('id')){
					jQuery("#text_user").kendoComboBox({
						dataTextField: "text",
						dataValueField: "value",
						value: result.value,
						text: result.text
					});
				}
			});
		}
		Calendar.dafaultevent(user_id);
	}
}
	jQuery(document).ready(function() {	
		jQuery("#text_project").kendoComboBox({
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
							url: "project?view=project&task=getProject_fromAjax",
							method: "post"
						}
					}
				}
		});
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