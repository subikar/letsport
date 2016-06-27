<?php 
 error_reporting(0); 
  class Menu extends Master {
         function __construct()
		   {
		        
			    parent::__construct();
			  
		   }
		  function display()
		   {
		        global $template; 
				$this->getMenuItems();
				$this->getParentMenuList();
				$template->display('header');
				$template->display('menu/menu');
				$template->display('footer');
		   }  
		  function  getMenuItems()
			{
			    global $db, $template, $Config;
				$whereArray=array();
				$parent=IRequest::getInt('parent');
				$whereArray[]= "parent=".$db->quote($parent);
				$searchBy=IRequest::getVar("title_text","");
				if($searchBy!="")
				{
					$whereArray[]=" (title LIKE '%".$searchBy."%' OR alias LIKE '".$searchBy."')";
				}
				$where=" WHERE ".implode(" AND ",$whereArray);
				
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				$start = $start * $Limit;
				
				$Query = "select count(*) from #__menu".$where;
				$db->setQuery($Query);
				$MenuCount = $db->getOne();
                $template->SetPagination($MenuCount);
				
				$Query = "select * from #__menu".$where." order by ordering ASC";
				$db->setQuery($Query,$start,$Limit);
				$Menus = $db->loadObjectList();
				$template->assignRef('menus',$Menus);
		  }
		  
		  function getParentMenuList()
		  {
		  		global $db, $template, $Config;
				
				$Query = "select * from #__menu WHERE parent=0 order by ordering ASC";
				$db->setQuery($Query);
				$Menus = $db->loadObjectList();
				$template->assignRef('ParentMenus',$Menus);
		  
		  }
		
		 function addnew()	
		{
			    global $template;
				/*$template->includecss('templates/itcslive/js/colorbox/colorbox.css');
				$template->includejs('templates/itcslive/js/colorbox/jquery.colorbox.js');*/
				$template->includejs('templates/itcslive/js/menu.js');
				$this->getParentMenues();
				$this->GetMenuType();
				$MenuID=IRequest::getVar("menu_id", "");
				if($MenuID!="")
				{
				$this->getMenudetails($MenuID);
				}
				$template->display('header');
				$template->display('menu/addnew');
				$template->display('footer');
		}
		function getMenudetails($MenuID)
		{
			global $db,$template;
			$Query = "select *  from #__menu WHERE id=".(int)$MenuID;
			$db->setQuery($Query);
			$Menues = $db->loadObjectList();
			$Menues=$Menues[0];
			$template->assignRef('menuData',$Menues);
		}
		function getParentMenues()
		{
			global $db,$template;
			$Query = "select *  from #__menu WHERE parent=0";
				$db->setQuery($Query);
				$Menues = $db->loadObjectList();
			$template->assignRef('ParentMenuList',$Menues);
		}
		function GetMenuType()
		{
			global $db,$template;
			$Query = "select distinct(type) from #__404 WHERE 1";
				$db->setQuery($Query);
				$menuType = $db->loadObjectList();
			$template->assignRef('MenuType',$menuType);
		}
		function Fn_getMenubyType()
		{
			global $db;
			$typeName=IRequest::getVar("typeName","");
			if($typeName!="")
			{
			$where="WHERE type LIKE ".$db->quote($typeName);
			$Query = "select seo from #__404 ".$where." ORDER BY seo ASC";
				$db->setQuery($Query);
				$menuItems = $db->loadObjectList();
				$MenuName=array();
				foreach($menuItems as $key=>$Item)
				{
					$MenuName[$key]["Title"]=ucwords(str_replace("-", " ", $Item->seo));
					$MenuName[$key]["seo"]=$Item->seo;
				}
				print_r(json_encode($MenuName)); exit;
			}		
		}
		function Fn_validate_submitForm()
		{
			global $db;
			 $post = IRequest::get('POST');
			$sql="SELECT count(*) FROM #__menu WHERE alias LIKE ".$db->quote($post["alias"]);
			$db->setQuery($sql);
			$Data = $db->getOne();
			print_r((int)$Data); exit;
		}
		function saveMenu()
		{
			   global  $db,$mainframe;
			   $post = IRequest::get('POST');
			   if($post["ordering"] == "")
			   {
			   		$Sql="SELECT count(id) FROM #__menu WHERE parent=".$db->quote($post["parent"]);
					$db->setQuery($Sql);
					$count = $db->getOne();
					$post["ordering"]=$count;
			   }
			   if((int)$post["menu_id"] > 0)
			   {
			   	 $SQL="UPDATE #__menu SET parent=".$db->quote($post["parent"]).",
				 						 title=".$db->quote($post["title"]).", 
										 alias=".$db->quote($post["alias"]).", 
										 status=1, 
										 ordering=".$db->quote($post["odering"]) ." 
										 WHERE id=".$db->quote($post["menu_id"]);			   
			   $db->setQuery($SQL);			   
			   }
			   else
			   {
				   $post['status'] = 1;
				   $post['ordering']=5;
				   $this->post = $post;
				   parent::bind('menu');
				   parent::save();
				   $MenuID=$db->insertid();
			   }
			   if($post['Save_close'])
			   {
			   		$mainframe->redirect('index.php?view=menu');
			   }
			   else if($MenuID != '')
			   {
			   		$mainframe->redirect('index.php?view=menu&task=addnew&menu_id='.$MenuID);
			   }
			   else
			   {
			   		$mainframe->redirect('index.php?view=menu&task=addnew&menu_id='.$post['menu_id']);
			   }
	}
	function RemoveMenu()
	{
		  global  $db,$mainframe;
		$menu_id=IRequest::getInt("menu_id");
		if((int)$menu_id > 0)
		{
			$sql="DELETE FROM #__menu WHERE id=".$db->quote($menu_id);
			$db->setQuery($sql);
		}
		$mainframe->redirect('index.php?view=menu');
	}	
		
   }
?>