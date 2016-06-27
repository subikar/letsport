<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config,$params;

$post=IRequest::get("POST");
$paramsInArray=$params->getParams("payment");
$MERCHANT_KEY =trim($paramsInArray["payu_key"]);
$SALT = trim($paramsInArray["payu_salt"]);
if($paramsInArray["payu_st"] == "Live"):
	$PAYU_BASE_URL = "https://secure.payu.in";
else:
	$PAYU_BASE_URL = "https://test.payu.in";
endif;

$Item_name="ITCSLive Invoice For #:".$my->name;
$txnid= substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$post_extra=array(
								"key"=>$MERCHANT_KEY,
								"txnid"=>$txnid,
								"amount"=>$this->total_amount,
								"productinfo"=>$Item_name,
								"surl"=>$Config->site."successpayu",
								"furl"=>$Config->site."paymentsuccess",
								"service_provider"=>"payu_paisa",
								"curl"=>$Config->site."paymentsuccess",
								"udf1"=>$my->uid,
								"udf2"=>$my->name
							);
$post=array_merge($post,$post_extra);

$action = '';
$posted = array();
if(!empty($post)) {
  foreach($post as $key => $value) {     
    $posted[$key] = $value; 
  }
}

$formError = 0;
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
	if(empty($posted['hash']) && sizeof($posted) > 0) 
	{
	  if(
			  empty($posted['key'])
			  || empty($posted['txnid'])
			  || empty($posted['amount'])
			  || empty($posted['firstname'])
			  || empty($posted['email'])
			  || empty($posted['phone'])
			  || empty($posted['productinfo'])
			  || empty($posted['surl'])
			  || empty($posted['furl'])
			  || empty($posted['service_provider'])
	  ) {
		$formError = 1;
	  } else {
		$hashVarsSeq = explode('|', $hashSequence);
		$hash_string = '';	
			foreach($hashVarsSeq as $hash_var)
			{
			  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			  $hash_string .= '|';
			}
	
		$hash_string .= $SALT;
		$hash = strtolower(hash('sha512', $hash_string));
		$action = $PAYU_BASE_URL . '/_payment';
	  }
	} 
	elseif(!empty($posted['hash'])) 
	{
	  $hash = $posted['hash'];
	  $action = $PAYU_BASE_URL . '/_payment';
	}
?>
  
<div id="primary">
<div role="main">
  <div class="article-body">
	 <div class="padDiv row10">
	  <h4> Please do not close this window or click the Back button on your browser.</h4>
            <div class="processing_div"> <img src="<?php echo $Config->site."images/processing_wait.gif" ?>" alt="Processing....." /> <br />
         </div>
		<div class="paypal_form">
		<form action="<?php echo $action; ?>" method="post" name="payuForm"> 
		   <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
		   <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
		   <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
		   <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? $this->total_amount : $posted['amount'] ?>" />
		 	<input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname'] ?>" />
			<input type="hidden" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname'] ?>" />
			<input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email'] ?>" />
		  	<input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone'] ?>" />
		   <textarea name="productinfo" style="display:none;"><?php echo (empty($posted['productinfo'])) ? $Item_name : $posted['productinfo'] ?></textarea>
		   <input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? $Config->site."successpayu" : $posted['surl'] ?>" size="64" />
		   <input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? $Config->site."paymentsuccess" : $posted['furl'] ?>" size="64" />
		   <input type="hidden" name="service_provider" value="<?php echo (empty($posted['service_provider'])) ? 'payu_paisa' : $posted['service_provider'] ?>" size="64" />
		   <input type="hidden" name="curl" value="<?php echo (empty($posted['curl'])) ? $Config->site."paymentsuccess" : $posted['curl'] ?>" />
		 	<input type="hidden" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
		 	<input type="hidden" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
			<input type="hidden" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
			<input type="hidden" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
			<input type="hidden" name="country" value="<?php echo (empty($posted['country'])) ? $my->country : $posted['country']; ?>" />
			<input type="hidden" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
			<input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
			<input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
			<input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
			<?php if(!$hash) { ?>
			<input type="image" src="<?php echo $Config->site; ?>images/PayUMoney_logo.png" name="submit" />
			<?php } ?>
		</form>
		</div>
	 </div>
<div class="clear"></div>	 
  </div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
   setTimeout(function(){submitPayuForm(); }, 300);			   
});
 var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }			
</script>
