<?php
  defined ('ITCS') or die ("Go away.");
	  global $template;
	  $template->cache = 1;
	  $template->compress = 1;
	  
	  $Model = includeclass('page');
	  $Content = $Model->GetContent();
	 
	  $template->assignRef('Title',$Content->metatitle);
	  $template->assignRef('Keyword',$Content->metakeyword);
	  $template->assignRef('Description',$Content->metadescription);
	  
	  $template->assignRef('sectionclass',$Content->pageclass);
	 
	  $template->assignRef('Content',$Content);
		  
	  $template->display('header');
	  if($Content->isfullpage)
	     $template->display('bodyfull');
      else
	    $template->display('body');
	  $template->display('footer');
?>