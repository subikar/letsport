<?php 
error_reporting(0); 
  class Project extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/project.js');
			$this->getProjects();
			$template->display('header');
			$template->display('project/project');
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
					$where=" WHERE project_name LIKE '%".$searchBy."%' OR company_name LIKE '%".$searchBy."%'";
				}
				else
				{
					$where=" WHERE 1";
				}
						
			$Query = "select count(*) from #__project ".$where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "SELECT p.*,c.company_name FROM #__project as p LEFT JOIN #__company as c ON p.company_id = c.id ".$where." order by p.id desc";
			$db->setQuery($Query,$start,$Limit);
			$Projects = $db->loadObjectList();
			$template->assignRef('Projects',$Projects);
		}  
		
		function RemoveProject()
		{
			global  $db,$mainframe;
			$project_id = IRequest::getVar('project_id');
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
		function RemoveMultiple()
		{
			global  $db,$mainframe;
			$post=IRequest::get("POST");
			$idInArray=array_values($post["to_select"]);
			//$ids=implode(",", $idInArray);

			foreach($idInArray as $project_id):	
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
			endforeach	;
			$mainframe->redirect('index.php?view=project');			
		}
}		