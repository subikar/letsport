<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Payment extends Master 
	{
        function __construct()
		{
			parent::__construct();
		}
		function display()
		{
			global $template;
			$token=IRequest::getVar("token");
			$amount=json_decode(base64_decode($token, true));
			$template->assignRef("paymentAmount",$amount); 
			$template->display('payment/index');
		}
		 function ProcedWithPaymentGateway()
		 {
		 	global $template;
		 	$post=IRequest::get("POST");
			$template->display('header');
			if($post["payment_method"]=="payu")
			{
				$template->assignRef("total_amount",$post["total_amount"]); 
				$template->display('payment/payu');
			}
			if($post["payment_method"]=="paypal")
			{
				$template->assignRef("total_amount",$post["total_amount"]); 
				$template->display('payment/paypal');
		 	}
			
		 $template->display('footer');

		 }
		function returnPaypal()
		{
			global $db;
			$post=IRequest::get("POST");
			$payment_details=json_encode($post);
			$status=($post["payment_status"]=="Completed") ? 1 : 0;
			$this->post=array(
												"payment_type"=>"paypal",
												 "user_id"=>$post["custom"],
												 "payment_details"=>$payment_details,
												 "payment_date"=>date("Y-m-d"),
												 "create_date"=>date("Y-m-d h:i:s"),
												 "net_amount"=>$post["mc_gross"],
												 "status"=>$status 
											);
			parent::bind('payment');
			parent::save();
			if($status==1)
			{
				//$this->updateInvoice($post["invoice"],$post["mc_gross"]);
				$sql="SELECT id,user_id, amount_paid, net_amount FROM #__invoices WHERE net_amount > 0 AND user_id=".$db->quote($post["custom"])." ORDER BY id ASC";
				$db->setQuery($sql);
				$InvoiceList = $db->loadObjectList();
				$extraBalance=$post["mc_gross"];
				
				foreach($InvoiceList as $key=>$Invoice):
					if($Invoice->net_amount > 0 && $extraBalance > 0):
						if($Invoice->net_amount > $extraBalance )
						{
							$NetAmountPaid=$Invoice->amount_paid + $extraBalance;
							$updateBalance=$Invoice->net_amount - $extraBalance;
							$extraBalance=0;
						}
						else
						{
							$updateBalance=0;
							$NetAmountPaid=$Invoice->amount_paid + $Invoice->net_amount;
							$extraBalance=$extraBalance - $Invoice->net_amount;
						}
						
						//$NetAmountPaid=$Invoice->amount_paid +  $updateBalance;
						$updateQuery="UPDATE #__invoices SET amount_paid=".$db->quote($NetAmountPaid).", net_amount=".$db->quote($updateBalance)." WHERE id=".$db->quote($Invoice->id);
						$db->setQuery($updateQuery);
						unset($InvoiceList[$key]);
					endif;
				endforeach;
			}
		
		} 
		function successPayu()
		{
			global $db,$template;
			$post=IRequest::get("POST");
			$payment_details=json_encode($post);
			$status=($post["status"]=="success") ? 1 : 0;
			$this->post=array(
												"payment_type"=>"payu",
												 "user_id"=>$post["udf1"],
												 "payment_details"=>$payment_details,
												 "payment_date"=>date("Y-m-d"),
												 "create_date"=>date("Y-m-d h:i:s"),
												 "net_amount"=>$post["amount"],
												 "currency"=>"INR",
												 "status"=>$status 
											);
			parent::bind('payment');
			parent::save();
			if($status==1)
			{
				//$this->updateInvoice($post["invoice"],$post["mc_gross"]);
				$sql="SELECT id,user_id, amount_paid, net_amount FROM #__invoices WHERE net_amount > 0 AND user_id=".$db->quote($post["udf1"])." ORDER BY id ASC";
				$db->setQuery($sql);
				$InvoiceList = $db->loadObjectList();
				$extraBalance=$post["amount"];
				
				foreach($InvoiceList as $key=>$Invoice):
					if($Invoice->net_amount > 0 && $extraBalance > 0):
						if($Invoice->net_amount > $extraBalance )
						{
							$NetAmountPaid=$Invoice->amount_paid + $extraBalance;
							$updateBalance=$Invoice->net_amount - $extraBalance;
							$extraBalance=0;
						}
						else
						{
							$updateBalance=0;
							$NetAmountPaid=$Invoice->amount_paid + $Invoice->net_amount;
							$extraBalance=$extraBalance - $Invoice->net_amount;
						}
						
						//$NetAmountPaid=$Invoice->amount_paid +  $updateBalance;
						$updateQuery="UPDATE #__invoices SET amount_paid=".$db->quote($NetAmountPaid).", net_amount=".$db->quote($updateBalance)." WHERE id=".$db->quote($Invoice->id);
						$db->setQuery($updateQuery);
						unset($InvoiceList[$key]);
					endif;
				endforeach;
				
			}
			
			$template->assignRef("payment_status",$status);  
			$template->display('payment/payment_success');
		}
	
		function success()
		{
			global $template;
			$template->display('payment/payment_success');
		}
		
		
	}	