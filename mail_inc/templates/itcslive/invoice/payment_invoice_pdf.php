<?php 
defined ('ITCS') or die ("Go away.");
global $Config;
?>

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10">
		 <div class="companylogo"><img src="<?php echo $Config->site.'templates/itcslive/css/images/itcs-logo_pdf.jpg'; ?>" /></div>
            <div class="boiteHeader">
               <h5 style="background:#CCCCCC; padding:5px;">Payment: #<?php echo $payment->id; ?></h5>
                </div>
            <div class="line"></div>
            <div class="boiteContent">
			
               <div class="defaultBoxLine">
                  <div class="logo_min"></div>
                  <div align="right">
					 <pre><?php $address="iTCSLive Pvt Ltd. \n17 Prafulla Nagar Dum Dum \nkolkata - 700074, India";  echo $address; ?></pre>
                  </div>
               </div>
			   <div class="line"></div>
			 <div class="defaultBoxLine">
			 <div align="left">
			<pre><?php echo $payment->name."\n".$payment->address; ?></pre>
			 </div>
			 <div align="right">
			  <h5 style="background:#CCCCCC; padding:5px;">Payment Details</h5>
			 <p>Date:<?php echo $payment->payment_date; ?></p>
			 <p>Payment Number:<?php echo $payment->transaction_id; ?></p>
			 <p>Authorization Number:<?php echo $payment->payer_id; ?></p>
			 </div>
			 <div style="border: 1px solid #FFFFFF;">
			 <p>Amount: $<?php echo $payment->net_amount; ?></p>
			 <p>Payment Method:<?php echo $payment->payment_type;  ?></p>
			 </div>
			 </div> 
            </div>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</div>
