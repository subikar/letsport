
var Blog=new function()
{
		this.checkDuplicate=function(input)
		{
			var formURL="index.php?view=blog&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias: input.value, blog_id: jQuery("#blog_id").val()},
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
			
			//return false;
		}
		this.validateForm=function(form_input)
		{
			
			var formURL="index.php?view=blog&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias: form_input.alias.value,blog_id:form_input.blog_id.value},
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
			//return false;
		}
		 this.uplodeGallery=function(input,id)
			{
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
	tinymce.init({
	selector: "#content",
	plugins: "preview",
    toolbar: "preview",
	theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]

	});
	
	
//////FOR IMAGE UPLODE SECTION////////
	var counter = 2;
    jQuery("#addButton").click(function () {
	if(counter>10){
            alert("Only 10 file allow");
            return false;
	}  
	var filehtml='<div class="add_image"><div id="prevworkBoxDiv1" class="input_browse"><div id="message'+counter+'"></div><label>Gallery#'+counter+': </label><input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Blog.uplodeGallery(this,'+counter+');"/></div><span class="sp_image_upload"><img id="blah'+counter+'" src="../images/no_image_found.jpg" align="right" style="height:100px; width:100px;" /></span><div class="clear"></div></div>';
	
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
	
	
	