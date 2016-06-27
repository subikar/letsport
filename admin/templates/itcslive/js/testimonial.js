var Testimonial=new function()
{
		this.checkDuplicate=function(input)
		{
			var formURL="index.php?view=testimonial&task=Fn_validate_submitForm";
					jQuery.post(formURL, { client_name: input.value,testimonial_id:jQuery("#testimonial_id").val()},
					function(data){
						//alert(data);
						if(parseInt(data) == 0)
						{
							return true;
						}
						else
						{
							jQuery( "#error_title" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
						}
					});
			
			return false;
		}
		this.validateForm=function(form_input)
		{			
			var formURL="index.php?view=testimonial&task=Fn_validate_submitForm";
					jQuery.post(formURL, { client_name: form_input.client_name.value,testimonial_id:form_input.testimonial_id.value},
					function(data){
						if(parseInt(data) == 0)
						{
							return true;
						}
						else
						{
							jQuery( "#error_title" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
						}
					});
			//return false;
		}
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
		this.GetSelectedUsers=function(e)
		{
			var item = e.item;
  			var text = item.text();
			var formURL="index.php?view=testimonial&task=getUserDetailsByName";
					jQuery.post(formURL, {name:text},
					function(data){
							var result=JSON.parse(data);
							jQuery("#client_phone").val(result.phone);
							jQuery("#client_email").val(result.email);
							jQuery("#client_address").val(result.address);
					});
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
	var filehtml='<div class="add_image"><div id="prevworkBoxDiv1" class="input_browse"><div id="message'+counter+'"></div><label>Gallery#'+counter+': </label><input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Testimonial.uplodeGallery(this,'+counter+');"/></div><img id="img_progress'+counter+'" src="../images/photo_loader.gif" style="width:200px; height:20px; display:none;"/><span class="sp_image_upload"><img id="blah'+counter+'" src="../images/no_image_found.jpg" align="right" style="height:100px; width:100px;" /></span><div class="clear"></div></div>';
	
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

jQuery("#client_name").kendoComboBox({
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
				url: "index.php?view=testimonial&task=getUserForTestimonial",
				method: "post"
			}
		}
	},
	select: function(e) {
	Testimonial.GetSelectedUsers(e);
  }
  });
});
	
	
	