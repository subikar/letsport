 var FreeQuote=new function()
{
	this.validateEnquery=function(input_id)
	{	
		var input=document.getElementById(input_id);
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		jQuery(".error_tag").hide();
		
		if(input.name.value=="")
		{
			input.name.focus();
			jQuery("#error_name").html("Name Can't Left Blank!").show();
			return false;
		}
		else if(input.email.value=="" || !regex.test(input.email.value))
		{
			input.email.focus();
			jQuery("#error_email").html("Email Invalid!").show();
			return false;
		}
		else if(input.phone.value=="" || isNaN(input.phone.value) || !input.phone.value.match(phoneno))
		{
			input.phone.focus();
			jQuery("#error_phone").html("Phone Invalid!").show();
			jQuery("#error_phonenunber").show();
			return false;
		}
		else if(input.message.value=="" || input.message.value==" ")
		{
			input.message.focus();
			jQuery("#error_message").html("<small>Message Can't Left Blank!</small>").show();
			return false;
		}
		else if(input.message.value.length < 5)
		{
			input.message.focus();
			jQuery("#error_message").html("<small>The message is too short!</small>").show();
			return false;		
		}
		else
		{
			input.submit();
		}
	}


	this.CheckLength = function(thisobj,textcounter) 
	{
      maxLen = 2000; // max number of characters allowed
	if (thisobj.value.length >= maxLen) {
		jQuery('.'+textcounter).val((maxLen - thisobj.value.length));
		thisobj.value = thisobj.value.substring(0, maxLen);
	 }
	else{ 
		jQuery('.'+textcounter).val((maxLen - thisobj.value.length));
	}
	}
	this.addKey = function(formname)
	  {
		jQuery.post( "generatekey", {formname: formname}, 
		function( data ) 
		{
			jQuery("#"+formname).append("<input type='hidden' name='formkey' value='"+data+"'>");
		});

	  }
}
jQuery(document).ready(function(){
   var screenwidth=jQuery(document).width();
		if(screenwidth<=800)jQuery(".get-free-quote").colorbox({iframe:true,width:"90%",height:"75%"});else
jQuery(".get-free-quote").colorbox({iframe:true,width:"50%",height:"60%"});});
var clicks = 0;
jQuery(document).ready(function(){
 var screenwidth = jQuery(document).width();
 if(screenwidth <= 600)
  {
	 jQuery(".clientlogin").colorbox({iframe:true, width:"90%", height:"75%"});	 
	 jQuery(".truckavailibilty").colorbox({iframe:true, width:"90%", height:"75%"});	 
  }
 else
  { 
	 jQuery(".clientlogin").colorbox({iframe:true, width:"40%", height:"60%"});	 
	 jQuery(".truckavailibilty").colorbox({iframe:true, width:"40%", height:"80%"});	 
  }
 
 
 
 jQuery('.toggle-menu').jPushMenu();
 jQuery(".jPushMenuBtn").click(function(){
					clicks = clicks+1;
					if(clicks%2==0)
				 	 jQuery('.toggle-menu').removeClass('tgclose');
					else
				 	 jQuery('.toggle-menu').addClass('tgclose');
				}); 
 }); 
