var leavemanager=new function()
{
	this.validateMonthlyLeave=function(form_id)
	{
		jQuery(".error_form_area").hide();
		var input=document.getElementById(form_id); var mydata = {};
		for (var i=0, iLen=input.length; i<iLen; i++) {
			if(input[i].name!=="" && input[i].value!=="" && input[i].name!=="view" && input[i].name!=="task" && input[i].name!=="Save")
			{
				var propertyName= input[i].name;
				mydata[propertyName] =  input[i].value;
			}
			else if(input[i].name!=="" && input[i].value=="")
			if(input[i].name!=="" && input[i].value=="")
			{
				jQuery(".error_form_area").html("Please Fill out all fields");
				jQuery(".error_form_area").show();
				input[i].focus();
				return false;
			}
		}
		
		jQuery.post("index.php?view=leavemanager&task=ajaxValidateMonthlyLeave", mydata,
			function(data){
				var result=JSON.parse(data);
				if(parseInt(result["status"]) ==1)
				{
					input.submit();
				}
				else
				{
					jQuery(".error_form_area").html(result["message"]);
					jQuery(".error_form_area").show();	
				}
			});
		
	}
	this.validateYearlyLeave=function(form_id) 
	{
		jQuery(".error_form_area").hide();
		var input=document.getElementById(form_id); var mydata = {};
		for (var i=0, iLen=input.length; i<iLen; i++) {
			if(input[i].name!=="" && input[i].value!=="" && input[i].name!=="view" && input[i].name!=="task" && input[i].name!=="Save")
			{
				var propertyName= input[i].name;
				mydata[propertyName] =  input[i].value;
			}
			else if(input[i].name!=="" && input[i].value=="")
			if(input[i].name!=="" && input[i].value=="")
			{
				jQuery(".error_form_area").html("Please Fill out all fields");
				jQuery(".error_form_area").show();
				input[i].focus();
				return false;
			}
		}
		
		jQuery.post("index.php?view=leavemanager&task=ajaxValidateYearlyLeave", mydata,
			function(data){
				var result=JSON.parse(data);
				if(parseInt(result["status"]) ==1)
				{
					input.submit();
				}
				else
				{
					jQuery(".error_form_area").html(result["message"]);
					jQuery(".error_form_area").show();	
				}
			});
		
	}
	
}
jQuery(document).ready(function() {
jQuery("#filter_date").kendoDatePicker({ start: "year", depth: "year",format: "yyyy-MM" });
var formURL="index.php?view=attendance&task=getUsers";
					jQuery.post(formURL, {},
					function(data){
						var result=JSON.parse(data);
					jQuery("#filter_name").kendoAutoComplete({ minLength: 3, dataSource: result, dataTextField: "name" });	
		});
jQuery("#text_date").kendoDatePicker({ start: "year", depth: "year",format: "yyyy-MM" });
jQuery("#text_year").kendoDatePicker({ start: "decade", depth: "decade",format: "yyyy" });
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
                    url: "index.php?view=leavemanager&task=getuserFromAjax",
					method: "post"
                }
            }
        }
	});					
});	