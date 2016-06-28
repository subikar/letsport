var SignUp=new function()
{	
	this.SubmitForm=function(formid)
	{
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var input=document.getElementById(formid);
		if(input.name.value=="")
			{
				jQuery("#error_name").html("Name Invalid!!");
				jQuery("#error_name").show('slow');
				input.name.focus();
			}
		else if(input.phone.value=="" || isNaN(input.phone.value) || !input.phone.value.match(phoneno))
			{
				jQuery("#error_phonenunber").html("Contact No Invalid!!");
				jQuery("#error_phonenunber").show('slow');
				input.phone.focus();
			}
		else if(input.email.value=="" && !regex.test(input.email.value))
			{
				jQuery("#error_email").html("Email Invalid!!");
				jQuery("#error_email").show('slow');
				input.email.focus();
			}
		else if(input.PAN_Card_No.value=="" )
			{
				jQuery("#error_pancardno").html("PAN_Card_No Invalid!!");
				jQuery("#error_pancardno").show('slow');
				input.PAN_Card_No.focus();
			}
		else if(input.state.value=="" )
			{
				jQuery("#error_state").html("state Invalid!!");
				jQuery("#error_state").show('slow');
				input.state.focus();
			}
		else if(input.city.value=="" )
			{
				jQuery("#error_city").html("city Invalid!!");
				jQuery("#error_city").show('slow');
				input.city.focus();
			}
				else if(input.password.value=="" )
			{
				jQuery("#error_password").html("password Invalid!!");
				jQuery("#error_password").show('slow');
				input.password.focus();
			}
				else if(input.confirm_password.value=="" )
			{
				jQuery("#error_password").html("confirm_password Invalid!!");
				jQuery("#error_password").show('slow');
				input.confirm_password.focus();
			}
					else if(input.address.value=="" )
			{
				jQuery("#error_address").html("address Invalid!!");
				jQuery("#error_address").show('slow');
				input.address.focus();
			}
			
			
		else
		{
			input.submit();
		}
	}
}	