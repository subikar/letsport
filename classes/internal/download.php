<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Download extends Master 
	{
        function __construct()
		{
			parent::__construct();
		}
		function display()
		{
		    global $db;
			$token = IRequest::getVar('token','');
			if($token != '')
			  {
			    $Query = "select filename from #__attachment where token =".$db->quote($token);
				$db->setQuery($Query);
				$filename = $db->getOne();
				if($filename != '' && file_exists(IPATH_ROOT.DS.$filename))
				  {
						$file=IPATH_ROOT.DS.$filename; //file location
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.basename($file).'"');
						header('Content-Length: ' . filesize($file));
						readfile($file);
				  }
				 else
				 {
				 	echo "Invalid Token! or File Does't Exist!";
				 } 
				
			  }
			  else
			  {
			  	echo "Invalid Token!";
			  }
			
	/*		global $template;
			$post = IRequest::getVar('attach');
			$attach = base64_decode($post);
			//print_r($attach); exit;
			$template->display('download/index');*/		
		}
}
?>