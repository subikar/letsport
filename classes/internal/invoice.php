<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Invoice extends Master 
	{
	    var $previledge = array('telecaller','Admin');
        function __construct()
		{
			parent::__construct();
		}
		function display()
		{
			global $template;
			$invoice_id=IRequest::getInt("invoice_id");
			$Invoice=$this->getInvoiceInDetails($invoice_id);
			$template->assignRef("Invoice",$Invoice); 
			$template->display('invoice/invoice');
		}
		function dashboard()
		{
		 	global $template;
			$InvoiceList=$this->getInvoiceList();
			$template->assignRef("InvoiceList",$InvoiceList);
			$template->display('invoice/index');
		 }
		function create_invoice()
		 {
            global $template,$Config,$my,$mainframe;
			if(!in_array($my->usertype,$this->previledge))
			  {
			    die("Access Restricted");
			  }
			//print_r(); exit;
			$Invoice_no=IRequest::getInt('id',$this->getInvoiceNo());
			$template->assignRef("update",0);
			if(IRequest::getInt('id',0)>0)
			  {
			    $InvoiceDetails = $this->getInvoiceInDetails(IRequest::getInt('id',0));
				$template->assignRef("InvoiceDetails",$InvoiceDetails);
				$template->assignRef("update",1);
				//print_r($InvoiceDetails); exit;
			  }
			$template->assignRef("InvoiceNo",$Invoice_no);
			$template->display('invoice/create');
		 }
		 function payment_history()
		{
			global $template;
			$PaymentHistory=$this->getPaymentHistory();
			$template->assignRef("PaymentHistory",$PaymentHistory);
			$template->display('invoice/payment_history');
		}
		function payment_invoice()
		{
			global $template;
			$payment_id=IRequest::getVar("token","");
			if($payment_id !="")
			{
				$payment_id=base64_decode($payment_id);
				$PaymentInvoice=$this->getPaymentDetails($payment_id);
				$template->assignRef("PaymentInvoice",$PaymentInvoice);
				$template->display('invoice/payment_invoice');
			}
		}
		function getInvoiceList()
		{
			global $db,$my;
			if(strtolower($my->usertype) == 'admin')
			{
				$where = "WHERE 1";
			}
			else if(strtolower($my->usertype) == "telecaller")
			{
				//$where="WHERE created_by=".$db->quote($my->uid);
				$where = "WHERE 1";
			}
			else
			{
				$where="WHERE user_id = ".$db->quote($my->uid);
			}
			$sql = "SELECT * FROM #__invoices ".$where." ORDER BY id DESC";
			$db->setQuery($sql);
			$InvoiceList = $db->loadObjectList();
			return $InvoiceList;
		}
		function getPaymentHistory()
		{
			global $db,$my;
			if(strtolower($my->usertype) == 'admin')
			{
				$where = "WHERE 1";
			}
			else if(strtolower($my->usertype) == "telecaller")
			{
				$where = "WHERE 1";
			}
			else
			{
				$where="WHERE p.user_id = ".$db->quote($my->uid);
			}
			$sql = "SELECT p.*,u.name FROM #__payment as p LEFT JOIN #__users as u on p.user_id=u.uid ".$where." ORDER BY id DESC";
			$db->setQuery($sql);
			$paymentList = $db->loadObjectList();
			return $paymentList;
		}
		function getPaymentDetails($payment_id)
		{
			global $db, $Config;
			$sql = "SELECT p.*,u.uid,u.name, u.address FROM #__payment as p LEFT JOIN #__users as u on p.user_id=u.uid WHERE id=".$db->quote($payment_id);
			$db->setQuery($sql);
			$paymentDetails = $db->loadObjectList();
			$paymentDetails=$paymentDetails[0];
			if($paymentDetails->payment_type=="paypal")
			{
				$transactionDetails=json_decode($paymentDetails->payment_details);
				$paymentDetails->transaction_id=$transactionDetails->txn_id;
				$paymentDetails->payer_id=$transactionDetails->payer_id;
			}
			else
			{
				$paymentDetails->transaction_id="ITCSCASHPAY".$paymentDetails->id;
				$paymentDetails->payer_id="ITCSUSER".$paymentDetails->uid;
				$transactionDetails=json_decode($paymentDetails->payment_details);
				if($transactionDetails->attachment)
				{
					$paymentDetails->attachment=$transactionDetails->attachment;
				}
			}
			
			return $paymentDetails;
			
		}
		 function getInvoiceNo()
		 {
		 	global $db, $Config;
			$sql = "SELECT id FROM #__invoices ORDER BY id DESC LIMIT 0,1";
			$db->setQuery($sql);
			$invoice_no =$db->getOne();
			$invoiceNo=((int)$invoice_no > 0) ? ($invoice_no + 1) : 1;
			return $invoiceNo;
		 }
		 function getCustomers()
		 {
		 	global $db, $Config;
			$post=IRequest::get("POST");
			$userHint=$post["customer_name"];
			//$userHint = "suja";
			$dataArray=array();
			$sql = "SELECT uid, name, address FROM #__users WHERE (name LIKE '%".strtolower($userHint)."%' OR email LIKE '%".strtolower($userHint)."%' OR phone LIKE '%".$userHint."%') AND usertype='customer'";
			//print($sql); exit;
			$db->setQuery($sql);
			$Customers =$db->loadObjectList();
			$i=0;
			foreach($Customers as $customer)
			{
				//$dataArray[$i]["name"]=$customer->name."\n".$customer->address;
				//$dataArray[$i]["id"]=$customer->uid;
				$dataArray[] = '<a href="javascript:void(0);" onclick="Invoice.setCustomer(\''.$customer->uid.'\',this);" data_address="'.$customer->name.' ('.$customer->address.')">'.$customer->name.' ('.$customer->address.')</a>'; 
				$i++;
			}
            echo '<p>'.implode("</p><p>",$dataArray).'</p>'; 
			//print_r(json_encode($dataArray)); exit;
			//return $Customers;
		 }
		 function saveinvoice()
		 {
		 	global $db,$my,$Config,$mainframe;
		 	$post=IRequest::get("POST");
			$update = ($post['update'] == 1)?1:0;
			$InvoiceID = $post["invoice_id"];
		 	$post["invoice_details"]=json_encode($post["summary"]);
			unset($post["summary"]);
			unset($post["invoice_id"]);
			unset($post["view"]);
			unset($post["task"]);
			unset($post["Save"]);
			unset($post["update"]);
			$post["create_date"]=date("Y-m-d h:i:s");
			$post["status"]=1;
			$post["created_by"]=$my->uid;
			if(($update == 1))
			  {
			    unset($post["created_by"]);
			  }
			$this->post = $post;
			parent::bind('invoices');
			if($update == 1)
			  {
			     $this->Where = ' id = '.$db->quote($InvoiceID); 
			     parent::update();
			  }
			else
			  parent::save();
			$invoice_id = $db->insertid();
			if((int)$invoice_id > 0)
			{
				$this->post=array("original"=>"invoice.php?view=invoice&invoice_id=".$invoice_id, "seo"=>"invoice/".$invoice_id, "type"=>"invoice","type_id"=>$invoice_id);
				parent::bind('404');
				parent::save();
				
				$post["invoice_id"]=$invoice_id;
				$post["invoice_link"]=$Config->site."invoice/".$invoice_id;
				
				$pdf_invoice=$this->generateInvoicePDF($invoice_id);
				$this->sendMailToUser($post,$pdf_invoice);	
			}
		  $mainframe->redirect($Config->site."invoice");
		 }
		 
		 function generateInvoicePDF($invoice_id)
		 {
		 	global $Config;
			$invoice=$this->getInvoiceInDetails($invoice_id);
	
			ob_start();
			include_once(IPATH_ROOT."/templates/itcslive/invoice/invoice_pdf.php");
			$html= ob_get_clean();
				
			$filename=IPATH_ROOT.DS."images/download/invoice/invoice_".$invoice_id.".pdf";
			if(file_exists($filename))
			  {
			    unlink($filename);
			  }
			require(IPATH_ROOT.DS.'classes/external/mpdf/mpdf.php');
			$mpdf=new mPDF(); 
			$mpdf->SetDisplayMode('fullpage');
			$stylesheet1 = file_get_contents($Config->site.'templates/itcslive/css/invoice_pdf.css');
			$mpdf->WriteHTML($stylesheet1,1);
			$mpdf->WriteHTML($html,2);					 
			$mpdf->Output($filename,'F');
			return $filename;
		 }
		 function sendMailToUser($post,$pdf_invoice)
		 {
		 	global $db,$Config;	
			$sql="SELECT name,email FROM #__users WHERE uid=".$db->quote($post["user_id"]);
			$db->setQuery($sql);
			$sender =$db->loadObjectList();
			
			$productDetails=json_decode($post["invoice_details"]);
			$descriptionHtml="<table>";
			for($i=0 ; $i < count($productDetails->qty); $i++):
				$descriptionHtml .="<tr><td>".$productDetails->qty[$i]."</td><td>".$productDetails->description[$i]."</td><td>".$post['currency']." ".$productDetails->part_total[$i]."</td></tr>";	
			endfor;
			$descriptionHtml .="</table>";			
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/InvoiceMail.inc");
			$message = ob_get_clean();
			
			
			$message=str_replace('{invoice_id}',$post["invoice_id"],$message);
			$message=str_replace('{invoice_from}',$post["from"],$message);
			$message=str_replace('{invoice_client}',$post["to"],$message);
			$message=str_replace('{product_details}',$descriptionHtml,$message);
			$message=str_replace('{total_price}',$post["net_amount"],$message);
			$message=str_replace('{view_pay_link}',$Config->site."dashboard",$message);
			$message=str_replace('{invoice_link}',$post["invoice_link"],$message);
			
			$mailer->file_to_attach=$pdf_invoice;
			$mailer->From="info@itcslive.com";
			$mailer->Subject="[iTCSLive] Invoice #".$post["invoice_id"];
			$mailer->To =trim($sender[0]->email);
			//$mailer->To =trim("priyabrata@itcslive.com");
			$mailer->Message = $message;
			$mailer->send();
		 
		 }
		 
		 function getInvoiceInDetails($invoice_id)
		 {
		 	global $db;
			$sql = "SELECT * FROM #__invoices WHERE id=".$db->quote($invoice_id);
			$db->setQuery($sql);
			$InvoiceInDetails = $db->loadObjectList();
			$InvoiceDetails=$InvoiceInDetails[0];
			
			$Query="SELECT * FROM #__invoice_deduction_history WHERE invoice_id=".$db->quote($invoice_id);
			$db->setQuery($Query);
			$deductionHistory = $db->loadObjectList();
			if( !empty($deductionHistory) && count($deductionHistory) > 0){
				$InvoiceDetails->deduction_history=$deductionHistory;
			}
			return $InvoiceDetails;
		 }
		 function modifyinvoice()
		 {
			 global $db,$template;
			 $invoice_id=IRequest::getInt("invoice_id");
			 $sql="SELECT id,tax,amount_paid,net_amount,subtotal,deduction,currency FROM #__invoices WHERE id=".$db->quote($invoice_id);
			 $db->setQuery($sql);
			$Invoice = $db->loadObjectList();
			$template->assignRef("Invoice",$Invoice[0]);
			$template->display("invoice/modifyinvoice");
		 	
		 }
		 function updateInvoicePayment()
		 {
		 	global $db,$template,$Config;
		 	$post=IRequest::get("POST");
			//print_r($_FILES); exit;
			if($post["pay_amount"] > 0)
			{
				$sql="SELECT user_id,amount_paid,net_amount FROM #__invoices WHERE id=".$db->quote($post["invoice_id"]);
				$db->setQuery($sql);
				$Invoice = $db->loadObjectList();
				
				if(isset($_FILES['cheque_file']) && (int)$_FILES['cheque_file']['error'] == 0)
				{	
					$path=IPATH_ROOT.DS.'images/files/invoice_cheque/'.$post["invoice_id"].'/'.date('Y-m-d H:i:s').'/';		
					$extension = pathinfo($_FILES['cheque_file']['name'], PATHINFO_EXTENSION);
						if(!file_exists ( $path ))
						{
							mkdir($path, 0777, true);
						}
						$allowed = array('png', 'jpg','jpeg', 'gif');
						if(in_array(strtolower($extension), $allowed))
						{ 
							if(move_uploaded_file($_FILES['cheque_file']['tmp_name'], $path.$_FILES['cheque_file']['name']))
							{
								$Arraylink=explode('/images',$path.$_FILES['cheque_file']['name']);
								$finalLink='images'.$Arraylink[1];
								$key = md5(base64_encode($finalLink));
								
								$this->post = array('filename'=>$finalLink,'token'=>$key);
								parent::bind('attachment');
								parent::save();
								
								include_once(IPATH_ROOT.DS."classes/external/priyaTools/resizer.php");
								$Imageparams = array('width' =>60, 'height' =>60);	
								$thumb = Resizer::img_resize($finalLink,$Imageparams);
								
								$post["attachment"] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.$thumb."\" height=\"50%\" weight=\"50%\"></a>";							
								}
						}		
					
				}
				$this->post=array(		"payment_type"=>"bankpayment",
										"user_id"=>$Invoice[0]->user_id, 
										"payment_details"=>json_encode($post),
										"payment_date"=>date("Y-m-d"),
										"create_date"=>date("Y-m-d h:i:s"),
										"net_amount"=>$post["pay_amount"],
										"currency"=>$post["currency"],
										"status"=>1
									);
				
				parent::bind('payment');
				parent::save();
				
				$paidAmount=($Invoice[0]->amount_paid + $post["pay_amount"]);
				$netAmount=($Invoice[0]->net_amount - $post["pay_amount"]);
			
			 $SQL="UPDATE #__invoices SET amount_paid=".$db->quote($paidAmount).", net_amount=".$db->quote($netAmount)."  WHERE id=".$db->quote($post["invoice_id"]);
			 $db->setQuery($SQL);
			 
			} elseif($post['deduction_amount'] > 0){
			
				$this->post=$post;
				$this->post['created_on']= date("Y-m-d h:i:s");
				parent::bind('invoice_deduction_history');
				parent::save();
				
				$sql="SELECT user_id,amount_paid,net_amount,deduction FROM #__invoices WHERE id=".$db->quote($post["invoice_id"]);
				$db->setQuery($sql);
				$Invoice = $db->loadObjectList();
				$deductionAmount=((float)$Invoice[0]->deduction + (float)$post["deduction_amount"]);
				$netAmount=((float)$Invoice[0]->net_amount - (float)$post["deduction_amount"]);
				
				$SQL="UPDATE #__invoices SET deduction=".$db->quote($deductionAmount).", net_amount=".$db->quote($netAmount)."  WHERE id=".$db->quote($post["invoice_id"]);
			 	$db->setQuery($SQL);
			
			}
			
			//unlink invoice pdf.
			$invoice_Path=IPATH_ROOT.DS."images/download/invoice/invoice_".$post["invoice_id"].".pdf";
			if(file_exists($invoice_Path)){
				unlink($invoice_Path);
			}
			
			 echo "<script> window.parent.SqueezeBox.close();</script>";
			 echo "<script>window.parent.location.href='".$Config->site.'invoice'."'</script>";
		 
		 }
		
		
	}	