<?php 
		require(__DIR__.'/'.'classes/external/mpdf/mpdf.php');
		$mpdf=new mPDF(); 
		//print_r($mpdf); exit;
		$mpdf->SetDisplayMode('fullpage');			 
		//$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list			 
		$mpdf->WriteHTML("<body><h1>Welcome</h1></body>");					 
		$mpdf->Output($filename,'I');


?>