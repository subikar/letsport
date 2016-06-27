<?php defined ('ITCS') or die ("Go away.");
	global $template,$Config,$my,$mainframe;
	if((int)$my->uid == 0)
	{
		$mainframe->redirect($Config->site);
	}
			$template->includecss($Config->site."templates/itcslive/css/invoice.css");
			$template->assignRef('Title','Welcome to Payment Dashboard');
			$template->display('header');
			$Model = includeclass('payment');
			$template->display('footer');
?> 