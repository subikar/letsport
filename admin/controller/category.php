<?php 
 error_reporting(0); 
  class Category extends Master {
         function __construct()
		   {
			    parent::__construct();			  
		   }
		  function display()
		   {
		        global $template; 
				$template->includejs('templates/itcslive/js/category.js');
				$this->getCategoryList();
				$this->getCategories();							
				$template->display('header');
				$template->display('category/category');
				$template->display('footer');
		   } 
		  function  getCategories()
			{
			    global $db, $template, $Config;
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				$Query = "select *  from #__category WHERE category_parent=0";
				$db->setQuery($Query,$start,$Limit);
				$Categories = $db->loadObjectList();
				$template->assignRef('category',$Categories);
			}
			function getAllType()
			{
				global $db, $template, $Config; 
				$Query = "select *  from #__category ";
				$db->setQuery($Query);
				$Categories = $db->loadObjectList();
				$template->assignRef('CategoryType',$Categories);
			}
			function getCategoryList()
			{
				global $db, $template, $Config;
				$categoryId = IRequest::getInt('category');
				$searchCate = IRequest::getVar('type');
				
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				if($categoryId != '')
				{
					$where = "WHERE category_parent=".$categoryId;
				}
				else if($searchCate != '')
				{
					$where = "WHERE type LIKE '%".$searchCate."%' OR category_name  LIKE '%".$searchCate."%'";
				}				
				else
				{
					$where = "WHERE category_parent=0";
				}
				
				$Query = "select count(*) from #__category ".$where; 
				$db->setQuery($Query);
				$CatCount = $db->getOne();
                $template->SetPagination($CatCount);
				
				$Query = "select * from #__category ".$where." order by id ASC";
				$db->setQuery($Query,$start,$Limit);
				$Categories = $db->loadObjectList();
				$template->assignRef('categoryID',$Categories);
			}
		 function addnew()	
		{
			global $template;
			$template->includejs('templates/itcslive/js/category.js');
			$CategoryID=IRequest::getVar("category_id", "");
			if($CategoryID!="")
			{
				$this->getCategorydetails($CategoryID);
				$this->getSeodetails($CategoryID);
			}
			$this->getCategories();
			$this->getAllType();	
			$template->display('header');
			$template->display('category/addnew');
			$template->display('footer');
		}
		function getCategorydetails($CategoryID)
		{
			global $db,$template;
			$Query = "select *  from #__category WHERE id=".(int)$CategoryID;
			$db->setQuery($Query);
			$Pages = $db->loadObjectList();
			$Pages=$Pages[0];		
			$template->assignRef('categoryData',$Pages);
		}
		function getSeodetails($CategoryID)
		{
			global $db,$template;
			$Query = "select *  from #__404 WHERE type='category' AND type_id=".(int)$CategoryID;
			$db->setQuery($Query);
			$Pages = $db->loadObjectList();
			$Pages=$Pages[0];
			$template->assignRef('seoData',$Pages);
		}
		function savepage()
		{
			  global $db, $template, $Config,$mainframe;
              $post = IRequest::get('POST');			
			  $post['modified_on'] = date('Y-m-d h:i');			 
				if((int)$post["category_id"] > 0)
				{				   					 
					 $Query="UPDATE #__category SET category_parent=".$db->quote($post['category_parent']).",
													category_name=".$db->quote($post['category_name']).",
													type=".$db->quote($post['type']).",													
													modified_on=".$db->quote($post['modified_on'])." 
													WHERE id=".$db->quote($post['category_id']);
					$db->setQuery($Query);						
					if($post["alias"]=="")
					{	
					 	$seo=str_replace(" ","-",strtolower(trim($post["category_name"])));
					 }
					 else
					 {
					 	$seo=trim($post["alias"]);
					 }	
					$orgUrl="category.php?id=".(int)$post['category_id'];
					
					$SQL="UPDATE #__404 SET seo=".$db->quote($seo)." WHERE original LIKE ".$db->quote($orgUrl);
					$db->setQuery($SQL);					 
				 }
				 else
				 {
				   	$post['status'] = 1;
					$post['created_on'] = date('Y-m-d h:i');
					$this->post = $post;
					parent::bind('category');
					parent::save();
					$CategoryID=$db->insertid();
						
					if($post["alias"]=="")
					{	
					 	$seo=str_replace(" ","-",strtolower(trim($post["category_name"])));
					 }
					 else
					 {
					 	$seo=trim($post["alias"]);
					 }	
					 $orgUrl="category.php?id=".$CategoryID;
					 $this->post = array("original"=>$orgUrl,"seo"=>$seo, "hits"=>0,"type_id"=>$CategoryID,"type"=>'category');
                     parent::bind('404');					 
                     parent::save();
				  } 
				if($post['Save_close'] != '')
				{				
			   		$mainframe->redirect('index.php?view=category');
				}				
				else if($CategoryID != '')
				{
					$mainframe->redirect('index.php?view=category&task=addnew&category_id='.$CategoryID);
				}
				else
				{
					$mainframe->redirect('index.php?view=category&task=addnew&category_id='.$post['category_id']);
				}
			}		
		
		function Fn_validate_submitForm()
		{
			global $db;
			$post = IRequest::get('POST');
			if((int)$post["category_id"] > 0)
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["type"]))." AND type!='category' AND type_id NOT IN(".$db->quote($post["category_id"]).")";
			}
			else 
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["type"]));
			}
			$SQL="SELECT count(*) FROM #__404 ".$where;
			$db->setQuery($SQL);
			$Data = $db->getOne();
			print_r((int)$Data); exit;
		}	
		function RemoveCategory()
		{
			global  $db,$mainframe;
			$category_id=IRequest::getInt("category_id");
			if((int)$category_id > 0)
			{
				$sql = "DELETE FROM #__404 WHERE type='category' AND type_id=".$db->quote($category_id);
				$db->setQuery($sql);
				
				$sql = "DELETE FROM #__category WHERE id=".$db->quote($category_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=category');
		}
   }
?>