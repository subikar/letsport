<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config,$params;
$paramsInArray=$params->getParams("payment");
	if($paramsInArray["paypal_st"]=="Live"):
		$link='https://www.paypal.com';
	else:
		$link='https://www.sandbox.paypal.com/cgi-bin/webscr';
	endif;
	
$userid=$my->uid;	
$currencyCode=$paramsInArray["paypal_currency_code"];
$currencySymbol=$paramsInArray["paypal_currency_symbol"];
$paypalId=$paramsInArray["paypal_id"];
$tax=$paramsInArray["plan_rate"];

$notifyUrl=$Config->site."returnPaypal";
$return=$Config->site."paymentsuccess";

$path="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif";
$Item_name="ITCSLive Invoice For #:".$my->name;
$total=$this->total_amount;
?>

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10">
            <div class="processing_div"><img src="<?php echo $Config->site."images/processing_wait.gif" ?>" alt="Processing....." /> <br />
               <h4> Please do not close this window or click the Back button on your browser.</h4>
            </div>
			<div class="paypal_form">
			<form name="Paypalform" id="Paypalform" method="post" action="<?php echo $link;?>">
			   <input name="cmd" value="_xclick" type="hidden" />
			   <input name="item_name" value="<?php echo $Item_name; ?>" type="hidden" />
			   <input name="item_number" value="1" type="hidden" />
			   <input name="amount" id="amount" value="<?php echo $total; ?>" type="hidden" />
			   <input name="currency_code" value="USD" type="hidden" />
			   <input name="tax" value="<?php echo $tax; ?>" type="hidden" />
			   <input name="custom" id="custom" value="<?php echo $userid; ?>" type="hidden" />
			   <input name="business" value="<?php echo $paypalId;?>" type="hidden" />
			   <input name="notify_url" value="<?php echo $notifyUrl; ?>" type="hidden" id="notify_url" />
			   <input name="return" id="return" value="<?php echo $return; ?>" type="hidden" />
			   <input type="image" src="<?php echo $path;?>" name="submit"/>
			</form>
			</div>
         </div>
	<div class="clear"></div>	 
      </div>
   </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
                   setTimeout(function(){document.Paypalform.submit(); }, 3000);
			});
</script>
