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
	   case 'addload':
	  $template->assignRef('Title','Submit Load For Free');	
	  $template->display('tmplpopup/header');	
	  $template->display('contact/addload');
	  $template->display('tmplpopup/footer');	
	  break;
	 
	 case 'addtruckbid':
	  $template->assignRef('Title','Add Truck Bid');	
	   $Model = includeclass('dashboard');
	  $template->display('tmplpopup/header');	
	  $template->display('contact/addtruckbid');
	  $template->display('tmplpopup/footer');	
	  break;
	 
	  case 'addloadbid':
	  $template->assignRef('Title','Add Load Bid');	
  	  $Model = includeclass('dashboard');
	  //$template->VehicleNumber(); 
	  //$template->SelectDriver(); 
	  $template->display('tmplpopup/header');	
	  $template->display('contact/addloadbid');
	  $template->display('tmplpopup/footer');	
	  break;
	 case 'subscribe':
	  $template->assignRef('Title','Subscribe');	
	  $Model = includeclass('dashboard');
	  $template->display('tmplpopup/header');	
	  $template->display('contact/subscribe');
	  $template->display('tmplpopup/footer');	
	  break;
	  
	case "mysubscription":
		
		$template->assignRef('Title','My Subscriptions');
		$template->display('header');
	    $Model = includeclass('dashboard');
		$template->display('contact/mysubscription');
		$template->display('footer');
	break;
	
	case "confirmsubscribe":
		
		$template->assignRef('Title','Confirm Subscribe');
		$Model = includeclass('dashboard');
		 $template->display('tmplpopup/header');
		$template->display('contact/confirmsubscribe');
		 $template->display('tmplpopup/footer');
		
	break;
	  
	  	case "thank-you":		
		$template->assignRef('Title','Thank You');
		$template->display('header');
	    //$Model = includeclass('dashboard');
		$template->display('contact/thank_you');
		$template->display('footer');
	break;
	
	  default: 
	  $template->assignRef('Title','Get Free Quote');	
	  $template->display('tmplpopup/header');	
	  $template->display('contact/quote');
	  $template->display('tmplpopup/footer');	
	  break;
    }
?>
