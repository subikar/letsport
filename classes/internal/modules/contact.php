<?php defined ('ITCS') or die ("Go away."); ?>
<?php 
  class Contact 
    {
	   function __construct()
	     {
		    $this->displayForm();
		 }
		function displayForm()
		 {
		    global $template;
			$template->display('modules/contact/form',0);
		 } 
	}
    

?>
