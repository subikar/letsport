
var Company=new function()
{
	this.Remove = function(id)
	{
		 var retVal = confirm("Do you want to delete ?");
  		 if( retVal == true )
		 {
			jQuery.post("index.php","view=company&task=RemoveCompany&company_id="+id,
				function(data)
				{
					window.location.href='index.php?view=company';
				});			
  		 }
		 else
		 {
	  		return false;
		 }
   }
   this.multipleDelete=function(form_name)
   {
	   if(jQuery("#CompanyForm input.chk_boxes1:checkbox:checked").length > 0){
		   var retVal = confirm("Do you want to delete ?");
			 if(retVal == true){
			   var theForm = document.forms[form_name];
			   var input = document.createElement('input');
				input.type = 'hidden';
				input.name = "task";
				input.value = "RemoveMultiple";
				theForm.appendChild(input);
				theForm.submit();
			 }else{
				 return false;
			 }
		}else{
		  alert("Please Select Company!");
		}
   }
}

jQuery(document).ready(function() {
	jQuery('.chk_boxes').click(function(){
		var chk = jQuery(this).attr('checked')?true:false;
		jQuery('.chk_boxes1').attr('checked',chk);
		});
});
	
	
	