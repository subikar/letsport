<?php 
  class Sitemap {
      function __construct()
	    {
		}
	  function GetSitemap()
	    {
		      global $db;
			  $Query = "select b.title, b.modified, handler.seo from #__blog as b 
			            Left Join #__404 as handler on b.id = handler.type_id  
						where b.status = 1 AND handler.type='blog' order by b.created desc";
			  $db->setQuery($Query);
			  $Blogs = $db->loadObjectList();
			  $Query = "select b.title, b.modified, handler.seo from #__page as b 
			            Left Join #__404 as handler on b.id = handler.type_id  
						where b.status = 1 AND handler.type='page' order by b.created desc";
			  $db->setQuery($Query);
			  $pages = $db->loadObjectList();
			  $Blogs = array_merge($Blogs,$pages);
			  return $Blogs;
             // print_r($Blogs); exit; 

		   
		}
	   function GetSitemapFromContent($Content)
	    {
		   return $Content;
			//$pattern = '[wp-realtime-sitemap]';
			//preg_match_all($pattern, $Content, $matches);
			//print_r($matches); exit;		  
		} 	
	    	
  }
?>