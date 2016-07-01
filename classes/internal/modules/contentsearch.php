<?php defined ('ITCS') or die ("Go away."); 
  class Contentsearch 
    {
	   function __construct()
		 {
			global $template;
			//$Model = includeclass('dashboard');
			//$Model->VehcleType();
		
			$template->display('modules/contentsearch/index',0);
		 }
}
    

?>
