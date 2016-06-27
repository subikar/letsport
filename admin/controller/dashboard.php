<?php 
   class Dashboard extends Master
     { 
	     function __construct()
		   {
		        parent::__construct();
		   } 
		  function display()
		   {
		        global $template;
				$template->includejs('templates/itcslive/js/admin.js');
				$template->display('header');
				$template->display('dashboard');
				$template->display('footer');
		   }   
	 } 
?>