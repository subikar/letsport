var Ourworks=new function()
{
		 this.uplodeGallery=function(input,id)
			{
				//alert(id);
				jQuery("#img_progress"+id).show('fast');
				var fileSize = input.files[0].size;
				var avatar = input.value;
				var extension = avatar.split('.').pop().toUpperCase();
				jQuery("#message"+id).css('color','red');
				if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG")
				{
					jQuery("#img_progress"+id).hide('fast');
					jQuery("#message"+id).html("invalid extension"+extension);
					document.getElementById("blah"+id).src='';
					return false;
				}
				else if((fileSize/1024)>3000) 
				{
					jQuery("#img_progress"+id).hide('fast');
					jQuery("#message"+id).html("Image Size 3MB Exceeded");
					document.getElementById("blah"+id).src='';
					return false;
				}
				else if(input.files && input.files[0]) {
				var reader = new FileReader();
		
				 reader.onload = function (e) {
					jQuery('#blah'+id).attr('src', e.target.result);
					jQuery("#img_progress"+id).hide('fast');
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
	var filehtml='<div class="add_image"><div id="prevworkBoxDiv1" class="input_browse"><div id="message'+counter+'"></div><label>Gallery#'+counter+': </label><input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Ourworks.uplodeGallery(this,'+counter+');"/></div><img id="img_progress'+counter+'" src="../images/photo_loader.gif" style="width:200px; height:20px; display:none;"/><span class="sp_image_upload"><img id="blah'+counter+'" src="../images/no_image_found.jpg" align="right" style="height:100px; width:100px;" /></span><div class="clear"></div></div>';
	
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
jQuery("#avaliable_date").kendoDatePicker({ format: "yyyy-MM-dd" });
jQuery("#reporting_time").kendoTimePicker({format: "HH:mm"});	

});
	
	