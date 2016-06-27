<?php 
  class Welcome{
        function __construct()
		  {
		      global $template;
			   $template->display('modules/welcome/index',0);
		  }
  }
?>