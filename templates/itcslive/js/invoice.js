var Invoice = new function()
{
	this.modifyPayment=function(type)
	{
		var paymentType=new Array("cheque","cash","deduction");
		for(var i=0; i< paymentType.length ; i++)
		{
			if(paymentType[i] == type){ jQuery("#"+paymentType[i]+"_form").show("slow"); } else { jQuery("#"+paymentType[i]+"_form").hide("slow");}	
		}
	}
	this.calculate=function()
	{
		var total=0;
		var taxParcent = 14.5;
		var tax=0;
		jQuery(".item-row").each(function(){
			var quentity= parseFloat(jQuery(this).find('.item-calc-qty').val());
			var rate=parseFloat(jQuery(this).find('.item-calc-rate').val());
			var part_total=quentity * rate;
			if(part_total > 0)
			{
			total += part_total;	
			jQuery(this).find('.item-calc-part_total').val(part_total.toFixed(2));
			}
		});	
		jQuery("#text_subtotal").val(total.toFixed(2));
		
		//Tax calculation.
		if(parseInt(jQuery("#tax_manual").val())==0){
			tax=parseFloat((total * 10)/100);
			jQuery("#text_tax").val(tax);
		} else {
			tax=parseFloat(jQuery("#text_tax").val());
		}
		var amount_paid=parseFloat(jQuery("#amount-paid").val());
		var Balance=parseFloat((total+tax) - amount_paid);
		if(Balance >= 0)
		{
			jQuery("#text_balance").val(Balance.toFixed(2));
		}
	}
	this.calculateTax=function(amount)
	{
		var tax=parseFloat(amount);
		var total=parseFloat(jQuery("#text_subtotal").val());
		var amount_paid=parseFloat(jQuery("#amount-paid").val());
		
		var Balance=parseFloat(parseFloat(total+tax) - amount_paid);
		if(Balance >= 0)
		{
			jQuery("#text_balance").val(Balance.toFixed(2));
			jQuery("#tax_manual").val(1);
		}
	}
	this.validateCreation=function()
	{
		var input=document.getElementById("invoiceForm");
		if(input.user_id.value=='' || input.user_id.value=='0'){
			alert("Please Select Customer Properly");
		}else if(input.to.value==''){
			alert("Please Select Customer Properly");
		} else {
			input.submit();
		}
		
	}
	this.setCustomer=function(id,thisobj)
	 {
		  jQuery("#assign_to").val(id)
		  jQuery("#adress_to").val(thisobj.getAttribute("data_address"))
		  jQuery("#search_customers").slideUp();
		  jQuery(".searchcustomer").slideUp();
	 }
}

jQuery(document).ready(function() {		
	
	var formURL="invoice?view=invoice&task=getCustomers";

jQuery(".search_customer").click(function () {
     var customer_name = jQuery(".customer_name").val();
	 jQuery("#search_customers").slideUp();
	 jQuery.post( 
		  formURL,
		  { customer_name: customer_name },
		  function(data) {
			  jQuery('#search_customers').html(data);
			  jQuery("#search_customers").slideDown();
		  });
	});


										
	 jQuery("#invoice_date").kendoDatePicker({ format: "yyyy-MM-dd" });	 //duedate
	 jQuery("#duedate").kendoDatePicker({ format: "yyyy-MM-dd" }); 
								
								
	var counter=1;							
	jQuery("#tr-addItem").click(function () {
		if(counter>10){
				alert("Only 10 data allow");
				return false;
		}  
		else
		{
			var strText =  jQuery("#item_row").clone();
			strText.find("input").val('');
          	strText.appendTo('#item-totals');
			//jQuery("#item_row").clone().appendTo('#item-totals'); 	
			counter++;
		}
     }); 
 
    jQuery("#tr-removeItem").click(function () {
		if(counter==1){
			  alert("No more data to remove");
			  return false;
		   } 
		   else
		   {
			jQuery("#item-totals").find('tr').last().remove();
			counter--;
		   }
	 });
	
	jQuery("#currency").change(function(){
		jQuery(".currency-sign").html(jQuery(this).val());									
	});
	jQuery("#adress_to").keyup(function(){
		if(jQuery("#adress_to").val() == '')
		   jQuery(".searchcustomer").slideDown();

	});
	
							
});
	