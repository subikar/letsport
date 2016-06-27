<?php 
  class Comments{
        function __construct()
		  {
		   	$this->getComments();
		  }
		  function getComments()
		  {
		      global $db,$template;
			 //$Query="SELECT c.*,g.data FROM `#__comment` as c LEFT JOIN #__gallery as g ON t.gallery_id=g.gallery_id ORDER BY t.id DESC LIMIT 0,10";
			  $Query="SELECT c.*,u.thumb FROM `#__comment` as c LEFT JOIN #__users as u ON c.user_id=u.uid WHERE 1 ORDER BY c.id DESC LIMIT 0,10";
			  $db->setQuery($Query);
			  $commentsInArray = $db->loadObjectList();
			  foreach($commentsInArray as $Com)
			  {
			  	if($Com->thumb && file_exists(IPATH_ROOT."/".$Com->thumb))
				{
					$Com->thumb_image=$Com->thumb;
				}
				else
				{
					$Com->thumb_image="templates/itcslive/images/portfolio/customer_review.png";
				}
			  }
			  $template->assignRef('commentsInArray',$commentsInArray);
			  $template->display('modules/comments/index',0);
		  }
		  		  
  }
?>