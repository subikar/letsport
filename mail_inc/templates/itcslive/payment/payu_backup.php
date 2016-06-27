<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config;
// Merchant key here as provided by Payu
$MERCHANT_KEY = "JBZaLc";

// Merchant Salt as provided by Payu
$SALT = "GQs7yium";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$Item_name="ITCSLive Invoice For #:".$my->name;
$total=$this->total_amount;
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$posted=array(
								"key"=>$MERCHANT_KEY,
								"txnid"=>$txnid,
								"amount"=>$this->total_amount,
								"productinfo"=>$Item_name,
								"firstname"=>"Subikar",
								"lastname"=>"Burman",
								"email"=>"subikar.web@gmail.com",
								"phone"=>"9836892283",
								"surl"=>$Config->site."successpayu",
								"furl"=>$Config->site."paymentsuccess",
								"service_provider"=>"payu_paisa",
								"curl"=>$Config->site."paymentsuccess",
								"address1"=>"17 Praffulla nagar DUmdum kiolkata",
								"address2"=>"",
								"city"=>"Kolkata",
								"state"=>"West Bengal",
								"zipcode"=>"700074",
								"udf1"=>$my->uid,
								"udf2"=>$my->name
							);




$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
	
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
				   <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
				   <input type="text" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname'] ?>" />
				   <input type="text" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname'] ?>" />
				   <input type="text" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email'] ?>" />
				   <input type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone'] ?>" />
				   <textarea name="productinfo" style="display:none;"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
				   <input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
				   <input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
				   <input type="hidden" name="service_provider" value="<?php echo (empty($posted['service_provider'])) ? '' : $posted['service_provider'] ?>" size="64" />
				   <input type="hidden" name="curl" value="<?php echo (empty($posted['curl'])) ? '' : $posted['curl'] ?>" />
				   <input type="hidden" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
					<input type="hidden" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
					<input type="hidden" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
					<input type="hidden" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
					<input type="hidden" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
					<input type="hidden" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
					<input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
					<input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
					<input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
				   <input type="image" src="<?php echo $Config->site; ?>images/PayUMoney_logo.png" name="submit"/>
				</form>
			</div>
         </div>
	<div class="clear"></div>	 
      </div>
   </div>
</div>
<!--<script type="text/javascript">
jQuery(document).ready(function(){
                   setTimeout(function(){document.payuForm.submit(); }, 3000);
			});
</script>-->
