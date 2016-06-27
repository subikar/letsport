<?php 
  class Cache extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
		  global $mainframe; 
		  $CachePath = IPATH_ROOT.DS.'cache'.DS.'*';
		  exec("rm -rf ".$CachePath);
		  $mainframe->redirect("index.php?view=dashboard");
        }  
}  

?>