<?php  global $Config,$my; 
//print_r($this->projects); exit;?>
<h4>Time Tracking</h4>
Projects : <select name="text_user" id="text_user" onchange="Calendar.calendarevent(this);">
			<option>Select Project</option>
			<?php   foreach( $this->projects as $project): ?>
			<option value="<?php  echo $project->id; ?>"><?php  echo $project->project_name; ?></option>
			<?php  endforeach; ?>
			</select>

<div id='calendar'></div>

<link href='<?php echo $Config->site; ?>templates/itcslive/css/calendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo $Config->site; ?>templates/itcslive/css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo $Config->site; ?>templates/itcslive/js/calendar/moment.min.js'></script>
<script src='<?php echo $Config->site; ?>templates/itcslive/js/calendar/jquery-ui.custom.min.js'></script>
<script src='<?php echo $Config->site; ?>templates/itcslive/js/calendar/fullcalendar.min.js'></script>
<script>	
var Calendar=new function()
{
	this.calendarevent=function(form_id)
	{
		var i;
		var second=[];
		var formURL="project?view=company&task=getTaskDetails"; 
		jQuery.post(formURL,
		function(data){
			alert(data.max); 
			for(i=0; i < data.length; i++)
			{
				second = data[i];
				for(j=0; j<second.legth; j++)
				jQuery("#calendar").fullCalendar({
					events:
					[
						{
							employee_name: data[i].name,
							task: data[i].task_name,
							start: data[i].create_date,
							task_hour: data[i].task_hour+'hr'	
						}
					]
				});
			}
		});
	}	
}
	jQuery(document).ready(function() {	
		jQuery("#text_user").kendoComboBox();	
		jQuery("#calendar").fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
				},
			defaultDate: '2014-08-20',
			editable: true,
		});		
	});

</script>

<style>
	#calendar {
		width: 900px;
		margin: 40px auto;
	}
</style>