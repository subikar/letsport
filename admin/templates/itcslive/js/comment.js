var Comment=new function()
{
		this.checkDuplicate=function(input)
		{
			return true;
			/*var formURL="index.php?view=comment&task=Fn_validate_submitForm";
					jQuery.post(formURL, { name: input.value,comment_id:jQuery("#comment_id").val()},
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
			
			return false;*/
		}
		this.validateForm=function(form_input)
		{	
			return true;
			/*var formURL="index.php?view=comment&task=Fn_validate_submitForm";
					jQuery.post(formURL, { name: form_input.name.value,comment_id:form_input.comment_id.value},
					function(data){
						if(parseInt(data) == 0)
						{
							return true;
						}
						else
						{
							jQuery( "#error_title" ).text( "Already Exist!" ).show().fadeOut( 10000 );	
						}
					});*/
		}
}

jQuery(document).ready(function() {
	jQuery('.chk_boxes').click(function(){
		var chk = jQuery(this).attr('checked')?true:false;
		jQuery('.chk_boxes1').attr('checked',chk);
		});
	tinymce.init({
		selector: ".tinyEditor"
	 });							
});
	
	
	