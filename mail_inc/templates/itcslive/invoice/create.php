<?php
	//error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my,$params;
	$paramsInArray=$params->getParams("invoice");
	$companyAddress=$paramsInArray["invoice_comp_address"];
	//print_r($this->InvoiceDetails); exit;
?> 
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
<div class="padDiv row10">
<form name="invoiceForm" method="post" id="invoiceForm">
  <div class="boiteHeader">
    <h5><span class="fa fa-fw fa-user"></span> Create Invoice </h5>
  </div>
  <div class="line"></div>
  <div class="boiteContent">
        <div class="invoice_bind">
		<div class="invoice_to">
		   <span>From</span>
		   <select name="from_company">
		   <?php foreach($paramsInArray["invoice_company"] as $comp): ?>
		   	<option value="<?php echo $comp; ?>"><?php echo $comp; ?></option>
		   <?php endforeach; ?>
		   </select>
		   <div class="clear"></div>
		   <textarea name="from"><?php echo isset($this->InvoiceDetails->from)?$this->InvoiceDetails->from:$companyAddress; ?></textarea>
		</div>
		<div class="invoice_to">
		   <span>Client</span>
		   <div class="clear"></div>
		   <textarea style="background:#fff; width:99%; height:65px;" name="to" id="adress_to" ><?php echo $this->InvoiceDetails->to ?></textarea>
		   <input type="hidden" name="user_id" value="<?php echo $this->InvoiceDetails->user_id ?>" id="assign_to" />
		</div>
		<p class="searchcustomer">Select Customer Invoice <input type="text" name="customer_name" class="customer_name"  value=""/> <input type="button" name="Search" value="Search Customer" class="search_customer" />
		<div id="search_customers"></div>
		</p>
	    </div>	
		<div class="invoced_company_details">
		   <div class="companylogo"></div>
		   <div class="clear"></div>
		   <div class="numberdate">
		     <div class="invoice_inputs"><span>Invoice Number</span><input type="text" class="input_boxes" name="invoice_id" value="<?php echo $this->InvoiceNo; ?>"/></div>
		     <div class="invoice_inputs"><span>Date: </span><input type="text" name="invoice_date" value="<?php echo isset($this->InvoiceDetails->invoice_date)?$this->InvoiceDetails->invoice_date:date("Y-m-d"); ?>" id="invoice_date" class="invoice_inputs1" /></div>
		     <div class="invoice_inputs"><span>Due Date: </span><input type="text" name="due_date" id="duedate" value="<?php echo isset($this->InvoiceDetails->due_date)?$this->InvoiceDetails->due_date:date("Y-m-d"); ?>" class="invoice_inputs1" /></div>
			 <div class="invoice_inputs"><span>Select Currency: <select class="input_boxes" name="currency" id="currency"><option value="$" <?php echo ($this->InvoiceDetails->currency == '$')?'selected="selected"':''; ?> >$</option><option value="INR" <?php echo ($this->InvoiceDetails->currency == 'INR')?'selected="selected"':''; ?>>INR</option></select></span></div>
			 <div class="clear"></div>
		   </div>
		</div>
		
<div class="clear"></div>
<div class="invoice">
			<table id="item-totals">
					<thead>
						<tr id="theadline">
							<th class="delete"></th>
							<th class="description">
							   Description
							</th>
							<th class="qty"> 
							   Qty
							</th>
							<th class="rate">
							   Rate
							</th>
							<th class="amount">
							  Amount
							</th>
						</tr>
					</thead>
					<tbody>
<?php if($this->InvoiceDetails->invoice_details == ''):?>					
						<tr class="item-row" id="item_row">
							<td></td>
							<td class="description">
								<input type="text" class="item-calc input" name="summary[description][]" placeholder="Product description.." />
							</td>
							<td class="qty">
								<input type="text" class="item-calc-qty" name="summary[qty][]" placeholder="0" onkeyup="Invoice.calculate();"/>
							</td>
							<td class="rate">
								<div class="input-prepend">
									<span class="add-on currency-sign">$</span>
									<input class="item-calc-rate" type="text" name="summary[rate][]" placeholder="0.00" onkeyup="Invoice.calculate();" />
								</div>
							</td>
							<td class="amount">
								<div class="input-prepend">
									<span class="add-on currency-sign">$</span>
									<input class="item-calc-part_total" type="text" placeholder="0.00" name="summary[part_total][]" readonly="true" onclick="Invoice.calculate();"/>
								</div>
							</td>
					</tr>
