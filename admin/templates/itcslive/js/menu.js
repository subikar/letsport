var Menu=new function()
{
		this.showMenu=function(inputObj)
		{
			var formURL="index.php?view=menu&task=Fn_getMenubyType";
					jQuery.post(formURL, { typeName:inputObj.value},
					function(data){
						//alert(data);
						var result=JSON.parse(data,'true');
                  	jQuery('#menuItem option[value!="0"]').remove();
 						for(var i=0; i<result.length;i++)
						{
						var opt = document.createElement('option');
						document.getElementById("menuItem").options.add(opt);
						opt.value = result[i]["seo"];
						opt.text = result[i]["Title"];                      
                  		} 
						
					});
		}
		this.PopulateData=function(inputObj)
		{
			obj = $('#menuItem :selected');
				jQuery("#title").val(obj.text());
				jQuery("#alias").val(obj.val());
		}
		this.checkDuplicate=function(input)
		{
			if(input.value =="")
			{
				jQuery( "#error_alias" ).text( "Alias Blank!" ).show().fadeOut( 10000 );	
				return false;
			}
			else
			{
			var formURL="index.php?view=menu&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias:input.value},
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
			
			return false;
			}
		}
		this.validateForm=function(form_input)
		{
			
				var formURL="index.php?view=menu&task=Fn_validate_submitForm";
					jQuery.post(formURL, { alias: form_input.alias.value},
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
}