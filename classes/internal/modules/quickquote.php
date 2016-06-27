<?php 
error_reporting(0);
  class Quickquote{
        function __construct()
		  {
		      global $template;
		     $template->display('modules/quickquote/index',0);
		  }
		  
  }
?>