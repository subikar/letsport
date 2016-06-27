<?php 
defined ('ITCS') or die ("Go away.");
global $Config;
$payment=$this->PaymentInvoice;
//print_r($payment); exit;
?>

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10">
            <div class="boiteHeader">
               <h5><span class="fa fa-fw fa-user"></span>Payment: #<?php echo $payment->id; ?></h5>
               <span><a href="<?php echo $Config->site."getpdf?payment_id=".$payment->id; ?>" target="_blank"> <img src="<?php echo $Config->site.'/images/pdf.gif';?>" id="pdf-button" /></a></span> <span><a href="javascript:window.print()"><img src="<?php echo $Config->site.'/images/print.gif';?>" id="print-button" /> </a></span> </div>
            <div class="line"></div>
            <div class="boiteContent">
               <div class="defaultBoxLine4">
                  <div class="logo_min"></div>
                  <div class="company_details">
					 <pre><?php $address="iTCSLive Pvt Ltd. \n17 Prafulla Nagar Dum Dum \nkolkata - 700074, India";  echo $address; ?></pre>
                  </div>
               </div>
			   <div class="line"></div>
			 <div class="defaultBoxLine4">
			 <div class="person_details">
			<pre><?php echo $payment->name."\n".$payment->address; ?></pre>
			 </div>
			 <div class="company_details">
			 <p>Date:<?php echo $payment->payment_date; ?></p>
			 <p>Payment Number:<?php echo $payment->transaction_id; ?></p>
			 <p>Authorization Number:<?php echo $payment->payer_id; ?></p>
			 </div>
			 
			 </div> 
			 <div class="clear"></div>
			 <div class="amount_pay">
			 <p>Amount: <span class="add-on currency-sign"><?php  echo $payment->currency; ?></span><?php echo $payment->net_amount; ?></p>
			 <p>Payment Method:<?php echo $payment->payment_type;  ?></p>
			 <?php if($payment->attachment): ?>
			 <p>Attachment: <?php echo $payment->attachment; ?></p>
			 <?php endif; ?>
			 </div>
            </div>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</div>
