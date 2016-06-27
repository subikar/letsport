<?php 
error_reporting(0); 
  class Company extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/company.js');
			$this->getProjects();
			$template->display('header');
			$template->display('company/company');
			$template->display('footer');
	  	}
		function getProjects()
		{
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$Limit = ($Config->limit)?$Config->limit:20;
			
			$searchBy=IRequest::getVar("title_text","");
				if($searchBy!="")
				{
					$where=" WHERE c.company_name LIKE '%".$searchBy."%' OR u.name LIKE '%".$searchBy."%' OR cu.name LIKE '%".$searchBy."%'";
				}
				else
				{
					$where=" WHERE 1";
				}
						
			$Query = "SELECT count(*) FROM #__company ".$where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "SELECT c.*,u.name as owner, cu.name as creator FROM #__company as c LEFT JOIN #__users as u ON c.owner_id = u.uid LEFT OUTER JOIN #__users as cu ON c.creater_id = cu.uid ".$where." GROUP BY c.id order by c.id desc";
			$db->setQuery($Query,$start,$Limit);
			$Companies = $db->loadObjectList();
			$template->assignRef('Companies',$Companies);
		}  
		
		function RemoveCompany()
		{
			global  $db,$mainframe;
			$company_id = IRequest::getVar('company_id');
			
			$Query = "DELETE from #__company WHERE id=".$db->quote($company_id);
			$db->setQuery($Query);
			
			$SQL = "SELECT DISTINCT(id) FROM #__project WHERE company_id=".$db->quote($company_id);
			$db->setQuery($SQL);
			$projectsIds = $db->loadObjectList();
			foreach($projectsIds as $proj){
				$project_id=$proj->id;
				if((int)$project_id > 0)
				{
					$SQL1 = "DELETE from #__project WHERE id=".$db->quote($project_id);
					$db->setQuery($SQL1);
					
					$sql= "DELETE FROM #__project_relation WHERE project_id=".$db->quote($project_id);
					$db->setQuery($sql);
					
					$SQL = "SELECT id from #__task WHERE project_id=".$db->quote($project_id);
					$db->setQuery($SQL);
					$TaskIds = $db->loadObjectList();
					foreach($TaskIds as $task)
					{
						$SQL = "DELETE from #__task_management WHERE task_id=".$db->quote($task->id);
						$db->setQuery($SQL);
					}	
					
					$SQL = "DELETE from #__task WHERE project_id=".$db->quote($project_id);
					$db->setQuery($SQL);
				}
			}
		}
		function RemoveMultiple()
		{
			global  $db,$mainframe;
			$post=IRequest::get("POST");
			$idInArray=array_values($post["to_select"]);
			foreach($idInArray as $company_id){
				$Query = "DELETE from #__company WHERE id=".$db->quote($company_id);
				$db->setQuery($Query);
				
				$Sql = "SELECT DISTINCT(id) FROM #__project WHERE company_id=".$db->quote($company_id);
				$db->setQuery($Sql);
				$projectsIds = $db->loadObjectList();
				foreach($projectsIds as $proj){
					$project_id=$proj->id;
					if((int)$project_id > 0)
					{
						$SQL1 = "DELETE from #__project WHERE id=".$db->quote($project_id);
						$db->setQuery($SQL1);
						
						$sql= "DELETE FROM #__project_relation WHERE project_id=".$db->quote($project_id);
						$db->setQuery($sql);
						
						$SQL = "SELECT id from #__task WHERE project_id=".$db->quote($project_id);
						$db->setQuery($SQL);
						$TaskIds = $db->loadObjectList();
						foreach($TaskIds as $task)
						{
							$SQL = "DELETE from #__task_management WHERE task_id=".$db->quote($task->id);
							$db->setQuery($SQL);
						}	
						
						$SQL = "DELETE from #__task WHERE project_id=".$db->quote($project_id);
						$db->setQuery($SQL);
					}	
			}		
		}
		$mainframe->redirect('index.php?view=company');	
	}	
}		