<?php 
  class Success{
        function __construct()
		  {
		      global $template;
			   $template->display('modules/success/index',0);
		  }
  }
?>