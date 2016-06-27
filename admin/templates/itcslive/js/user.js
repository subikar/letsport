var User = new function()
{
	this.validateAddUser=function(form_id)
	{
		var input=document.getElementById(form_id);
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			jQuery(".error_tag").hide();
			if(input.name.value=="")
			{
				jQuery("#error_name").html("Name Invalid!!");
				jQuery("#error_name").show('slow');
				input.name.focus();
			}
			else if(!regex.test(input.email.value))
			{
				jQuery("#error_email").html("Email Invalid!!");
				jQuery("#error_email").show('slow');
				input.email.focus();
			}
			else
			{
				var formURL="index.php?view=users&task=checkEmail";
					jQuery.post(formURL, { email:input.email.value,user_id:input.uid.value},
					function(data){
 					var count=parseInt(data);
						if(count == 0)
						{
								input.submit();
						}
						else
						{
							jQuery("#error_email").html("Email Already Exist!");
							jQuery("#error_email").show('slow');
							input.email.focus();
						}
					});
			}
	}
	this.Remove = function(id)
	{
		 var retVal = confirm("Do you want to delete ?");
  		 if( retVal == true )
		 {
			jQuery.post("index.php","view=users&task=RemoveUser&user_id="+id,
				function(data)
				{
					window.location.href='index.php?view=users';
				});			
  		 }
		 else
		 {
	  		return false;
		 }
   }
   
   this.multipleDelete=function(form_name)
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
}

jQuery(document).ready(function() {
	jQuery('.chk_boxes').click(function(){
		var chk = jQuery(this).attr('checked')?true:false;
		jQuery('.chk_boxes1').attr('checked',chk);
		});
});
	