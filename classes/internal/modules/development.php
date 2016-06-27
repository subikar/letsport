<?php 
  class Development{
       function __construct()
		  {
		      global $template;
			   $template->display('modules/development/index',0);
		  }
  }
?>