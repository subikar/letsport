<?php defined ('ITCS') or die ("Go away.");
	global $template,$Config,$my,$mainframe;
	$template->includejs($Config->site."templates/itcslive/js/attach.js");
	$template->includejs($Config->site."templates/itcslive/js/colorbox/jquery.colorbox.js");
	$template->includecss($Config->site."templates/itcslive/js/colorbox/colorbox.css");
	$task=IRequest::getVar('task');
	switch($task)
	{
		case "oauth2callback":
			if((int)$my->uid == 0)
			{
				$mainframe->redirect($Config->site);
			}
			$template->assignRef('Title','Attach File');
			$template->display('header');
			$Model = includeclass('attach');
			$template->display('attach/oauth2callback');
			$template->display('footer');
		break;
		case "startapi":
			if((int)$my->uid == 0)
			{
				$mainframe->redirect($Config->site);
			}
			$template->assignRef('Title','Attach File');
			$Model = includeclass('attach');
			$template->display('attach/startapi');
		break;
		default :
			$template->assignRef('Title','Attach File');
			$template->display('tmplpopup/header');
			$Model = includeclass('attach');
			$template->display('tmplpopup/footer');
		break;
	}
	
?>