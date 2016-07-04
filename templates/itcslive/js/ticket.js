var ticket = new function()
{	alert("input");
	this.SubmitForm=function(input_id)
	  {		alert("input");
		  var input=document.getElementById(input_id);
		  
		  input.submit();
	  }
	  
}