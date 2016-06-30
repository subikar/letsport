<?php 

    //ini_set('display_error',1); 

	error_reporting(0); 

    if(!defined('IPATH_BASE'))

    define('IPATH_BASE',__DIR__);

	if(!defined('DIRECTORY_SEPARATOR'))

    define('DIRECTORY_SEPARATOR','/');

    if(!defined('DS'))

	  define('DS','/');

	// Global definitions

	$parts = explode(DIRECTORY_SEPARATOR, IPATH_BASE);

	array_pop($parts);

	// Defines

	define('IPATH_ROOT', implode(DIRECTORY_SEPARATOR, $parts));

  include_once('common.php');

  global $template;

 $content = $cache = $template->CheckCache();
  if($cache == 'no')
      Get404Original();
?>