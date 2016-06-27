<?php 
error_reporting(0);
  class Comment extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/comment.js');
			$this->getcomments();
			$template->display('header');
			$template->display('comment/comment');
			$template->display('footer');
	  	 }  
	  	function  getcomments()
		{
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$searchTest = IRequest::getVar('search_cmnt');
			$Limit = ($Config->limit)?$Config->limit:20;
			if($searchTest != '')
			{
				$where = "WHERE name LIKE '%".$searchTest."%' OR type  LIKE '%".$searchTest."%'";
			}
			else
			{
				$where = "";
			}			
			$Query = "select count(*) from #__comment ".$where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__comment ".$where." order by id desc";
			$db->setQuery($Query,$start,$Limit);
			$Comments = $db->loadObjectList();
			$template->assignRef('comment',$Comments);
		}
		function addnew()	
		{
			global $template;
			$template->includejs('templates/itcslive/js/comment.js');
			$CommentID = IRequest::getVar("comment_id", "");
			if($CommentID!="")
			{
				$this->getCommentDetails($CommentID);
				//$this->getSeodetails($CommentID);
			}
			$template->display('header');
			$template->display('comment/addnew');
			$template->display('footer');
		}
		function getCommentDetails($CommentID)
		{
			global $db,$template;
			$Query = "select *  from #__comment WHERE id=".(int)$CommentID;
			$db->setQuery($Query);
			$Comments = $db->loadObjectList();
			$Comments=$Comments[0];			
			$template->assignRef('commentData',$Comments);
		}
		/*function getSeodetails($CommentID)
		{
			global $db,$template;
			$Query = "select *  from #__404 WHERE type='comment' AND type_id=".(int)$CommentID;
			$db->setQuery($Query);
			$Pages = $db->loadObjectList();
			$Pages=$Pages[0];
			$template->assignRef('seoData',$Pages);
		}*/
		function savepage()
		{
			  global $db, $template, $Config,$mainframe;
              $post = IRequest::get('POST');
			  $comment = IRequest::getVar('comment','','POST','STRING',IREQUEST_ALLOWHTML);
			  $post['comment']=$comment;
			  $post['modified'] = date('Y-m-d h:i');			   
				if((int)$post["comment_id"] > 0)
				{				 
					 $Query="UPDATE #__comment SET name=".$db->quote($post['name']).",
													email=".$db->quote($post['email']).",
													comment=".$db->quote($post['comment']).", 
													type=".$db->quote($post['type']).",													
													modified=".$db->quote($post['modified'])." 
													WHERE id=".$db->quote($post['comment_id']);
					$db->setQuery($Query);	
										
					/*if($post["alias"]=="")
					{	
					 	$seo=str_replace(" ","-",strtolower(trim($post["name"])));
					 }
					 else
					 {
					 	$seo=trim($post["alias"]);
					 }		
					$orgUrl="comment.php?id=".(int)$post['comment_id'];					 
					$SQL="UPDATE #__404 SET seo=".$db->quote($seo)." WHERE original LIKE ".$db->quote($orgUrl);
					$db->setQuery($SQL);		*/			 
				   }
				   else
				   {				   		
					   	$post['status'] = 1;
					   	$post['created'] = date('Y-m-d h:i');
					   	$post['comment']  = $comment;
						$this->post = $post;
						parent::bind('comment');
						parent::save();
						$CommentID=$db->insertid();
						/*if($post["alias"]=="")
						{	
							$seo=str_replace(" ","-",strtolower(trim($post["name"])));
						 }
						 else
						 {
							$seo=trim($post["alias"]);
						 }		
						$orgUrl="comment.php?id=".$CommentID;
						$this->post=array("original"=>$orgUrl,"seo"=>$seo, "hits"=>0,"type"=>"comment","type_id"=>$CommentID);
						parent::bind('404');
						parent::save();*/
						//print_r($db); exit;
				  } 
				  if($post['Save_close'] != '')	
				  {			
			   	 	$mainframe->redirect('index.php?view=comment');
				  }
				 else if($CommentID != '')
				 {
				 	$mainframe->redirect('index.php?view=comment&task=addnew&comment_id='.$CommentID);
				 }
				 else
				 {
				 	$mainframe->redirect('index.php?view=comment&task=addnew&comment_id='.$post['comment_id']);
				 }
			}	
			
		function Fn_validate_submitForm()
		{
			global $db;
			$post = IRequest::get('POST');
			if((int)$post["comment_id"] > 0)
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(str_replace(" ","-",strtolower($post["name"])))." AND type != 'comment' AND type_id NOT IN(".$db->quote($post["comment_id"]).")";
			}
			else
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(str_replace(" ","-",strtolower($post["name"])));
			}
			$SQL="SELECT count(*) FROM #__404 ".$where;
			//print_r($SQL); exit;
			$db->setQuery($SQL);
			$Data = $db->getOne();
			print_r((int)$Data); exit;
		}
		function RemoveComment()
		{
			global  $db,$mainframe;
			$comment_id=IRequest::getInt("comment_id");
			if((int)$comment_id > 0)
			{				
				/*$sql = "DELETE FROM #__404 WHERE type='comment' AND type_id=".$db->quote($comment_id);
				$db->setQuery($sql);*/
				
				$sql = "DELETE FROM #__comment WHERE id=".$db->quote($comment_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=comment');
		}
		
   }
?>