<?php
defined ('ITCS') or die ("Go away.");
  class Page {
         var $test = NULL;
         function __construct()
		    {
			   
			}
		 function GetContent()
		   {
		      global $db; 
			  $page_id = IRequest::getInt('id');
			  $Query = "select * from #__page where id = ".$db->quote($page_id);
			  $db->setQuery($Query);
			  $Content = $db->loadObjectList();
			  $Content = isset($Content[0])?$Content[0]:NULL;
			  $Content->content = $this->AddModule($Content->content);
			  $Content->content = $this->AddGallery($Content->content);
			  $Content->content = $this->AddSitemap($Content->content);
			  $Content->content = $this->AddYouTubeVideo($Content->content);
			  return $Content;
		   }
		  function AddModule($Content)
		  {
		  	  $model = includeclass('gallery');
			  $Content = $model->GetModuleFromContent($Content);
			  return $Content;
		  } 
		 function AddGallery($Content)
		   {
		      $model = includeclass('gallery');
			  $Content = $model->GetGalleryFromContent($Content);
			  return $Content;
			  
		   }
		 function AddSitemap($Content)
		   {
		      $model = includeclass('sitemap');
			  $Content = $model->GetSitemapFromContent($Content);
			  return $Content;
		   }
		 function AddYouTubeVideo($Content)
		   {
				$pattern = '/\[youtube.*[ ]+id=(?P<id>[0-9 A-Z a-z]+)[ ]+width=(?P<width>[0-9 A-Z a-z]+)[ ]+height=(?P<height>[0-9 A-Z a-z]+)[ ].*\]/u';
				preg_match_all($pattern, $Content, $matches);
				//print_r($matches);
				if(isset($matches[id][0]) && $matches[id][0] != '')
				  {
				    $html = '<iframe  width="90%" height="'.$matches['height'][0].'" src="https://www.youtube.com/embed/'.$matches[id][0].'?autoplay=1&controls=0&iv_load_policy
=3&rel=0&showinfo=0&modestbranding=1" frameborder="0" loop=1></iframe>';
				    $Content = str_replace($matches[0][0], $html, $Content);
				  }
				//print_r($matches); exit;
		   
		     return $Content;
		   }  
		   	
  }
?>