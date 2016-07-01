<?php 
	 error_reporting(0);  
    define('IPATH_BASE',__DIR__);
    define('DIRECTORY_SEPARATOR','/');
    define('DS','/');
	// Global definitions
	$parts = explode(DIRECTORY_SEPARATOR, IPATH_BASE);
	array_pop($parts);
	// Defines
	define('IPATH_ROOT', implode(DIRECTORY_SEPARATOR, $parts));
	
	include_once(IPATH_ROOT.DS.'classes'.DS.'common.php');
	SetSession();
	$template->TemplatePath = IPATH_BASE.DS.'templates'.DS.'itcslive'.DS;
    $template->includejs('templates/itcslive/editor/tinymce.min.js');
    $template->includejs('templates/itcslive/editor/editor.js');
	if($my->uid > 0 && $my->usertype == 'Admin')
	      $view = IRequest::getString('view','dashboard'); 
	else
		 $view = 'login'; 

    include_once(IPATH_BASE.DS.'controller'.DS.$view.'.php');
	//echo "IPATH_BASE.DS.'controller'.DS.$view.'.php'";exit;  
    new $view();

?>