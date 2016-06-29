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
		else if(input.email.value=="" || !regex.test(input.email.value))
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
		else if(input.confirm_password.value != input.password.value)
			{ 	alert("password not same");
				jQuery("#error_password").html("confirm_password Invalid!!");
				jQuery("#error_password").show('slow');
				alert("password not same");
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





var Transporter_SignUp=new function()
{	
	this.SubmitForm=function(formid)
	{	
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
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
		else if(input.email.value=="" || !regex.test(input.email.value))
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

		else if(input.confirm_password.value != input.password.value)
			{ 	alert("password not same");
				jQuery("#error_password").html("confirm_password Invalid!!");
				jQuery("#error_password").show('slow');
				alert("password not same");
				input.confirm_password.focus();
			}
		else if(input.address.value=="" )
			{
				jQuery("#error_address").html("address Invalid!!");
				jQuery("#error_address").show('slow');
				input.address.focus();
			}
		else if(input.Transport_Name.value=="" )
			{
				jQuery("#error_Transport_Name").html("Transport_Name Invalid!!");
				jQuery("#error_Transport_Name").show('slow');
				input.Transport_Name.focus();
			}
		else if(input.Registration_no.value=="" )
			{
				jQuery("#error_Registration_no").html("Registration_no Invalid!!");
				jQuery("#error_Registration_no").show('slow');
				input.Registration_no.focus();
			}
		else if(input.Transporter_Type.value=="" )
			{
				jQuery("#error_Transporter_Type").html("Transporter_Type Invalid!!");
				jQuery("#error_Transporter_Type").show('slow');
				input.Transporter_Type.focus();
			}	
			
			
				
		else
		{
				input.submit();
		}
		
	}
}	