<?php else: 
  $invoicedetails = json_decode($this->InvoiceDetails->invoice_details);
  $CountOfItems = count($invoicedetails->description); 
  for($Counter=0;$Counter<$CountOfItems;$Counter++)
   {
?>
						<tr class="item-row" id="item_row">
							<td></td>
							<td class="description">
								<input type="text" class="item-calc input" name="summary[description][]" placeholder="Product description.." value="<?php echo $invoicedetails->description[$Counter]; ?>" />
							</td>
							<td class="qty">
								<input type="text" class="item-calc-qty" name="summary[qty][]" placeholder="0" onkeyup="Invoice.calculate();" value="<?php echo $invoicedetails->qty[$Counter]; ?>"/>
							</td>
							<td class="rate">
								<div class="input-prepend">
									<span class="add-on currency-sign"><?php echo $this->InvoiceDetails->currency; ?></span>
									<input class="item-calc-rate" type="text" name="summary[rate][]" placeholder="0.00" onkeyup="Invoice.calculate();" value="<?php echo $invoicedetails->rate[$Counter]; ?>" />
								</div>
							</td>
							<td class="amount">
								<div class="input-prepend">
									<span class="add-on currency-sign"><?php echo $this->InvoiceDetails->currency; ?></span>
									<input class="item-calc-part_total" type="text" placeholder="0.00" name="summary[part_total][]" readonly="true" onclick="Invoice.calculate();" value="<?php echo $invoicedetails->part_total[$Counter]; ?>"/>
								</div>
							</td>
					</tr>

<?php } ?>  
<?php endif; ?>					
		</tbody>
</table>
<div class="clear"></div>
	<input type="button" class="btn btn-info" id="tr-addItem" value="+ Line" />
	<input type="button" class="btn btn-info" id="tr-removeItem" value="- Line" />
	<!--<button class="btn btn-info" id="tr-addItem">
		<span class="glyphicon glyphicon-plus"></span>Line
	</button>
	<button class="btn btn-info" id="tr-removeItem"> - Line </button>-->				
</div>
              <div class="row-fluid">
						<ul>
							<li>
								<span>Subtotal</span>
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign">$</span>
									<input class="input-mini subtotal invoice_inputs2" type="text" id="text_subtotal" name="subtotal"  value="<?php echo $this->InvoiceDetails->subtotal; ?>" readonly="true" />
								</div>
							</li>
							<li>
								<span>Tax</span>
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign">$</span>
									<input id="text_tax" class="invoice_inputs2" name="tax" class="item-calc input-mini" type="text" value="<?php echo $this->InvoiceDetails->tax; ?>" onkeyup="Invoice.calculateTax(this.value);" />
									<input type="hidden" id="tax_manual" value="0" />
								</div>
							</li>
							<li>
  								<span>Amount Paid</span>
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign">$</span>
									<input id="amount-paid" class="invoice_inputs2" name="amount_paid" class="item-calc input-mini" type="text" value="<?php echo $this->InvoiceDetails->amount_paid; ?>" onkeyup="Invoice.calculate();" />
								</div>
							</li>
							<li>
								<span>Balance</span> 
								<div class="input-prepend pull-right">
									<span class="add-on currency-sign">$</span>
									<input class="balance-due input-mini invoice_inputs2" id="text_balance" name="net_amount"  value="<?php echo $this->InvoiceDetails->net_amount; ?>" type="text" readonly="true" />
								</div>
							</li>
						</ul>
				</div>
		<textarea name="notes" id="notes" placeholder="Additional Notes"><?php echo $this->InvoiceDetails->notes; ?></textarea>
	  </div>
	  <input type="hidden" name="update" value="<?php echo $this->update; ?>" />
	  <input type="hidden" name="view" value="invoice" />
	  <input type="hidden" name="task" value="saveinvoice" />
	  <input type="button" value="Save" name="Save" class="btn btn-info" style="margin:20px;" onclick="Invoice.validateCreation();" />
	 </form> 
	</div>
	<div class="clear"></div>
	  </div>
   </div>
</div>

