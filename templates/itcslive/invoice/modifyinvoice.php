<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $my;
?>

<div id="primary">
  <div role="main" id="contactus">
    <div class="article-body">
      <div class="padDiv row10 invoice_modify">
        <!--<div class="boiteHeader">
                  <h5> Modify Invoice </h5>
               </div>-->
        <div class="line"></div>
        <div class="boiteContent modify">
          <div class="table_edituser">
            <ul>
              <li>Subtotal:</li>
              <li> <span class="add-on currency-sign">
                <?php  echo $this->Invoice->currency; ?>
                </span>
                <?php  echo $this->Invoice->subtotal; ?>
              </li>
              <li>Tax:</li>
              <li> <span class="add-on currency-sign">
                <?php  echo $this->Invoice->currency; ?>
                </span> <?php echo $this->Invoice->tax; ?> </li>
              <li>Paid Amount:</li>
              <li> <span class="add-on currency-sign">
                <?php  echo $this->Invoice->currency; ?>
                </span> <?php echo $this->Invoice->amount_paid 	; ?> </li>
			  <li>Deduction Amount:</li>
              <li> <span class="add-on currency-sign">
                <?php  echo $this->Invoice->currency; ?>
                </span> <?php echo $this->Invoice->deduction; ?> </li>	 
              <li>Net Balance:</li>
              <li> <span class="add-on currency-sign">
                <?php  echo $this->Invoice->currency; ?>
                </span> <?php echo $this->Invoice->net_amount; ?> </li>
              <li>Select Payment Type: </li>
              <li>
                <div class="styled">
                  <select name="payment_type" onchange="Invoice.modifyPayment(this.value);">
                    <option value="cash">Cash Payment</option>
                    <option value="cheque">Cheque Payment</option>
                    <option value="deduction">Payment Deduction</option>
                  </select>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div id="cash_form">
          <form name="invoiceForm" method="post" id="invoiceForm">
            <div class="table_edituser">
              <ul>
                <li>Enter Payment Amount:</li>
                <li>
                  <input class="small_field" type="text" name="pay_amount" />
                  <span class="add-on currency-sign">
                  <?php  echo $this->Invoice->currency; ?>
                  </span> </li>
              </ul>
            </div>
            <div class="table_edituser">
              <ul>
                <li>&nbsp;</li>
                <li>
                  <input type="submit" value="Save" class="login" />
                  <input type="hidden" name="view" value="invoice" />
                  <input type="hidden" name="task" value="updateInvoicePayment" />
                  <input type="hidden" name="currency" value="<?php  echo $this->Invoice->currency; ?>" />
                  <input type="hidden" name="invoice_id" value="<?php echo $this->Invoice->id; ?>"  />
                </li>
              </ul>
            </div>
          </form>
        </div>
        <div id="cheque_form" style="display:none;">
          <form name="invoiceForm" method="post" id="invoiceForm" enctype="multipart/form-data">
            <div class="table_edituser">
              <ul>
                <li>Payment Amount:</li>
                <li>
                  <input type="text" name="pay_amount" class="small_field" />
                  <span class="add-on currency-sign">
                  <?php  echo $this->Invoice->currency; ?>
                  </span> </li>
                <li>Bank Name:</li>
                <li>
                  <input type="text" name="bank_name" />
                </li>
                <li>Check No:</li>
                <li>
                  <input type="text" name="cheque_no" />
                </li>
                <li>Uplode Check:</li>
                <li>
                  <input type="file" name="cheque_file" />
                </li>
              </ul>
            </div>
            <div class="table_edituser">
              <ul>
                <li>&nbsp;</li>
                <li>
                  <input type="submit" value="Save" class="login" />
                  <input type="hidden" name="view" value="invoice" />
                  <input type="hidden" name="task" value="updateInvoicePayment" />
                  <input type="hidden" name="currency" value="<?php  echo $this->Invoice->currency; ?>" />
                  <input type="hidden" name="invoice_id" value="<?php echo $this->Invoice->id; ?>"  />
                </li>
              </ul>
            </div>
          </form>
        </div>
        <div id="deduction_form" style="display:none;">
          <form name="invoiceForm" method="post" id="invoiceForm">
            <div class="table_edituser">
              <ul>
                <li>Deduction Amount:</li>
                <li>
                  <input class="small_field" type="text" value="0" name="deduction_amount" />
                  <span class="add-on currency-sign">
                  <?php  echo $this->Invoice->currency; ?>
                  </span> </li>
                <li>Deduction Reason(Notes):</li>
                <li>
				  <textarea class="small_field" name="deduction_notes"></textarea>  
                </li>
              </ul>
            </div>
            <div class="table_edituser">
              <ul>
                <li>&nbsp;</li>
                <li>
                  <input type="submit" value="Save" class="login" />
                  <input type="hidden" name="view" value="invoice" />
                  <input type="hidden" name="task" value="updateInvoicePayment" />
                  <input type="hidden" name="currency" value="<?php  echo $this->Invoice->currency; ?>" />
                  <input type="hidden" name="invoice_id" value="<?php echo $this->Invoice->id; ?>"  />
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var screenwidth = $(document).width();
		if(screenwidth > 996 && screenwidth <= 1920) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"550px"});
		} 
		else if(screenwidth > 768 && screenwidth <= 996) {
			parent.jQuery.colorbox.resize({iframe:true, width:"600px", height:"550px"});
		} 
		else if(screenwidth > 480 && screenwidth <= 768) {
			parent.jQuery.colorbox.resize({iframe:true, width:"500px", height:"550px"});
		} 
		else if(screenwidth > 320 && screenwidth <= 480) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"550px"});
		}
		else if(screenwidth <= 320) {
			parent.jQuery.colorbox.resize({iframe:true, width:"95%", height:"550px"});
		}
});
</script>
