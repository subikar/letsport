<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$PaymentList=$this->PaymentHistory; 
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10"> 
				<div class="boiteHeader">
					<ol><li><a href="<?php echo $Config->site; ?>invoice" title="Invoice">Invoice</a></li></ol>
    				<h5><span class="fa fa-tasks"></span>Payment History</h5>
  				</div>
  				<div class="line"></div>
  				<div class="boiteContent" id="ContactsView">
    			    <div class="defaultBoxLine">
						<table cellpadding="3" cellspacing="3" width="100%">
							<thead>
								<tr>
								<th>Payment ID</th>
								<th>Payment Type</th>
								<th>User</th>
								<th>create_date</th>
								<th>Amount</th>
								<th>status</th>
							</tr></thead>
							<tbody>
							<?php foreach($this->PaymentHistory as $Payment): ?>
								<tr>
									<td><a href="<?php echo $Config->site."payment-invoice?token=".base64_encode($Payment->id); ?>">#<?php echo $Payment->id; ?></a></td>
									<td><?php echo $Payment->payment_type; ?></td>
									<td><?php echo $Payment->name; ?></td>
									<td><?php echo $Payment->create_date; ?></td>
									<td><span class="add-on currency-sign"><?php echo $Payment->currency; ?></span> <?php echo $Payment->net_amount; ?></td>
									<td><?php echo ($Payment->status==1)? "Completed" : "Failed" ; ?></td>
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
                   $(".editinvoice").colorbox({iframe:true, width:"45%", height:"65%"});	
			});
</script>			