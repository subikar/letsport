var Attendance=new function()
{
/*    this.multipleDelete=function(form_name)
   {
	   
	    var retVal = confirm("Do you want to delete ?");
  		 if( retVal == true )
		 {
		 var theForm = document.forms[form_name];
		   var input = document.createElement('input');
			input.type = 'hidden';
			input.name = "task";
			input.value = "RemoveMultiple";
			theForm.appendChild(input);
	   		theForm.submit();
		 }
		 else
		 {
			 return false;
		 }
   }
*/}
jQuery(document).ready(function() {
jQuery("#filter_date").kendoDatePicker({ start: "year", depth: "year",format: "yyyy-MM" });
//jQuery("#txt_date1").kendoDatePicker({ format: "yyyy-MM-dd" });	
//jQuery("#txt_date2").kendoDatePicker({ format: "yyyy-MM-dd" }); 
var formURL="index.php?view=attendance&task=getUsers";
					jQuery.post(formURL, {},
					function(data){
						var result=JSON.parse(data);
					jQuery("#filter_name").kendoAutoComplete({ minLength: 3, dataSource: result, dataTextField: "name" });	
		});
});	