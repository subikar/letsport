var Category=new function()
{
	this.checkDuplicate=function(input)
	{
		var formURL="index.php?view=category&task=Fn_validate_submitForm";
				jQuery.post(formURL, { type: input.value,category_id:jQuery("#category_id").val()},
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
		
		return false;
	}
		this.validateForm=function(form_input)
		{			
			var formURL="index.php?view=category&task=Fn_validate_submitForm";
			jQuery.post(formURL, { type: form_input.type.value,category_id:form_input.category_id.value},
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
	