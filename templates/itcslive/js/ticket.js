// Ticket @ iTCSLive.
var Ticket=new function()
{	
	this.closeTicket=function(ticket_id)
	{
		jQuery.post( "ticket?view=myticket&task=closeTicket", {ticket_id: ticket_id}, 
		function( data ) 
		{
				alert("This Ticket is Now Closed!!");
				window.parent.location.href=parent.document.location.href;
				parent.jQuery.colorbox.close();
		});
	}
	this.validateComment=function(form_id)
	{
		jQuery("#error_com").hide();
		var input=document.getElementById(form_id);
		var comment=tinymce.get('editor').getContent();
		if(parseInt(input.user_id.value)==0)
		{
			alert("Please Login To add Comment!!");
			return false;
		}
		else if(comment=="" || comment==" ")
		{
			alert("Comment box is empty!!");
			return false;
		}
		else
		{
			var mydata = {}, attachment=new Array(), googleattachment = new Array(), attch=0, googleattach=0;
			for (var i=0, iLen=input.length; i<iLen; i++) 
			{
				if(input[i].name=="googleattachment[]")
				{
					googleattachment[googleattach++]= input[i].value;
				}
				else if(input[i].name=="attachment[]")
				{
					attachment[attch++]= input[i].value;
				}
				else if(input[i].name!=="" && input[i].name!=="comment")
				{
					var propertyName= input[i].name;
					mydata[propertyName] =  input[i].value;
				}
				else if(input[i].name=="comment")
				{
					var propertyName= input[i].name;
					mydata[propertyName] =  comment;
				}
			}
			mydata["attachment"]=attachment;
			mydata["googleattachment"]=googleattachment;
			
			jQuery.post("ticket", mydata,
			function(data)
			{
				var result=JSON.parse(data);
				if(parseInt(result["status"]) == 1)
				{
					jQuery("#threadContent").append(result["addhtml"]);
					jQuery("#req_no").html(result["req_no"]);
					tinyMCE.get('editor').setContent("");
					document.getElementById("allAttechFile").innerHTML = "";
				}
				else
				{
						jQuery( "#error_com" ).html(result["message"]);
						jQuery("#error_com").show();
				}
			});
		}
	}
	this.validateAddContact=function(form_id)
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
			else if(input.phone.value!="" && isNaN(input.phone.value) && !input.phone.value.match(phoneno))
			{
				jQuery("#error_phonenunber").html("Contact No Invalid!!");
				jQuery("#error_phonenunber").show('slow');
				input.phone.focus();
			}
			else if(input.email.value!="" && !regex.test(input.email.value))
			{
				jQuery("#error_email").html("Email Invalid!!");
				jQuery("#error_email").show('slow');
				input.email.focus();
			}
			else
			{
				var formURL="ticket?view=user&task=checkemailORphone";
					jQuery.post(formURL, { email:input.email.value,user_id:input.user_id.value,phone:input.phone.value},
					function(data){
						//alert(data);
 					var result=JSON.parse(data, true);
						if(parseInt(result["status"]) == 1)
						{
							//alert("OK");
								input.submit();
						}
						else
						{
							jQuery("#error_"+result["error"]).html(result["message"]);
							jQuery("#error_"+result["error"]).show('slow');
							input.email.focus();
							input.phone.focus();
						}
					});
			}
	}
	this.validateModifyTicket=function(form_id)
	{
		jQuery("#error_com").hide();
		var input=document.getElementById(form_id);

			if((input.visit_datetime.value=='0000-00-00' || input.visit_datetime.value=='') && (input.alert_date.value=='0000-00-00' || input.alert_date.value==''))
			{
				jQuery("#error_com").html("You Can't Left Visit date and Alert date Blank!!");
				jQuery("#error_com").show();
				return false;
			}
			else if(input.visit_datetime.value!='')
			{
				 if(input.field_executive.value=='' || input.field_executive.value==0)
				{
					jQuery("#error_com").html("Please Select Field Executive!!");
					jQuery("#error_com").show();
					return false;
				}
				else
				{
					return true;	
				}
		}
	}
	this.UpdatePassword=function(form_id)
	{
			jQuery("#error_pass_update").html("");
			var input=document.getElementById(form_id);
			if(input.old_pass.value=="")
			{
				jQuery("#error_pass_update").html("<span style='color:#FF3366'>Old Password Blank!</span>"); return false;
			}
			else if(input.new_pass.value=="")
			{
				jQuery("#error_pass_update").html("<span style='color:#FF3366'>New Password Blank!</span>"); return false;
			}
			else if(input.retype_new_pass.value=="")
			{
				jQuery("#error_pass_update").html("<span style='color:#FF3366'>Retype New Password Blank!</span>"); return false;
			}
			else
			{
			var mydata = {};
				for (var i=0, iLen=input.length; i<iLen; i++) 
				{
					var propertyName= input[i].name;
					mydata[propertyName] =  input[i].value;
				}
			jQuery.post("user", mydata,
			function(data)
			{
				
				var result=JSON.parse(data);
				if(parseInt(result["status"]) == 1)
				{
					jQuery("#error_pass_update").html(result["message"]);
					jQuery("#pass_update_form_div").html("<p><input type='button' value='Close' onclick='parent.jQuery.colorbox.close();' /></p>")
				}
				else
				{
					jQuery("#error_pass_update").html("<span style='color:#FF3366'>"+result["message"]+"</span>");
				}
			});	
		}
	}
}
var User=new function()
{
	this.imageupload = function(input)
	{
		jQuery("#img_progress").show('fast');
		var fileSize = input.files[0].size;
		var avatar = input.value;
		var extension = avatar.split('.').pop().toUpperCase();
		jQuery("#imgMessage").css('color','red');
		if(extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG")
		{
			jQuery("#img_progress").hide('fast');
			jQuery("#imgMessage").html("invalid extension"+extension);
			jQuery("#uploadedImage").html("");
			return false;
		}
		else if((fileSize/1024)>3000) 
		{
			jQuery("#img_progress").hide('fast');
			jQuery("#imgMessage").html("Image Size 3MB Exceeded");
			jQuery("#uploadedImage").html("");
			return false;
		}
		else if(input.files && input.files[0]) {
		var reader = new FileReader();

		 reader.onload = function (e) {
			jQuery("#uploadedImage").html("<img id='blah' src='"+e.target.result+"' style='height:100px; width:100px;' />");
			jQuery("#img_progress").hide('fast');
			}
		 reader.readAsDataURL(input.files[0]);
		}
	}
	this.checkEmail=function(input)
	{
		var user_id = document.getElementById("user_id").value;
		jQuery.post("ticket?view=user&task=validateEmail",{email: input.value,user_id:user_id},
		function(data){
			if(parseInt(data) != 0)
			{					
				jQuery( "#error_email" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
			}
		});			
		return false;
	}
	this.submitForm=function(form_id)
	{
		var input=document.getElementById(form_id);
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		jQuery(".error_tag").hide();
		jQuery(".error_tag").css('color','red');
		if(input.name.value=="")
		{
			jQuery("#error_name").html("Name Invalid!!");
			jQuery("#error_name").show('slow');
			input.name.focus();
		}
		else if(input.phone.value!="" && isNaN(input.phone.value) && !input.phone.value.match(phoneno))
		{
			jQuery("#error_phonenunber").html("Contact No Invalid!!");
			jQuery("#error_phonenunber").show('slow');
			input.phone.focus();
		}
		else if(input.email.value!="" && !regex.test(input.email.value))
		{
			jQuery("#error_email").html("Email Invalid!!");
			jQuery("#error_email").show('slow');
			input.email.focus();
		}
		else if(input.address.value == "")
		{
			jQuery("#error_address").html("Address Invalid!!");
			jQuery("#error_address").show('slow');
			input.email.focus();
		}
		else if(input.postal.value == "")
		{
			jQuery("#error_postal").html("Postal Invalid!!");
			jQuery("#error_postal").show('slow');
			input.email.focus();
		}
		else if(input.city.value == "")
		{
			jQuery("#error_city").html("City Invalid!!");
			jQuery("#error_city").show('slow');
			input.email.focus();
		}
		else
		{
			var user_id = document.getElementById("user_id").value;
			var formURL="ticket?view=user&task=checkemailORphone";
					jQuery.post(formURL, { email:input.email.value, user_id:user_id, phone:input.phone.value},
					function(data){
						//alert(data);
 					var result=JSON.parse(data, true);
						if(parseInt(result["status"]) == 1)
						{
								//alert("OK");
								input.submit();
						}
						else
						{
							jQuery("#error_"+result["error"]).html(result["message"]);
							jQuery("#error_"+result["error"]).show('slow');
							input.email.focus();
							input.phone.focus();
						}
					});
		}
	
	}
}
var Attachment = new function()
{	
	this.delAttachfile = function(Alink,id)
	{
		var ticketid = jQuery( "#getlinkId" ).val();
		jQuery.post( "attach?view=attach&task=unlinkAttachFile&nohtml=1&alink="+Alink+"&ticketid="+ticketid, 
		function( data ) 
		{
			var result=JSON.parse(data);
			if(parseInt(result["status"])==1)
			{ 
				jQuery( "#"+id ).remove();
			}
			else
			{
				alert("Not Removed! Try Again");
			}
		});
	}
	this.delgoogleAttachfile = function(id)
	{
		jQuery( "#"+id ).remove();
	}
}
jQuery(document).ready(function(){
	jQuery("#text_user").kendoAutoComplete({
		dataTextField: "name",							
		filter: "contains",
		minLength: 2,
		dataSource: {
			type: "json",
			serverFiltering: true,
			transport: {
				read: {
							url: "ticket?view=myticket&task=getCustomersFromAjax",
							dataType: "json",
							method: "post"
						}
			}
		}
    });
	jQuery("#text_user_ticket").kendoComboBox({	
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
                    url: "ticket?view=myticket&task=getContactsForAddTicket_fromAjax",
					method: "post"
                }
            }
        }
	});
	jQuery("#telecaller_for_admin").kendoComboBox({
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
                    url: "ticket?view=myticket&task=getTelecallerForAddTicket_fromAjax",
					method: "post"
                }
            }
        }
    });
	jQuery("#field_executive").kendoComboBox({
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
                    url: "ticket?view=myticket&task=getFieldExecutive_fromAjax",
					method: "post"
                }
            }
        }
    });

	
	jQuery("#text_date").kendoDatePicker({ format: "yyyy-MM-dd" });
	jQuery("#text_datetime").kendoDateTimePicker({format: "yyyy-MM-dd HH:mm"});
	jQuery("#text_category").kendoComboBox({filter: "contains"});
	jQuery(".attachment").colorbox({iframe:true, width:"40%", height:"70%"});

	     var screenwidth = $(document).width();
		 <!--alert(screenwidth);-->
		 if(screenwidth <= 320)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"95%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"100%", height:"500px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"97%", height:"400px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"97%", height:"400px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"98%", height:"300px"});	
		   
		   }
		 else if(screenwidth > 320 && screenwidth <= 480)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"95%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"100%", height:"500px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"40%", height:"550px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"97%", height:"400px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"98%", height:"300px"});
		   }  
 		 else if(screenwidth > 480 && screenwidth <= 600)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"80%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"80%", height:"450px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"40%", height:"550px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"97%", height:"400px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"100%", height:"300px"});
		   }
		 else if(screenwidth > 600 && screenwidth <= 768)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"98%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"80%", height:"450px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"40%", height:"500px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"80%", height:"400px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"100%", height:"300px"});
		   } 
		 else if(screenwidth > 768 && screenwidth <= 996)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"60%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"60%", height:"550px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"40%", height:"550px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"70%", height:"350px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"70%", height:"300px"});
		   } 
		 else if(screenwidth > 996)
		   {
                   jQuery(".modifydetails").colorbox({iframe:true, width:"50%", height:"750px"});	
                   jQuery(".addcontact").colorbox({iframe:true, width:"40%", height:"600px"});
				   jQuery(".attendance").colorbox({iframe:true, width:"40%", height:"550px"});
				   jQuery(".breaktime").colorbox({iframe:true, width:"40%", height:"350px"});
				   jQuery(".change_password").colorbox({iframe:true, width:"40%", height:"300px"});
		   }  

});