<?php
	defined ('ITCS') or die ("Go away.");
	
	global $template,$Config,$my,$mainframe;
   	if(!isset($my->uid))
   	{
   		$mainframe->redirect($Config->site);
   	}
	$template->includecss($Config->site."templates/itcslive/css/invoice.css");
	$template->includejs($Config->site."templates/itcslive/js/invoice.js");
	$task=IRequest::getVar("task");
	switch($task)
	{	
		case "getpdf":
			$Model = includeclass('itcspdf');
			$Model->getpdf();
		break;
		case "modifyinvoice":
			$template->assignRef('Title','Modify Invoice');
			$template->display('tmplpopup/header');
			$Model = includeclass('invoice');
			$template->display('tmplpopup/footer');
		break;
		default:
		$template->assignRef('Title','My Invoices');
		$template->display('header');
		$Model = includeclass('invoice');
		$template->display('footer');
		break;
	}
?>