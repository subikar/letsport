<?php 
  defined ('ITCS') or die ("Go away.");
  global $template; 
  $view = IRequest::getVar('view');
  switch($view)
    { 
  	  case 'signup':
		  $template->display('header');	
		  $template->display('login/signup');
		  $template->display('footer');	
	  break;
	 default: 
		  $Model = includeclass('contact');
		  $template->includecss($Config->site."templates/itcslive/css/form.css");
		  $Category = $Model->Category();
		  $template->assignRef('Category',$Category);
		  $template->assignRef('Title','Contact us');
		  $template->display('header');
		  $template->display('contact/index');
		  $template->display('footer');
	}	  
?>