<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
class Itcspdf extends Master 
{
	function __construct()
	{
		parent::__construct();
	}
	function display()
	{
	}
	function getpdf()
	{
		$invoice_id=IRequest::getInt('invoice_id');
		$payment_id=IRequest::getInt('payment_id');
		if((int)$invoice_id > 0)
		{
			$this->Invoicepdf();
		}
		elseif((int)$payment_id >0)
		{
			$this->paymentPDF();
		}
	}
	function Invoicepdf()
	{
		global $Config;
		$id=IRequest::getInt('invoice_id');
		 $filename=IPATH_ROOT.DS."images/download/invoice/invoice_".$id.".pdf";
		 $url_file=$Config->site."images/download/invoice/invoice_".$id.".pdf";
		if(!file_exists($filename))
		{
			$invoice=$this->getInvoiceInDetails($id);
			ob_start();
			include_once(IPATH_ROOT."/templates/itcslive/invoice/invoice_pdf.php");
			$html= ob_get_clean();
			require(IPATH_ROOT.DS.'classes/external/mpdf/mpdf.php');
			$mpdf=new mPDF(); 
			$mpdf->SetDisplayMode('fullpage');
			$stylesheet1 = file_get_contents($Config->site.'templates/itcslive/css/invoice_pdf.css');
			$mpdf->WriteHTML($stylesheet1,1);
			 
			$mpdf->WriteHTML($html,2);					 
			$mpdf->Output($filename,'F');
		}
		
		echo "<script>window.location.href='".$url_file."'</script>";		
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
	  function paymentPDF()
	 {
		global $Config;
		$payment_id=IRequest::getInt('payment_id');
		$filename=IPATH_ROOT.DS."images/download/payment/PAY_".$payment_id.".pdf";
		$url_file=$Config->site."images/download/payment/PAY_".$payment_id.".pdf";
		if(!file_exists($filename))
		{
		$payment=$this->getPaymentDetails($payment_id);
		ob_start();
		include_once(IPATH_ROOT."/templates/itcslive/invoice/payment_invoice_pdf.php");
		$html= ob_get_clean();
		
		require(IPATH_ROOT.DS.'classes/external/mpdf/mpdf.php');
		$mpdf=new mPDF(); 
		$mpdf->SetDisplayMode('fullpage');
		$stylesheet1 = file_get_contents($Config->site.'templates/itcslive/css/invoice_pdf.css');
		$mpdf->WriteHTML($stylesheet1,1);
		$mpdf->WriteHTML($html,2);	
		ob_clean();				 
		$mpdf->Output($filename,'F');
		
		}
		echo "<script>window.location.href='".$url_file."'</script>";		
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
		}
		return $paymentDetails;
		
	}
}
?>