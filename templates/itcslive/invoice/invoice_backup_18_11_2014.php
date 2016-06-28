<?php
	//error_reporting(0);
	//defined ('ITCS') or die ("Go away.");
	$Invoice=isset($this->Invoice) ? $this->Invoice : $invoice;
	global $Config;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
<div class="padDiv row10 total_image_body">
  <div class="boiteHeader">
    <h5><span style="color:#fff;" class="fa fa-fw fa-user-1"></span> Invoice: #<?php echo $Invoice->id; ?></h5>
	<ul>
	<li><a href="javascript:window.print()"><img src="<?php echo $Config->site.'/images/print.gif';?>" id="print-button" />
		</a></li>
	<li><a href="<?php echo $Config->site.'getpdf?invoice_id='.$Invoice->id; ?>" target="_blank">
		<img src="<?php echo $Config->site.'/images/pdf.gif';?>" id="pdf-button" /></a></li>
	</ul>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
        <div class="invoice_bind">
		<div class="invoice_to-1">
	<?php $logoImage=(strcasecmp($Invoice->from_company,"joomspot")==0) ? "images/joomspot-logo-small.jpg": "images/logo.png"; ?>	   
		   <div class="logo_company"><img src="<?php echo $Config->site.$logoImage;?>" alt="" /></div>
		   <?php if(strcasecmp($Invoice->from_company,"joomspot")==0){?><p>Your Web Business Guru</p> <?php } ?>
		   </div>
		
		<div class="invoice_to-2">
		   <div class="own_address">
		   		<?php echo "<pre>".$Invoice->from."</pre>"; ?>
		   </div>
		</div>
	</div>	
		<div class="clear"></div>
			<ul class="invoice_numbers clearfix">
				<li>Invoice To :</li>
				<li>Invoice ID : <?php echo $Invoice->id; ?></li>
				<div class="clear"></div>
				<li>&nbsp;</li>
				<li>Date: 17/11/2014</li>
			</ul>
			<!--<ul class="invoice_numbers clearfix"><li>Company / Client Name</li></ul>	
			<ul class="invoice_numbers clearfix"><li style="border-bottom:1px dashed"></li></ul>-->
			 <?php  $to=str_replace( ",","<br>",$Invoice->to);  echo "<pre>".$to."</pre>"; ?>
			<!--<ul class="invoice_numbers clearfix"><li>Address</li></ul>-->
			<ul class="invoice_numbers clearfix"><li style="border-bottom:1px dashed"></li></ul>
		<?php // echo $Invoice->invoice_date; ?>
	    	
		<div class="invoced_company_details">
		   <div class="numberdate">
		     <!--<div class="date"><span>Due Date</span>:<?php // echo $Invoice->due_date; ?></div>-->
			 <div class="clear"></div>
		   </div>
		</div>
		
<div class="clear"></div>


		

			<div class="table_invoice">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="20%" height="25">Service Type</td>
								<td width="20%" height="25">Quantity</td>
								<td width="20%" height="25">Rate</td>
								<td width="20%" height="25" class="last">Amount</td>
							</tr>
							<?php 
							$Summary=json_decode($Invoice->invoice_details);
							for($i=0; $i<count($Summary->qty); $i++):
							?>
							<tr>
								<td width="20%" height="25"><?php echo $Summary->description[$i]; ?></td>
								<td width="20%" height="25"><?php echo $Summary->qty[$i]; ?></td>
								<td width="20%" height="25"><?php echo $Invoice->currency; ?> <?php echo $Summary->rate[$i]; ?></td>
								<td width="20%" height="25"><?php echo $Invoice->currency; ?> <?php echo $Summary->part_total[$i]; ?></td>
							</tr>
							<?php endfor; ?>
						</table>
				</div>
	
			<div class="clear"></div>
              <div class="table_invoice1 clearfix">
						<table width="100%" cellpadding="0" cellspacing="0" class="clearfix">
							<tr>
							<td width="50%" height="25">
								Subtotal
								</td>
								<td width="50%" height="25">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->subtotal; ?>
								</div>
							</td>
							</tr>
							<tr>
								<td width="50%" height="25">Tax</td>
								<td width="50%" height="25">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->tax; ?>
								</div>
								</td>
							</tr>
							<tr>
  								<td width="50%" height="25">Amount Paid</td>
								<td width="50%" height="25">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->amount_paid; ?>
								</div>
								</td>
							</tr>
							<tr>
								<td width="50%" height="25">Balance</td> 
								<td width="50%" height="25" class="last1">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->net_amount; ?>
								</div>
								</td>
							</tr>
						</table>
				</div>
				<div class="clear"></div>
				
				<div class="additional_1">
				<span>Additional Notes:</span>
				<p><?php echo $Invoice->notes; ?></p>
				</div>
				
				<div class="bottom_area">
				<p>*Please write cheque in favor of "<strong><?php echo strtoupper($Invoice->from_company); ?></strong>"</p>
				</div>
		
		<div class="clear"></div>
		<div class="address1">
			<h6>JoomSpot</h6>
			<p>17 Prafulla Nagar Dum Dum Private Road Kolkata – 700074<br />
				Email : <a href="#">info@joomspot.com</a> / <a href="#">info@itcslive.com</a> Website: <a href="#">www.joompsot.com / <a href="#">www.itcslive.com</a><br />
				Phone: 03368888449 / 9836892283 <br/>
				<span>JoomSpot Is a Sister concern of ITCSLive India Pvt Ltd</span>
			</p>
		</div>
		
	  </div>
	</div>
	<div class="clear"></div>
	  </div>
   </div>
</div>

