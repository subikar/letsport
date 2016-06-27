var Login = new function()
{
	this.submitform = function(id)
	{
		var input = document.getElementById(id);
		jQuery('#Error_massege').css('color','red');
		if(input.email.value == '')
		{
			jQuery('#Error_massege').html("Please Enter your Email.");
			jQuery('#email').focus();
		}
		else if(input.password.value == '')
		{
			jQuery('#Error_massege').html("Please Enter your Password.");
			jQuery('#password').focus();
		}
		else
		{
			var formURL="login?view=login&task=checkLoginDetails";
			jQuery.post(formURL, { email:input.email.value,password:input.password.value},
			function(data){
				var result=JSON.parse(data);
				if(!isNaN(parseInt(result)))
				{
					jQuery("#"+id).submit();
				}
				else
				{
					jQuery('#Error_massege').html("The Email or Password you entered is incorrect.");
					jQuery('#password').val("");
					jQuery('#email').focus();
				}
			});
		}
	}
}