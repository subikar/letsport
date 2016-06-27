<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config,$params;
	$paramsInArray=$params->getParams("payment");
	$payment_option=$paramsInArray["payment_option"];
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10">
            <div class="boiteHeader">
               <h5>Product Description:</h5>
               <div class="companylogo"></div>
            </div>
            <div class="line"></div>
            <div class="boiteContent">
                  <ul>
                     <li><span>Amount Need To Pay : </span>
					 <span class="add-on currency-sign">INR</span><?php echo $this->paymentAmount->totalINR; ?>
					 <span class="add-on currency-sign">$</span><?php echo $this->paymentAmount->totallDoller; ?>
					 </li>
                  </ul>
            </div>
            <div class="line"></div>
            <div class="payment_option"> Select Payment Method:
               <div class="line"></div>
               <form name="PaymentForm" method="post" id="PaymentForm">
                  <div class="each_option">Payment Amount: <span id="currency-sign">$</span>
                     <input type="text" name="total_amount"  value="<?php echo $this->paymentAmount->totalDue; ?>" required="true" />
                  </div>
				  <?php if(in_array("Payu",$payment_option)): ?>
				   <div class="each_option">
                     <input type="radio" name="payment_method" value="payu" onclick="getFieldsForOption(this.value);" />PayU Money
					 <span id="payu_fields" style="display:none;"></span>
					</div>
				<?php endif; ?>	
				  <?php if(in_array("Paypal",$payment_option)): ?>
                  <div class="each_option">
                     <input type="radio" name="payment_method" value="paypal" onclick="getFieldsForOption(this.value);" />Paypal
				  </div>
				  <?php endif; ?>	
				 <?php if(in_array("ccavenue",$payment_option)): ?>
                  <div class="each_option">
                     <input type="radio" name="payment_method" value="ccavenue" />CCAvenue
				  </div>
				  <?php endif; ?>	
                  <input type="hidden" name="view" value="payment" />
                  <input type="hidden" name="task" value="ProcedWithPaymentGateway"  />
               </form>
               <div class="each_option" align="right">
                  <input type="button" value="Continue" onclick="validatePayment();"/>
             </div>
            </div>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</div>
<?php $userName=explode(" ",trim($my->name)); ?>
<div id="PayUFields" style="display:none;">
<fieldset>
<legend>Please fill up this fields.</legend>
<div class="each_option" id="error_payu" style="display:none;"></div>
<div class="each_option">First Name: <input type="text" name="firstname" id="firstname" value="<?php echo $userName[0]; ?>" />*</div>
<div class="each_option">Last Name: <input type="text" name="lastname" id="lastname" value="<?php echo $userName[1]; ?>" /></div>
<div class="each_option">Email: <input type="text" name="email" id="email" value="<?php echo $my->email ; ?>" />*</div>
<div class="each_option">Phone: <input type="text" name="phone" value="<?php echo $my->phone; ?>" />*</div>
<div class="each_option">Address1: <input type="text" name="address1" value="<?php echo $my->address; ?>" /></div>
<div class="each_option">Address2: <input type="text" name="address2" value="" /></div>
<div class="each_option">City: <input type="text" name="city" value="<?php echo $my->city; ?>" /></div>
<div class="each_option">State: <input type="text" name="state" value="<?php echo $my->state; ?>" /></div>
<div class="each_option">Country: <input type="text" name="country" value="<?php echo $my->country; ?>" /></div>
<div class="each_option">Zip: <input type="text" name="zipcode" value="<?php echo $my->zip; ?>" /></div>
</fieldset>
</div>
<script type="text/javascript">
function validatePayment()
{
	var formobj=document.getElementById("PaymentForm");
	var paymethod = document.getElementsByName("payment_method");
	var selectedMethod="";
		for(var i = 0; i < paymethod.length; i++) {
		   if(paymethod[i].checked == true) {
			   selectedMethod = paymethod[i].value;
		   }
		 }
		 
	if(!(parseFloat(formobj.total_amount.value) > 1) ){ alert("This is Not a Valid Amount"); return false; }
	else if(selectedMethod!="" && selectedMethod=='payu'){
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if(formobj.firstname.value=="")
		{
			jQuery("#error_payu").html("Please fillup first name!").fadeIn('slow');
			formobj.firstname.focus();
		}
		else if(formobj.email.value=="" || !regex.test(formobj.email.value))
		{
			jQuery("#error_payu").html("Invalid email!").fadeIn('slow');
			formobj.email.focus();
		}
		else if(formobj.phone.value=="" || isNaN(formobj.phone.value) || !formobj.phone.value.match(phoneno))
		{
			jQuery("#error_payu").html("Invalid phone!").fadeIn('slow');
			formobj.phone.focus();
		}
		else
		{
			document.PaymentForm.submit();
		}
	}
	else if(selectedMethod!="" && selectedMethod!='payu'){ 
	document.PaymentForm.submit(); 
	} else { 
	alert("Please Select Payment Method"); return false; 
	}
}
function getFieldsForOption(method)
{
	if(method=='payu')
	{
		var fields=jQuery("#PayUFields").html(); 
		jQuery("#payu_fields").html(fields).fadeIn('slow');
		jQuery("#currency-sign").html("INR");		
	}
	else
	{
		jQuery("#payu_fields").html("");
		jQuery("#currency-sign").html("$");		
	}
}
</script>
<style>
.each_option{ float:left; width:70%; padding:5px;}
#payu_fields fieldset{ margin:15px;}
</style>