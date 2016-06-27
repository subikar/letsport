<?php defined ('ITCS') or die ("Go away.");
global $template;
$form = IRequest::getVar('form');
$template->includecss("templates/itcslive/css/quick-quote.css");
$template->includejs("templates/itcslive/js/getfreequote.js");
  switch($form)
    {
	  case 'addtruck':
	  $template->assignRef('Title','Submit Truck Availability For Free');	
	  $template->display('tmplpopup/header');	
	  $template->display('contact/addtruck');
	  $template->display('tmplpopup/footer');	
	  break;
	  default: 
	  $template->assignRef('Title','Get Free Quote');	
	  $template->display('tmplpopup/header');	
	  $template->display('contact/quote');
	  $template->display('tmplpopup/footer');	
	  break;
    }
?>
