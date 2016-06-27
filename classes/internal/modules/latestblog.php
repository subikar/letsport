<?php 
  class Latestblog{
        function __construct()
		  {
		      $this->GetLatestBlogPost();
		  }
		 function GetLatestBlogPost()
		  {
		     global $db,$template;
			 $start = IRequest::getInt('start',0);
			 $Limit = 5;
			 $start = ($start * $Limit );
			 $Query = "select b.title, handler.seo, u.name, c.category_name from #__blog as b 
			            Left Join #__404 as handler on b.id = handler.type_id  
			            Left Join #__users as u on b.author = u.uid  
			            Left Join #__category as c on b.category = c.id  
						where b.status = 1 AND handler.type='blog' order by b.created desc";
			 $db->setQuery($Query,$start,$Limit);
			 $LatestBlogPost = $db->loadObjectList();
			 $template->assignRef('LatestBlogPost',$LatestBlogPost);
			 $template->display('modules/latestblog/post',0);
		  }   
  }
?>