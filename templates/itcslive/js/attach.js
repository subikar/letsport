var Attach = new function()
{
	this.attachTab=function(id)
	{		
		if(document.getElementById('div_'+id).style.display == 'inline')
		{
			document.getElementById('div_'+id).style.display = 'none';
		}
		else
		{
			document.getElementById('div_'+id).style.display = 'inline-block';
			var divIds=new Array("mycomputer","googledrive");
			var i;
			document.getElementById('li_'+id).className = 'active';
			for(i=0;i<divIds.length;i++)
			{
				if(id!=divIds[i])
				{ 
					document.getElementById("li_"+divIds[i]).className='';
					document.getElementById('div_'+divIds[i]).style.display = 'none';
				}
			}			
		}
	}
	
	this.uploadimg = function(input)
	{
		jQuery("#img_progress").show('fast');
		var fileSize = input.files[0].size;
		var URL = jQuery("#baseUrl").val();
		var avatar = input.value;
		var extension = avatar.split('.').pop().toUpperCase();
		jQuery("#imgMessage").css('color','red');
		if(extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG" && extension!="TXT" && extension!="DOC" && extension!="PDF" && extension!="DOCX" && extension!="ZIP" && extension!="RAR" && extension!="XLSX" && extension!="XLS" && extension!="XML" && extension!="XPS" && extension!="PSD")
		{
			jQuery("#img_progress").hide('fast');
			jQuery("#imgMessage").html("Invalid Extension"+extension);
			jQuery("#uploadedImage").html("");
			return false;
		}
		else if(fileSize >5*1024*1024)
		{
			jQuery("#img_progress").hide('fast');
			jQuery("#imgMessage").html("File is too large. Please upload below 5MB.");
			jQuery("#uploadedImage").html("");
			return false;
		}
		else if(input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				if(extension=="PNG" || extension=="JPG" || extension=="GIF" || extension=="JPEG")
				  jQuery("#uploadedImage").html("<img id='blah' src='"+e.target.result+"' style='height:100px; width:100px;' />");
				else if(extension=="PDF")
				  jQuery("#uploadedImage").html("<img id='blah' src='"+URL+"images/pdf.png' style='height:100px; width:100px;'/>");
				else if(extension== 'TXT')
				  jQuery("#uploadedImage").html("<img id='blah' src='"+URL+"images/txt.png' style='height:100px; width:100px;'/>");
				else if(extension== 'DOC' || extension== 'DOCX' || extension== 'XLSX' || extension== 'XLS' || extension== 'XML' || extension== 'XPS')
				 jQuery("#uploadedImage").html("<img id='blah' src='"+URL+"images/docx.png' style='height:100px; width:100px;'/>");
				else if(extension== 'ZIP' || extension== 'RAT' || extension== 'RAR')
				  jQuery("#uploadedImage").html("<img id='blah' src='"+URL+"images/zip.png' style='height:100px; width:100px;'/>");
				else if(extension=="PSD")
				  jQuery("#uploadedImage").html("<img id='blah' src='"+URL+"images/psd.png' style='height:100px; width:100px;'/>");
				jQuery("#imgMessage").html("");
				jQuery("#img_progress").hide('fast');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	this.submitform = function(form_id)
	{
		var input = document.getElementById(form_id);
		var img = input.files;
		jQuery("#imgMessage").css('color','red');
		if(img.value == '')
		{
			jQuery("#imgMessage").html("Please attach file.");
		}
		else if(img.files[0].size >5*1024*1024)
		{
			jQuery("#imgMessage").html("File is too large. Please upload below 5MB.");
			jQuery(".file_upload").html("<input id='file_input' type='file' name='files' onchange='Attach.uploadimg(this)' />");
		}
		else
		{
			input.submit();
		}
	}
}