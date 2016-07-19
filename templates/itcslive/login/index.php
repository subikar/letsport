<?php
  defined ('ITCS') or die ("Go away.");
  if($_GET['error'] == '11'):
?>
<div id="error_msg" style="color:#FF0000">The Email or Password you entered is incorrect.</div>
<?php endif; 
	if($_GET['error'] == '01'):	?>
<div id="error_msg" style="color:#FF0000">Please Enter your Email.</div>
<?php endif; 
	if($_GET['error'] == '02'):	?>
<div id="error_msg" style="color:#FF0000">Please Enter your Password.</div>
<?php endif; ?>
<div id="Error_massege"></div>
<div class="login_first">
<form action="" method="post" name="loginform" id="form">
        <ul>
		<li><label class="name">          
		<input requred="true" class="boxinputbig" placeholder="Enter Email or Phone Number" id="email" name="email" type="text">
        </label></li>
        <li><label class="name">          
          <input requred="true" class="boxinputbig" placeholder="Enter Password" id="password" name="password" type="password">
        </label></li>
		</ul>
        <input value="login" name="view" type="hidden">
        <input value="checklogin" name="task" type="hidden">
		
<!--	<input value="Login" name="submit" type="submit" class="button-1">	-->
		
</form>
</div>
	<div class="login_div">
	<input value="Login" name="submit" type="submit" class="add_ticket_btn" onclick="Login.submitform('form');">	
	
	<!--<input value="Login" name="submit" type="submit" class="button-1">-->
	<P class="forgotpass" style="float:left"> <a href="forgotpass">Forgot Password ?</a> | <a href="customer-signup" target="parent">Customer Register</a> | <a href="transporter-signup" target="parent">Transporter Register</a></P>
   	</div>
	
<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"250px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"250px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"40%", height:"250px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"80%", height:"250px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"250px"});
		}
});
</script>
