<?php defined ('ITCS') or die ("Go away.");
$template->includejs($Config->site."templates/itcslive/js/login.js");
$task = IRequest::getVar('task'); 
//print($task); exit;
  switch($task)
    {
	  case 'logout':
	  $model = includeclass('login');
	  $model->logout();
	  $mainframe->redirect($Config->site);
	  break;
	  default:
		  $template->display('tmplpopup/header');	
		  $template->display('login/index');
		  $template->display('tmplpopup/footer');	
	  
	}
?>
