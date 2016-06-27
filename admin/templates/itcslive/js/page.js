
var Page=new function()
{
		this.checkDuplicate=function(input)
		{
			var formURL="index.php?view=page&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias: input.value,page_id:jQuery("#page_id").val()},
					function(data){
						//alert(data);
						if(parseInt(data) == 0)
						{
							return true;
						}
						else
						{
						jQuery( "#error_alias" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
						}
					});
			
			return false;
		}
		this.validateForm=function(form_input)
		{
			if(form_input.alias.value=="")
			{
				jQuery( "#error_alias" ).text( "Tis Field Can not left blank!" ).show().fadeOut( 10000 );	
				return false;
			}
			else
			{
			var formURL="index.php?view=page&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias: form_input.alias.value,page_id:form_input.page_id.value},
					function(data){
						if(parseInt(data) == 0)
						{
							return true;
						}
						else
						{
						jQuery( "#error_alias" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
						}
					});
			}
			//return false;
		}
		 this.uplodeGallery=function(input,id)
			{
				//alert(id);
				var fileSize = input.files[0].size;
				var avatar = input.value;
				var extension = avatar.split('.').pop().toUpperCase();
				jQuery("#message"+id).css('color','red');
				if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG")
				{
					jQuery("#message"+id).html("invalid extension"+extension);
					document.getElementById("blah"+id).src='';
					return false;
				}
				else if((fileSize/1024)>3000) 
				{
					jQuery("#message"+id).html("Image Size 3MB Exceeded");
					document.getElementById("blah"+id).src='';
					return false;
				}
				else if(input.files && input.files[0]) {
				var reader = new FileReader();
		
				 reader.onload = function (e) {
					jQuery('#blah'+id).attr('src', e.target.result);
					}
				 reader.readAsDataURL(input.files[0]);
				}
		}	
}

jQuery(document).ready(function() {
	jQuery('.chk_boxes').click(function(){
		var chk = jQuery(this).attr('checked')?true:false;
		jQuery('.chk_boxes1').attr('checked',chk);
		});
	
	
//////FOR IMAGE UPLODE SECTION////////
	var counter = 2;
    jQuery("#addButton").click(function () {
	if(counter>10){
            alert("Only 10 file allow");
            return false;
	}  
	var filehtml='<div class="add_image"><div id="prevworkBoxDiv1" class="input_browse"><div id="message'+counter+'"></div><label>Gallery#'+counter+': </label><input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Page.uplodeGallery(this,'+counter+');"/></div><span class="sp_image_upload"><img id="blah'+counter+'" src="../images/no_image_found.jpg" align="right" style="height:100px; width:100px;" /></span><div class="clear"></div></div>';
	
	var newTextBoxDiv = jQuery(document.createElement('div')).attr("id", 'prevworkBoxDiv' + counter);
	newTextBoxDiv.after().html(filehtml);
	newTextBoxDiv.appendTo("#prevworkGroup");
 
	counter++;
     });
 
    jQuery("#removeButton").click(function () {
	if(counter==1){
          alert("No more file to remove");
          return false;
       }   
	counter--;
	jQuery("#prevworkBoxDiv" + counter).remove();
	});
//////FOR IMAGE UPLODE SECTION END////////			

});