<?php defined ('ITCS') or die ("Go away.");
	global $template,$Config,$mainframe;
	$task=IRequest::getVar('task');
	
	//$template->includejs("templates/itcslive/js/wow.js");
	//$template->includecss($Config->site."templates/itcslive/css/ourworks.css");
	switch($task)
	{
		case "openpopup":
			$template->assignRef('Title','Project Description');
			$template->display('tmplpopup/header');
			$Model = includeclass('ourworks');
			$template->display('ourworks/popup'); 
			$template->display('tmplpopup/footer');
		break;
		case "description":
			$template->assignRef('Title','Project Description');
			$template->display('tmplpopup/header');
			$Model = includeclass('ourworks');
			$template->display('ourworks/description'); 
			$template->display('tmplpopup/footer');
		break;
		default:
			$template->assignRef('Title','LoadBoard');
			$template->display('header');
			$Model = includeclass('ourworks');
			$template->display('ourworks/index');
			$template->display('footer');
		break;
	}
?> 