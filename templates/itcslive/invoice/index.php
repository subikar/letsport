<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$Invoice=$this->Invoice;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10"> 
				<div class="boiteHeader">
					<ol>
						<li>
						<?php if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin'):  ?>
							<a href="<?php echo $Config->site; ?>create-invoice" title="Add Invoice">
								<span class="fa add"></span>Add</a>
						<?php  else: ?>
								<span></span>
						<?php  endif;  ?>
						</li>
						<li><a href="<?php echo $Config->site; ?>payment-history" title="Payment History"><span class="fa add"></span>Payment History</a></li>
    				</ol>
    				<h5><span class="fa fa-tasks"></span>Invoices</h5>
  				</div>
  				<div class="line"></div>
  				<div class="boiteContent" id="ContactsView">
    			    <div class="defaultBoxLine">
						<table cellpadding="3" cellspacing="3" width="100%" id="invoice">
							<thead>
								<tr>
								<th>Invoice</th>
								<th>From</th>
								<th>To</th>
								<th>Date</th>
								<th>Balance</th>
								<th>#</th>
							</tr></thead>
							<tbody>
							<?php foreach($this->InvoiceList as $invoice): ?>
								<tr>
									<td><a href="<?php echo $Config->site."invoice/".$invoice->id; ?>">#<?php echo $invoice->id; ?></a></td>
									<td><?php echo $invoice->from_company; ?></td>
									<td><?php echo $invoice->to; ?></td>
									<td><?php echo $invoice->create_date; ?></td>
									<td><span class="add-on currency-sign"><?php echo $invoice->currency; ?></span> <?php echo $invoice->net_amount; ?></td>
									<td>
									<?php if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin'): ?>
									<a title="Edit Invoice" class="icon editinvoice" href="<?php echo $Config->site."modifyinvoice?invoice_id=".$invoice->id; ?>">Update Payment</a><br />
									<a title="Edit Invoice" href="<?php echo $Config->site."create-invoice?id=".$invoice->id; ?>">Modify</a>
									<?php else: ?>
										#
									<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>	
							</tbody>
					</table>	
				</div>
				<div class="clear"></div>
				</div>
		 </div>
         <div class="clear"></div>
      </div>
   </div>
</div>
<script>
$(document).ready(function(){
                   $(".editinvoice").colorbox({iframe:true, width:"500px", height:"550px"});	
			});
</script>			