<?php
	$Invoice=isset($this->Invoice) ? $this->Invoice : $invoice;
	global $Config;
?>

<div class="total_pdf" style="">
   <div class="padDiv row10 pdf">
      <div class="pdfHeader">
	  
	  <div class="invoice_bind">
	  
	  <div id="invoice_to-1">
	  <?php $logoImage=(strcasecmp($Invoice->from_company,"joomspot")==0) ? "images/joomspot-logo-small.jpg": "images/logo.png"; ?>
	  <div class="logo_company"><img src="<?php echo $Config->site.$logoImage;?>" width="273" height="61" /></div>
	  <?php if(strcasecmp($Invoice->from_company,"joomspot")==0){?><p>Your Web Business Guru</p> <?php } ?>
	  </div>
	  <div class="line_1"></div>
	  
	  <div id="invoice_to-2">
		   <div class="own_address">
		   		<?php echo "<pre>".$Invoice->from."</pre>"; ?>
		   </div>
		</div> 
		 
	</div>
	<div class="clear"></div>
	
	<div id="invoice_to-3">
			Invoice To :
			<?php  $to=str_replace( ",","<br>",$Invoice->to);  echo "<pre>".$to."</pre>"; ?>
				
	</div> 
	
	<div id="invoice_to-4">
		<ul class="invoice_numbers clearfix">
				<li>Invoice ID :<?php echo $Invoice->id; ?></li>
				<li>Date : <?php echo date('d M Y',strtotime($Invoice->invoice_date));?></li>
			</ul>
	</div>
	
	
	<div id="table_invoice">
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
		<td width="20%" height="25" class="last"><?php echo $Invoice->currency; ?> <?php echo $Summary->part_total[$i]; ?></td>
		</tr>
	<?php endfor; ?>
	</table>
				</div>
	
			<div class="clear"></div>
              <div id="table_invoice1">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
							<td width="50%" height="25">Sub Total</td>
							<td width="50%" height="25" class="last1">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->subtotal; ?>
								</div>
							</td>
							</tr>
							<tr>
								<td width="50%" height="25">Tax</td>
								<td width="50%" height="25" class="last1">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->tax; ?>
								</div>
								</td>
							</tr>
							<tr>
  								<td width="50%" height="25">Amount Paid</td>
								<td width="50%" height="25" class="last1">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->amount_paid; ?>
								</div>
								</td>
							</tr>
							<?php if($Invoice->deduction > 0): ?>
							<tr>
  								<td width="50%" height="25">Deduction Amount * </td>
								<td width="50%" height="25" class="last1">
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>
									<?php echo $Invoice->deduction; ?>
								</div>
								</td>
							</tr>
							<?php endif; ?>
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
			<br />
		
		<div id="additional_1">
				<span>Additional Notes:</span>
				<div class="additional_1_line"></div>
				<div class="additional_1_detail"><?php echo $Invoice->notes; ?></div>
		</div>
				
			<div class="bottom_area">
			<?php if(isset($Invoice->deduction_history) && $Invoice->deduction >0): ?>*
			<?php foreach($Invoice->deduction_history as $deduction): ?>
			<p>Amount Deducted On <?php echo date('d M Y',strtotime($deduction->created_on));?> <span class="add-on currency-sign"><?php echo $Invoice->currency; ?></span>  <?php echo $deduction->deduction_amount; ?> For <small><?php echo nl2br($deduction->deduction_notes); ?></small></p>  
			<?php endforeach; ?>
			<?php endif; ?>
			</div> 
				<div class="bottom_area_line"></div>
				<div class="clear"></div>
		<div class="address1">
			<h4>JoomSpot</h4>
			<p>17 Prafulla Nagar Dum Dum Private Road Kolkata - 700074<br />
				Email : <a href="mailto:info@joomspot.com">info@joomspot.com</a> / <a href="mailto:info@itcslive.com">info@itcslive.com</a> Website: <a href="http://www.joomspot.com">www.joompsot.com / <a href="http://www.itcslive.in">www.itcslive.in</a><br />
				<span>JoomSpot Is a Sister concern of ITCSLive India Pvt Ltd</span>
			</p>
		</div>
		
	
   </div>
</div>
