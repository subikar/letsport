<?php 
  class Clientspeak{
		 function __construct()
		  {
		   	$this->getTestimonials();
		  }
		  function getTestimonials()
		  {
		      global $db,$template;
			 $Query="SELECT count(*) FROM `#__testimonial` as t LEFT JOIN #__gallery as g ON t.gallery_id=g.gallery_id ORDER BY t.id DESC";
			  $db->setQuery($Query);
			  $ClientsSpeakCount = $db->getOne();
			  $template->assignRef('ClientsSpeakCount',$ClientsSpeakCount);
			  $template->display('modules/clientspeak/post',0);
		  } 
  }
?>