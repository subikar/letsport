// Project @ iTCSLive.
var Project=new function()
{	
	this.callpage=function()
	{
		var option = jQuery( "#create_addtype" ).val();
		var baseUri = jQuery( "#baseUri" ).val();
		switch(option)
		{
			case 'company':
			jQuery.colorbox({href:baseUri+"addcompany", iframe:true, width:"60%", height:"75%",  scrolling:false, open:true, overlayClose:true, title:"Add Company"});
			break;
			case 'project':
			jQuery.colorbox({href: baseUri+"addproject", iframe:true, width:"60%", height:"75%", scrolling:false, open:true, overlayClose:true, title:"Add Project"});
			break;
			case 'task':
			jQuery.colorbox({href: baseUri+"addtask", iframe:true, width:"60%", height:"75%", scrolling:false, open:true, overlayClose:true, title:"Add Task"});
			break;
			default:
			break;
		}
    }
	this.showdescription = function()
	{
		jQuery('#task_description').show();
	}
	this.hidedescription = function()
	{
		jQuery('#task_description').hide();
	}
	this.taskContent = function(task_id)
	{
		task_id = task_id || null;
		if(task_id==null)
		task_id=jQuery("#task_id").val();
		
		jQuery('#loading').show();
		var formURL="project?view=project&task=taskContent";
		jQuery.post(formURL, { task_id:task_id},
		function(data){
				var result=JSON.parse(data);
				jQuery('#taskcontent').html(result["content"]);
				jQuery("#text_date").kendoDatePicker({ format: "yyyy-MM-dd" });
				Project.scroolWindow("taskname");
		}).fail(function(data,status,message) { 
			alert(message); 
			if(message.indexOf("Please Login") > -1){ window.location.reload(); }
		});
		jQuery('#loading').hide();
	}
	this.taskComment = function(form_id)
	{	
		jQuery("#error_com").hide();
		
		var input=document.getElementById(form_id);
		var uid = document.getElementById("user_id").value;
			if(parseInt(uid)==0)
			{
				alert("Plese Login To add Comment!!");
				return false;
			}
			else if(input.editor.value=="" || input.editor.value==" ")
			{
				alert("Plese add some Comment!!");
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
					else if(input[i].name == "internal_comment")
					{
						var internalComment = document.getElementById(input[i].id);
						if(internalComment.checked == true)
						{
							//alert(internalComment.checked);
							var propertyName= input[i].name;
							mydata[propertyName] =  input[i].value;
						}
					}
					else if(input[i].name!=="" && input[i].value!=="")
					{
						var propertyName= input[i].name;
						mydata[propertyName] =  input[i].value;
					}
				}
				mydata["attachment"]=attachment;
				mydata["googleattachment"]=googleattachment;
			jQuery("#submitComment").attr({value:"Commenting...","disabled": true});	
			
		  	jQuery.post("project", mydata,
			function(data)
			{
				//alert(data); return false;
				var result=JSON.parse(data);
				if(parseInt(result["reopen_status"]) == 1)
				{
					window.location.reload(true);
				}
				else if(parseInt(result["status"]) == 1)
				{
					jQuery("#contentbox").prepend(result["addhtml"]);
					jQuery("#allAttechFile").html("");
					jQuery("#noTaskContent").hide();
					input.editor.value="";
					if(jQuery('#task_hour').attr('id')){
						input.task_hour.value="";
					}
					if(jQuery('#task_minute').attr('id')){
						input.task_minute.value="";
					}
				}
				else
				{
						jQuery( "#error_com" ).html(result["message"]);
						jQuery("#error_com").show();
				}
			jQuery("#submitComment").attr({value:"COMMENT","disabled":false});	
				
			}).fail(function(data,status,message) {
				jQuery("#submitComment").attr({value:"COMMENT","disabled":false});	
				alert(message); 
				if(message.indexOf("Please Login") > -1){ window.location.reload(); }
			});	
		}
	}
	this.RemoveTaskComment=function(comment_id)
	{
		if(confirm ("Are you sure you want to delete this item ?")== true)
		{
			var formURL="project?view=project&task=RemoveTaskComment";
			jQuery.post(formURL, {comment_id:comment_id},
				function(data){	
					var result=JSON.parse(data,true);
					if(parseInt(result["status"]) == 1)
					{
						jQuery("#comment_box_"+comment_id).hide("slow");
					}
					else
					{
						alert(result["message"]);	
					}
				}).fail(function(data,status,message) {
					alert(message); 
					if(message.indexOf("Please Login") > -1){ window.location.reload(); }
				});
		}
	}
	this.timeTracking=function()
	{
		var formURL="project?view=project&task=getTimeTracking";
		jQuery('#loading').show();
		jQuery.post(formURL,
			function(data){
				var result=JSON.parse(data);
				jQuery("#right_area_sidebar").html(result["timetracking"]);
				jQuery('#loading').hide();
			}).fail(function(data,status,message) {alert(message); });
	}
	this.myattendance=function()
	{
		var formURL="project?view=project&task=getAttendance";
		jQuery('#loading').show();
		jQuery.post(formURL,
			function(data){
				var result=JSON.parse(data);
				jQuery("#right_area_sidebar").html(result["myattendance"]);
				jQuery('#loading').hide();
			}).fail(function(data,status,message) {
				alert(message); 
				if(message.indexOf("Please Login") > -1){ window.location.reload(); }		
		});
	}
	this.displayPage=function()
	{
		var url =window.location;
		var hashStr = location.hash.replace("#","");
		if(hashStr!="")
		{
			var hashArray=hashStr.split("/");
			var param=hashArray[0];
		}
		else
		{
			var param="project";
		}
		switch(param)
		{
			case "project":
				project_id=(hashStr!="")? hashArray[1] : null;				
				var formURL="project?view=project&task=getTaskFromAjax";
					jQuery.post(formURL, { project_id: project_id},
					function(data){
						//alert(data);
						var result=JSON.parse(data);
						jQuery("#right_area_sidebar").html(result["content"]);
						jQuery("#taskcontent").html("");						
						if(hashStr!="" && hashArray[2]=="task")
						{
							Project.taskContent(hashArray[3]);
						}
						else
						{
							Project.scroolWindow("right_area_sidebar");	
						}
					}).fail(function(data,status,message) {
						alert(message); 
						if(message.indexOf("Please Login") > -1){ window.location.reload(); }	
					});
			break;
			case "company":
				this.scroolWindow("right_area_sidebar");
				company_id=(hashStr!="")? hashArray[1] : null;				
				var formURL="project?view=project&task=getCompanyFromAjax";
					jQuery.post(formURL, { company_id: company_id},
					function(data){
						//alert(data);
						var result=JSON.parse(data);
						jQuery("#right_area_sidebar").html(result["content"]);
						jQuery("#taskcontent").html("");
					}).fail(function(data,status,message) {
						alert(message); 
						if(message.indexOf("Please Login") > -1){ window.location.reload(); }	
					});
			break;
			case "archive":	
				this.scroolWindow("right_area_sidebar");
				var formURL="project?view=project&task=getArchiveFromAjax";
					jQuery.post(formURL, {},
					function(data){
						//alert(data);
						var result=JSON.parse(data);
						jQuery("#right_area_sidebar").html(result["content"]);
						jQuery("#taskcontent").html("");
					}).fail(function(data,status,message) {
						alert(message); 
						if(message.indexOf("Please Login") > -1){ window.location.reload(); }
					});
			break;
			case "myattendance":
				this.scroolWindow("right_area_sidebar");
				Project.myattendance();
			break;
			case "timetracking":
				this.scroolWindow("right_area_sidebar");
				Project.timeTracking();
			break;
		}
	}
	this.scroolWindow=function(div_class)
	{
		//alert( jQuery("#"+div_class).position().top);
		//alert($("#right_area_sidebar").position().top);
		var windowsize =jQuery(window).width();
		 if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowsize <= 640) 
		 {
			var position=jQuery("#"+div_class).offset().top;
			jQuery('html,body').animate({
			  scrollTop:  position
			}, 1000);
		  }
		  else
		  {
			return true;  
		  }
	}
	this.completiondate=function()
	{
		var date = document.getElementById("text_datetime").value;
		var task_id = document.getElementById("content_task_id").value;
		var formURL="project?view=project&task=addCompletionDate";
		jQuery.post(formURL,{ completion_date:date,task_id:task_id},
			function(data){
				if(data != null)
					window.location.reload(true);
			}).fail(function(data,status,message) {
			alert(message); 
				if(message.indexOf("Please Login") > -1){ window.location.reload(); }		
			});
	}
	this.completetask = function(form_id)
	{	
		var input=document.getElementById(form_id);
		var taskcontent = tinymce.get('editor').getContent();
		if(taskcontent=="" || taskcontent==" ")
		{
			alert("Plese add some Comment!!");
			return false;
		}
		else
		{
			input.submit();
		}
	}
	this.taskdescription = function(form_id)
	{	
		var input=document.getElementById(form_id);
		var uid = document.getElementById("user_id").value;
		var taskcontent = tinymce.get('editor').getContent();
		if(parseInt(uid)==0)
		{
			alert("Plese Login To add Comment!!");
			return false;
		}
		else if(taskcontent=="" || taskcontent==" ")
		{
			alert("Plese add some Comment!!");
			return false;
		}
		else
		{
			input.submit();
		}
	}
	this.addCompany = function(form_id)
	{
		var input = document.getElementById(form_id);
		if(input.company_name.value == "" || input.company_name.value == " ")
		{
			alert("Please add Company Name");
			return false;
		}
		else if(isNaN(parseInt(input.owner_id.value)) || input.owner_id.value == "" || input.owner_id.value == " ")
		{
			alert("Please Select Owner Name");
			return false; 
		}
		else
		{
			input.submit();
		}
	}
	this.addProject = function(form_id)
	{
		var input = document.getElementById(form_id);
		if(input.project_name.value == "" || input.project_name.value == " ")
		{
			alert("Please add Project Name");
			return false;
		}
		else if(isNaN(parseInt(input.company_id.value)) || input.company_id.value == "" || input.company_id.value == " ")
		{
			alert("Please Select Company Name");
			return false; 
		}
		else if(input.deadline.value == "" || input.deadline.value == " ")
		{
			alert("Please add Deadline");
			return false;
		}
		else
		{
			input.submit();
		}
	}
	this.addTask = function(form_id)
	{
		var input = document.getElementById(form_id);
		if(input.task_name.value == "" || input.task_name.value == " ")
		{
			alert("Please add Task Name");
			return false;
		}
		else if(isNaN(parseInt(input.point.value)) || input.point.value == "" || input.point.value == " ")
		{
			alert("Please add Point");
			return false; 
		}
		else if(input.point.value.toString().indexOf(".") != -1 || parseInt(input.point.value) < 0)
		{
			alert("Please Enter Integer Point Value");
			return false; 
		}
		else if(jQuery('#total_point').attr('id') && parseInt(input.point.value) > parseInt(input.total_point.value))
		{
			alert("Please Enter Point less than total point");
			return false; 
		}
		else if(isNaN(parseInt(input.project.value)) || input.project.value == "" || input.project.value == " ")
		{
			alert("Please Select Project Name");
			return false; 
		}
		else
		{
			input.submit();
		}
	}
	this.addTaskEmployee = function(form_id)
	{
		var input = document.getElementById(form_id);
		if(input.task_name.value == "" || input.task_name.value == " ")
		{
			alert("Please add Task Name");
			return false;
		}
		else if(isNaN(parseInt(input.point.value)) || input.point.value == "" || input.point.value == " ")
		{
			alert("Please add Point");
			return false; 
		}
		else if(input.point.value.toString().indexOf(".") != -1)
		{
			alert("Please Enter Integer Point Value");
			return false; 
		}
		else if(parseInt(input.point.value) > parseInt(input.total_point.value))
		{
			alert("Please Enter Point less than total point");
			return false; 
		}
		else if(isNaN(parseInt(input.project.value)) || input.project.value == "" || input.project.value == " ")
		{
			alert("Please Select Project Name");
			return false;
		}
		else
		{
			input.submit();
		}
	}
	this.editdeadline = function(form_id)
	{
		var input = document.getElementById(form_id);
		if(input.deadline.value == "" || input.deadline.value == " ")
		{
			alert("Please Select Deadline");
			return false;
		}
		else if(isNaN(parseInt(input.project.value)) || input.project.value == "" || input.project.value == " ")
		{
			alert("Please Select Project Name");
			return false;
		}
		else
		{
			input.submit();
		}
	}
	this.assignProject = function(form_id)
	{
		var input = document.getElementById(form_id);
		var userIDs=document.forms[form_id]["user_id[]"].value;
		if(isNaN(parseInt(userIDs)) || userIDs == "" || userIDs == " ")
		{
			alert("Please Select Employee Name");
			return false; 
		}
		else
		{
			input.submit();
		}
	}
	this.completeproject = function(form_id)
	{
		var input = document.getElementById(form_id);
		var intime = jQuery("input:checkbox[name='intime']:checked").serializeArray();
		if(intime.length == 0)
		{
			var confirmation = confirm("Do you want to complete this "+input.project_name.value+" !");
			if(confirmation == true)
			{
				input.submit();
			}
			else
			{
				return false;
			}
		}
		else
		{
			input.submit();
		}
	}
	this.setToArchive=function(type,type_id)
	{
		var confirmation = confirm("Do you want to archive this "+type+" !");
		if(confirmation == true) 
		{
			var formURL="project?view=project&task=addToArchiveFromAjax";
			jQuery.post(formURL,{ type:type,type_id:type_id},
				function(data){
					//alert(data);
					var result=JSON.parse(data);
					if(parseInt(result["status"])==1)
						window.location.reload(true);
					else
					 alert("Sorry!! due to some technical problem this "+type+" not possible to archive. Please contact to our development team.");
				}).fail(function(data,status,message) {
					alert(message); 
				if(message.indexOf("Please Login") > -1){ window.location.reload(); }	
				});
		}
	}
	this.removeFromArchive=function(type,type_id)
	{
		var confirmation = confirm("Do you want to enable this "+type+"! from Archive?");
		if (confirmation == true) 
		{
			var formURL="project?view=project&task=enableFromArchiveFromAjax";
			jQuery.post(formURL,{ type:type,type_id:type_id},
				function(data){
					//alert(data);
					var result=JSON.parse(data);
					if(parseInt(result["status"])==1)
						window.location.reload(true);
					else
					 alert("Sorry!! due to some technical problem this "+type+" not possible to archive. Please contact to our development team.");
				}).fail(function(data,status,message) {
					alert(message); 
					if(message.indexOf("Please Login") > -1){ window.location.reload(); }	
				});	
		}
	}
	this.searchLeftbar=function()
	{
		var allData=jQuery("#result_allData").val();
		var ptext=document.getElementById("project_search_text").value.toLowerCase();
		var refinedResults=new Array();  var k=0; 
		jQuery("div.company").show();
		jQuery("div.projectList").show();
			
		if(ptext!="" && parseInt(ptext.length) > 2)
		{ 
			allElement=JSON.parse(allData, true);
			for(var i=0; i<allElement.length; i++)
			{
			 if(typeof allElement[i]["projectList"] != "undefined")
			 {
			  var project=allElement[i]["projectList"];
			  var refinedProjects=new Array();  var allProjects=new Array();  var p=0;
			  for(var j=0; j < project.length; j++ )
			  {
				  var projName=project[j]["project_name"].toLowerCase();
				  if(projName.search(ptext) > -1)
				  {
				  	refinedProjects[p++] = project[j]["id"];
				  }
				  allProjects[j]= project[j]["id"];
			  }
			   var companyName=allElement[i]["company_name"].toLowerCase();
			  	if(refinedProjects.length >0 || companyName.search(ptext) > -1)
				{  
					var myobj={};
					myobj["company"] =allElement[i]["id"]; 
					if(companyName.search(ptext) > -1){ myobj["project"] =allProjects; }else{ myobj["project"] =refinedProjects; }
					refinedResults[k++]=myobj; 
				}
			 } 
			}//end for
			
			jQuery("div.company").hide(); jQuery("div.projectList").hide();
			for(val=0; val<refinedResults.length; val++){
				jQuery("#comp"+refinedResults[val]["company"]).show();
					if(refinedResults[val]["project"].length > 0)
					{
						var property = refinedResults[val]["project"];
						for(var propt=0; propt<property.length; propt++) { jQuery("#project"+property[propt]).show(); }
					}
				}
		}
	}
	this.payslip = function()
	{
		var input = document.getElementById("FrmPaySlip");
		var totalAdd = 0,totalDeduct = 0;
		if(input.basic.value != '' || input.hra.value != '' || input.conveynce.value != '' || input.incentive.value != '')
		{
			totalAdd = parseFloat(input.basic.value) + parseFloat(input.hra.value) + parseFloat(input.conveynce.value) + parseFloat(input.incentive.value);
			input.total_add.value = (!isNaN(totalAdd)) ? totalAdd.toFixed(2) : 0;
		}
		if(input.providentfund.value != '' || input.esi.value != '' || input.loan.value != '' || input.professionaltax.value != '' || input.tsdit.value != '')
		{
			totalDeduct = parseFloat(input.providentfund.value) + parseFloat(input.esi.value) + parseFloat(input.loan.value) + parseFloat(input.professionaltax.value) + parseFloat(input.tsdit.value);
			input.total_deduct.value = (!isNaN(totalDeduct)) ? totalDeduct.toFixed(2) : 0;
		}
		var netSalary = parseFloat(input.total_add.value) - parseFloat(input.total_deduct.value);
		input.net_salary.value = (!isNaN(netSalary)) ? netSalary.toFixed(2) : 0;
		var word = "";
		
	}
	this.validPayslip = function()
	{
		
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
		}).fail(function(data,status,message) {
			alert(message); 
			if(message.indexOf("Please Login") > -1){ window.location.reload(); }	
		});
	}
	this.delgoogleAttachfile = function(id)
	{
		jQuery( "#"+id ).remove();
	}
}
jQuery(document).ready(function()
{	
	Project.displayPage();
	jQuery(window).bind( 'hashchange', function(e) {
		Project.displayPage();							   
	});
	//jQuery("#text_date").kendoDatePicker({ format: "yyyy-MM-dd" });
	 jQuery("#text_date").kendoDatePicker({value:new Date(), format: "yyyy-MM-dd" });
    jQuery(".deadline").kendoDatePicker({value:new Date(), format: "yyyy-MM-dd"});
	jQuery("#task_project").kendoDropDownList();
	jQuery("#create_addtype").kendoDropDownList();
});