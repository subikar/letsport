<?php 
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Project extends Master 
	{
		var $user_id = NULL;
        function __construct()
		{
			global $my,$mainframe,$Config;
			if((int)$my->uid==0)
			{
				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
					header('HTTP/1.1 400 Please Login First!'); exit;
					//header('Content-Type: application/json; charset=UTF-8');
					//echo json_encode(array('type' => 'login', 'message' => 'Please login first!')); exit;
				}
				else
				{
					$mainframe->redirect($Config->site);
				}
			}
			$this->user_id=$my->uid;
			parent::__construct();
		}
		function display()
		{
			global $template,$my,$mainframe,$Config;		
			$companyList=$this->getCompany();
			$template->assignRef('companyList',$companyList);
			$template->assignRef('project_id',$companyList[0]->projectList[0]->id);
		}
		function getUser()
		{
			global $db, $template, $Config,$mainframe;
			$uid = $this->user_id;
			$sql = "SELECT usertype FROM #__users WHERE uid=".$db->quote($uid);
			$db->setQuery($sql);
			$usertype = $db->getOne();
			return $usertype;
		}
		function project()
		{
			
		}
		function checkLegalAccess($project_id)
		{
			global $my,$db;
			//check if the project access is legal or not.
				$Query="SELECT count(*) FROM #__project_relation WHERE project_id=".$db->quote($project_id)." AND relation_id=".$db->quote($my->uid);
				$db->setQuery($Query);
				$isLegal = $db->getOne();
				if((int)$isLegal > 0):
					return true;
				else:
					header('HTTP/1.1 400 Illegal access!'); exit;
				endif;
		}
		function getTaskFromAjax()
		{
			global $Config,$my,$db;
			$project_id=IRequest::getInt("project_id");
			$CompletedTaskList=array();
			$OngoingTaskList=array();
			if((int)$project_id > 0):
				$this->checkLegalAccess($project_id);
				$taskList=$this->getTaskByProject($project_id);
			else:
				$taskList=$this->getLatestTask();
			endif;
						
			foreach($taskList as $eachList)
			{
				$eachList->updated_before="";
				if($eachList->modified_date=="0000-00-00 00:00:00"):
				$dateOne = new DateTime($eachList->create_date);
				else:
				$dateOne = new DateTime($eachList->modified_date);
				endif;
				$dateTwo = new DateTime(date("Y-m-d H:i"));
				$diff = $dateOne->diff($dateTwo);
				$Format=($diff->d==0 ? ($diff->h==0 ? $diff->i." minutes" : $diff->h." hours" ) : $diff->d." days" ); 
				$eachList->updated_before=$Format;
				
				if((int)$eachList->status==1):
					$CompletedTaskList[]=$eachList;
				else:
					if($eachList->task_completion!="0000-00-00 00:00:00" && time() > strtotime($eachList->task_completion))
					{
						$completionDate= new DateTime($eachList->task_completion);
						$datediff = $completionDate->diff($dateTwo);
						$eachList->over_do=($datediff->d==0 ? ($datediff->h==0 ? $datediff->i." minutes" : $datediff->h." hours" ) : $datediff->d." days" ); 
					}
					$OngoingTaskList[]=$eachList;
				endif;
			}
			
			$taskHtml=array();
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/tasklist.php");
			$taskHtml["content"]= ob_get_clean();
			print_r(json_encode($taskHtml)); exit;
		}
		function getCompanyFromAjax()
		{
			global $db,$my;
			$companyHtml=array();
			$post=IRequest::get("POST");
			if((int)$post["company_id"] > 0)
			{
				$sql="SELECT c.company_name,u.name,u.phone,u.address FROM `#__company` as c LEFT JOIN `#__users` as u ON c.owner_id = u.uid WHERE c.id=".$db->quote($post["company_id"]);
				$db->setQuery($sql);
				
				$companyInfo = $db->loadObjectList();
				$companyInfo=$companyInfo[0];
			}
							
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/companyInfo.php");
			$companyHtml["content"]= ob_get_clean();
			print_r(json_encode($companyHtml)); exit;

		}
		function addToArchiveFromAjax()
		{
			global $db,$my;
			$post=IRequest::get("POST"); $status=0;
			
			if($post["type"]=="company"):
				$Query="UPDATE #__company SET archive=1 WHERE id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				
				$Query="UPDATE #__project SET archive=1 WHERE company_id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				$status=1;
			elseif($post["type"]=="project"):
				$Query="UPDATE #__project SET archive=1 WHERE id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				$status=1;
			endif;
			print_r(json_encode(array("status"=>$status))); exit;	
		}
		function enableFromArchiveFromAjax()
		{
			global $db,$my;
			$post=IRequest::get("POST"); $status=0;
			
			if($post["type"]=="company"):
				$Query="UPDATE #__company SET archive=0 WHERE id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				
				$Query="UPDATE #__project SET archive=0 WHERE company_id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				$status=1;
			elseif($post["type"]=="project"):
				$Query="UPDATE #__project SET archive=0 WHERE id=".$db->quote($post["type_id"]);
				$db->setQuery($Query);
				$status=1;
			endif;
			print_r(json_encode(array("status"=>$status))); exit;	
		}
		function getArchiveFromAjax()
		{
			global $db,$my;
			$companyHtml=array();  $IDArray=array();
			$SQL="SELECT * FROM #__project WHERE archive=1 GROUP BY id ORDER BY id DESC";
			$db->setQuery($SQL);
			$projects = $db->loadObjectList();
			if(count($projects) > 0 ) : 
				foreach($projects as $ID){ $IDArray[]=$ID->company_id; } 
				$ids=implode(",", $IDArray);	
				$cWhere=" WHERE id IN(".$ids.") OR archive=1";
			else:
				$cWhere = "WHERE archive=1";
			endif;
			$sql = "SELECT * FROM #__company ".$cWhere." ORDER BY id DESC";
			$db->setQuery($sql);
			$companyList= $db->loadObjectList();
			foreach($companyList as $comp):
				foreach($projects as $proj):
					if((int)$comp->id==(int)$proj->company_id)
					{
						$comp->projectList[]=$proj;
					}
				endforeach;
			endforeach;	
				
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/archive.php");
			$companyHtml["content"]= ob_get_clean();
			print_r(json_encode($companyHtml)); exit;
		
		}
		function getCompany()
		{
			global $db,$my;
			$companyList=array(); $cWhereArray=array();
			$IDArray=array();
			if($my->usertype == "customer")
			{
				$where= " WHERE pr.relation_id=".$db->quote($my->uid)." AND pr.is_owner=1";
			}
			else if(strtolower($my->usertype) == "admin" || strtolower($my->usertype) == "telecaller")
			{
				$where = " WHERE p.archive=0";
			}
			else
			{
				$where = " WHERE pr.relation_id=".$db->quote($my->uid)." AND p.archive=0";
			}
			
			$SQL="SELECT p.* FROM #__project as p LEFT JOIN #__project_relation as pr ON p.id=pr.project_id".$where." GROUP BY p.id ORDER BY p.id DESC";
			$db->setQuery($SQL);
			$projects = $db->loadObjectList();
			
			if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin')
			{		$cwhere= "WHERE archive=0"; }
			elseif(strtolower($my->usertype) == 'customer')
			{
				if(count($projects) > 0 ) : 
						foreach($projects as $ID){ $IDArray[]=$ID->company_id; } 
						$ids=implode(",", $IDArray);	
						$cwhere="WHERE id IN(".$ids.") OR owner_id=".$db->quote($my->uid);
					else:
						$cwhere = "WHERE owner_id=".$db->quote($my->uid);
					endif;
			}
			else
			{
					if(count($projects) > 0 ) : 
						foreach($projects as $ID){ $IDArray[]=$ID->company_id; } 
						$ids=implode(",", $IDArray);	
						$cwhere="WHERE (id IN(".$ids.") OR creater_id=".$db->quote($my->uid).") AND archive=0";
					else:
						$cwhere = "WHERE creater_id=".$db->quote($my->uid)." AND archive=0";
					endif;
			}
			$sql = "SELECT * FROM #__company ".$cwhere." ORDER BY id DESC";
			$db->setQuery($sql);
			$companyList= $db->loadObjectList();
			foreach($companyList as $comp):
				foreach($projects as $proj):
					if((int)$comp->id==(int)$proj->company_id)
					{
						$comp->projectList[]=$proj;
					}
				endforeach;
			endforeach;
			return $companyList;
		}
		function getProjects($comp_id)
		{
			global $db;
			$sql = "SELECT * FROM #__project WHERE company_id=".$db->quote($comp_id)." AND archive=0";
			$db->setQuery($sql);
			$projectList = $db->loadObjectList();
			return $projectList;
		}
		function getAllProject($project_id=NULL)
		{
			global $my,$db;
			$whereArray=array();
			$whereArray[]="p.archive=0";
			$whereArray[]="p.company_id > 0";
			if($project_id !=NULL)
			$whereArray[]="p.id=".$db->quote($project_id);
			if(in_array(strtolower($my->usertype),array('customer','employee')))
			{
				$whereArray[]="pr.relation_id=".$db->quote($my->uid);
			}
			
			$where=" WHERE ".implode(" AND ",$whereArray);
			$sql = "SELECT p.* FROM #__project as p LEFT JOIN #__project_relation as pr ON p.id=pr.project_id".$where." GROUP BY p.id";
			$db->setQuery($sql);
			$projectList = $db->loadObjectList();
			return $projectList;
		}
		function getTaskByProject($project_id)
		{
			global $db;
			$sql="SELECT p.project_name,t.* ,u.name as modifier_name FROM #__task as t LEFT JOIN #__project as p ON t.project_id=p.id LEFT JOIN #__users as u ON t.modified_by=u.uid WHERE t.project_id =".$db->quote($project_id)." GROUP BY t.id ORDER BY modified_date DESC";
			$db->setQuery($sql);
			$taskList = $db->loadObjectList();
			return $taskList;
		}
		function getLatestTask()
		{
			global $db,$my;
			$projectIDArray=array(); $whereArray=array();
			if(strtolower($my->usertype) == 'telecaller' && strtolower($my->usertype) == 'admin'):
				$whereArray[]="p.archive=0"; 
			elseif(strtolower($my->usertype) == 'customer'):
				$whereArray[]="pr.relation_id=".$db->quote($my->uid);
			else:
				$whereArray[]="pr.relation_id=".$db->quote($my->uid);
				$whereArray[]="p.archive=0"; 
			endif;	
				$whereString=" WHERE ".implode(" AND ",$whereArray);
				
				$SQL="SELECT pr.project_id FROM `#__project` as p  LEFT JOIN `#__project_relation` as pr ON p.id=pr.project_id".$whereString;
				$db->setQuery($SQL);
				$projectIDs = $db->loadObjectList();
				if(count($projectIDs) > 0 )
				{	
					foreach($projectIDs as $ProjectID)
					$projectIDArray[]=$ProjectID->project_id;
				}
			$where="WHERE t.project_id IN(".implode(",",$projectIDArray).")";
			$sql="SELECT t.*,u.name as modifier_name FROM #__task as t LEFT JOIN #__users as u ON t.modified_by=u.uid ".$where." GROUP BY t.id ORDER BY modified_date DESC";
			$db->setQuery($sql);
			$taskList = $db->loadObjectList();
			return $taskList;
		}
		function addcompany()
		{
			
		}
		function getUsersForCompany_fromAjax()
		{
			global $db,$my;	
			$RefUsers=array();	
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				$sql="select uid as value,name as text FROM #__users WHERE LOWER(name) LIKE '%".$userHint."%' AND LOWER(usertype)='customer'";
				$db->setQuery($sql);
				$RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		function savecompany()
		{
			global $db, $template, $Config,$mainframe,$my;
			$mailDetails = array();
			$post = IRequest::get('POST');	
			if($post['owner_id'] == '')
			{
				$post['owner_id'] = $my->uid;
			}
			if($post['owner_id'] != $my->uid)
			{
				$mailDetails['creater_name'] = $my->name;
				$sql = "SELECT email FROM #__users WHERE uid=".$db->quote($post['owner_id']);
				$db->setQuery($sql);
				$mailDetails['email'] = $db->getOne();				
				$this->sendmailForCompany($mailDetails);	
			}	
			$post['creater_id'] = $my->uid;
			$post['create_date'] = date('Y-m-d H:i');
			$this->post = $post;
			parent::bind('company');
			parent::save();
			$Company_id = $db->insertid();
			echo "<script> window.parent.location.href='".$Config->site.'myprojects'."'</script>";
			echo "<script> parent.jQuery.fn.colorbox.close(); </script>";
		}
		function sendmailForCompany($mailDetails)
		{	
			global $Config;	
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/companyaddMail.inc");
			$message = ob_get_clean();
			$message=str_replace('{teleexecutive_name}',$mailDetails["creater_name"],$message);
			$message=str_replace('{company_link}',$Config->site.'myprojects',$message);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="A New Company Added at iTCSLive";
			$mailer->To = $mailDetails['email'];
			$mailer->Message = $message;
			$mailer->send();
		}
		function addproject()
		{
		}
		function getCompanyForProject_fromAjax()
		{
			global $db,$my;	
			$RefCompany=array();	
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin'):
					$where = "WHERE 1";
				else:
					$where ="WHERE owner_id=".$db->quote($my->uid);
				endif;
				$sql="select id as value,company_name as text FROM #__company ".$where." AND LOWER(company_name) LIKE '%".$userHint."%' and owner_id > 0 and creater_id > 0";
				$db->setQuery($sql);
				$RefCompany = $db->LoadObjectList();
			}
			print_r(json_encode($RefCompany)); exit;
		}
		function saveproject()
		{
			global $db, $template, $Config,$mainframe,$my;
			$post = IRequest::get('POST');
			$post['status'] = 0;
			$post['create_date'] = date('Y-m-d H:i');
			$this->post = $post;
			parent::bind('project');
			parent::save();
			$project_id = $db->insertid();
			
			$sql = "SELECT owner_id,company_name from #__company WHERE id=".$db->quote($post['company_id']);
			$db->setQuery($sql);
			$ownerDetails = $db->loadObjectList();
			
			if($ownerDetails[0]->owner_id != $user_id)
			{
				$mailDetails['creater_name'] = $my->name;
				$sql = "SELECT email FROM #__users WHERE uid=".$db->quote($ownerDetails[0]->owner_id);
				$db->setQuery($sql);
				$mailDetails['email'] = $db->getOne();
				$mailDetails['project_id'] = $project_id;
				$mailDetails['company_name'] = $ownerDetails[0]->company_name;
				$this->sendmailForProject($mailDetails);
				
				$post['project_id'] = $project_id;
				$post['relation_id'] = $my->uid;
				$post['is_owner'] = 0;
				$this->post = $post;
				parent::bind('project_relation');
				parent::save();
			}
			$post['project_id'] = $project_id;
			$post['relation_id'] = $ownerDetails[0]->owner_id;
			$post['is_owner'] = 1;
			$this->post = $post;
			parent::bind('project_relation');
			parent::save();
			
			if(in_array(strtolower($my->usertype),array("admin","telecaller","teamleader"))):
				$mainframe->redirect($Config->site.'assignproject?project_id='.$project_id);
			else:
				echo "<script>parent.jQuery.fn.colorbox.close();</script>";
				echo "<script>window.parent.location.href='".$Config->site.'myprojects'."'</script>";
			endif;
		}
		function sendmailForProject($mailDetails)
		{	
			global $Config;	
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/projectaddMail.inc");
			$message = ob_get_clean();
			$message=str_replace('{creator_name}',$mailDetails["creater_name"],$message);
			$message=str_replace('{project_link}',$Config->site.'myprojects#project/'.$mailDetails['project_id'],$message);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="A New Project Added at iTCSLive";
			$mailer->To = $mailDetails['email'];
			$mailer->Message = $message;
			$mailer->send();
		}
		function assignproject()
		{
			global $db,$template;
			$userIDArray = array();
			$project_id = IRequest::getInt('project_id');
			$sql = "SELECT r.relation_id,u.name,u.usertype FROM #__project_relation as r LEFT JOIN #__users as u ON r.relation_id=u.uid WHERE  r.project_id=".$db->quote($project_id)." GROUP BY r.relation_id";
			$db->setQuery($sql);
			$assignedUsers = $db->loadObjectList();
			$RefDetails=array("project_id"=>$project_id,"assignedUsers"=>$assignedUsers);
			$template->assignRef('RefDetails',$RefDetails);	
		}
		function getEmployeeForProject_fromAjax()
		{
			global $db,$my;	
			$RefUsers=array();	
			$project_id = IRequest::getInt('project_id'); 
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				$userIDArray = array();
				$sql = "SELECT r.relation_id,u.name,u.usertype FROM #__project_relation as r LEFT JOIN #__users as u ON r.relation_id=u.uid WHERE  r.project_id=".$db->quote($project_id)." GROUP BY r.relation_id";
				$db->setQuery($sql);
				$assignedUsers = $db->loadObjectList();
				foreach($assignedUsers as $value):
					$userIDArray[] = $value->relation_id;
				endforeach;
				$userids = implode(",",$userIDArray);
				$sql="SELECT uid as value,name as text FROM #__users WHERE uid NOT IN(".$userids.") AND LOWER(name) LIKE '%".$userHint."%'";
				
				$db->setQuery($sql);
				$RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		function saveassignProject()
		{
			global $db,$my,$template, $Config,$mainframe;
			$post = IRequest::get('post');
			$project_id = $post['project_id'];
			$users_id = array_filter($post['user_id']);
			if(count($users_id) > 0)
			{
			$sql="SELECT uid,email FROM #__users WHERE uid IN(".implode(",",$users_id).")";
			$db->setQuery($sql);
			$userIDandEmails = $db->loadObjectList();
			foreach($users_id as $user):
				if((int)$user != 0)
				{
					$post['project_id'] = $project_id;
					$post['relation_id'] = $user;
					$post['is_owner'] = 0;
					$this->post = $post;
					parent::bind('project_relation');
					parent::save();
				}
			endforeach;
			$mailDetails=array("project_id"=>$project_id, "users"=>$userIDandEmails);
			$this->projectAssignmentEMail($mailDetails);
			}
			
			echo "<script> parent.jQuery.fn.colorbox.close();</script>";
			echo "<script>window.parent.location.href='".$Config->site.'myprojects'."'</script>";
		}
		function projectAssignmentEMail($mailDetails)
		{
			global $my,$Config;
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/projectaddMail.inc");
			$message = ob_get_clean();
			
			foreach($mailDetails["users"] as $user)
			{
				if($user->uid!=$my->uid)
				{
				$message=str_replace('{creator_name}',$my->name,$message);
				$message=str_replace('{project_link}',$Config->site.'myprojects#project/'.$mailDetails['project_id'],$message);
				$mailer->From="info@itcslive.com";
				$mailer->Subject="A New Project Added at iTCSLive";
				$mailer->To = trim($user->email);
				$mailer->Message = $message;
				$mailer->send();
				}
			}
		}
		function assigntask()
		{
			global $template,$db,$my;
			$task_id = IRequest::getInt('task_id');
			$sql = "SELECT project_id,task_name FROM #__task WHERE id=".$db->quote($task_id);
			$db->setQuery($sql);
			$task_details = $db->loadObjectList();
			$task_details = $task_details[0];
			$sql = "SELECT r.project_id,r.relation_id,u.name,u.usertype,u.email FROM #__project_relation as r LEFT JOIN #__users as u ON r.relation_id=u.uid WHERE  r.project_id=".$db->quote($task_details->project_id)." AND u.usertype='employee' GROUP BY r.relation_id";
			$db->setQuery($sql);
			$assignUser = $db->loadObjectList();
			$task_details = array("task_id"=>$task_id,"project_id"=>$task_details->project_id,"task_name"=>$task_details->task_name);
			$template->assignRef("task_details",$task_details);
			$template->assignRef("assignUser",$assignUser);
		}
		function saveAssignTask()
		{
			global $db,$Config,$my;
			$post = IRequest::get("post");
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/assigntaskMail.inc");
			$message = ob_get_clean();
			$i=0;
			foreach($post["users"] as $user)
			{
				if($user !=$my->uid)
				{
				$message=str_replace('{task_name}',$post['task_name'],$message);
				$message=str_replace('{task_link}',$Config->site.'myprojects#project/'.$post['project_id'].'/task/'.$post['task_id'],$message);
				$mailer->From="info@itcslive.com";
				$mailer->Subject="A Task is Assigned to You";
				$mailer->To = trim($post['email'][$i]);
				$mailer->Message = $message;
				$mailer->send();
				}
				$i++;
			}
			echo "<script> parent.jQuery.fn.colorbox.close();</script>";
			echo "<script>window.parent.location.href='".$Config->site.'myprojects#project/'.$post['project_id'].'/task/'.$post['task_id']."'</script>";
		}
		function addtask()
		{
			global $template,$db;
			$project_id=IRequest::getInt("project_id");	
			if($project_id != 0)
			{
				$sql = "SELECT id,project_name FROM #__project WHERE id=".$db->quote($project_id)." and company_id > 0";
				$db->setQuery($sql);
				$projectDetails = $db->loadObjectList();
				$Refproject = array("projectDetails"=>$projectDetails,"project_id"=>$project_id);
				$template->assignRef('Refproject',$Refproject);
			}
		}
		function getProjectForTask_fromAjax()
		{
			global $db,$my;	
			$projectList=array();
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				if($my->usertype == 'customer')
				{
					$sql = "SELECT p.id as value,p.project_name as text FROM #__project as p LEFT JOIN #__project_relation as pr ON p.id=pr.project_id WHERE pr.relation_id=".$db->quote($my->uid)." AND LOWER(p.project_name) LIKE '%".$userHint."%' and p.company_id > 0";
				}
				else
				{
					$sql = "SELECT id as value,project_name as text FROM #__project WHERE LOWER(project_name) LIKE '%".$userHint."%' and company_id > 0";
				}
				$db->setQuery($sql);
				$projectList = $db->LoadObjectList();
			}
			print_r(json_encode($projectList)); exit;
		}
		function savetask()
		{
			global $db,$my,$Config;
			$post=IRequest::get("POST");
			$userIds = array();
			$project_id = $post['project'];
			$this->post =array("project_id"=>$project_id, "task_name"=>$post["task_name"], "creator_id"=>$my->uid,"create_date"=>date('Y-m-d H:i'),"modified_date"=>date('Y-m-d H:i'),"modified_by"=>$my->uid);
			parent::bind('task');
			parent::save();
			$taskId =  $db->insertid();
			$sql = "SELECT company_id,project_name FROM #__project WHERE id=".$db->quote($project_id);
			$db->setQuery($sql);
			$project = $db->loadObjectList();
			if(strtolower($my->usertype) == 'customer')
			{
				$sql = "UPDATE #__project SET archive=0 WHERE id=".$db->quote($project_id);
				$db->setQuery($sql);				

				$sql = "UPDATE #__company SET archive=0 WHERE id=".$db->quote($project[0]->company_id);
				$db->setQuery($sql);
			}
			$sql = "SELECT pr.relation_id,u.email FROM #__project_relation as pr LEFT JOIN #__users as u ON pr.relation_id=u.uid WHERE pr.project_id=".$db->quote($project_id)." AND pr.relation_id NOT IN(".$db->quote($my->uid).")";
			$db->setQuery($sql);
			$users = $db->loadObjectList();
			$taskLink = $Config->site."myprojects#project/".$project_id."/task/".$taskId;
			$mailDetails = array("project_name"=>$project[0]->project_name,"users"=>$users,"task_link"=>$taskLink);
			$this->taskAddEMail($mailDetails);
			echo "<script>window.parent.location.href='".$Config->site.'myprojects#project/'.$project_id.'/task/'.$taskId."'</script>";
			echo "<script> parent.jQuery.fn.colorbox.close(); </script>";
		}
		function taskAddEMail($mailDetails)
		{
			global $my,$Config;
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/taskaddMail.inc");
			$message = ob_get_clean();
			
			foreach($mailDetails["users"] as $user)
			{
				$message=str_replace('{creator_name}',$my->name,$message);
				$message=str_replace('{project_name}',$mailDetails['project_name'],$message);
				$message=str_replace('{task_link}',$mailDetails['task_link'],$message);
				$mailer->From="info@itcslive.com";
				$mailer->Subject="A New Task Added at iTCSLive";
				$mailer->To = trim($user->email);
				$mailer->Message = $message;
				$mailer->send();
			}
		}
		function taskContent()
		{
			global $db, $template, $Config,$mainframe,$my;
			$taskHtml=array();
			$post = IRequest::get('POST');
			$task_id=$post['task_id'];
			
			$sql1="SELECT * from #__task WHERE id=".$db->quote($task_id);
			$db->setQuery($sql1);
			$mainTask = $db->loadObjectList();
			$mainTask = $mainTask[0];
			
			$this->checkLegalAccess($mainTask->project_id);	
					
			$sql = "SELECT count(*) from #__employee_task_challenge WHERE employee_id=".$db->quote($my->uid)." and task_id=".$db->quote($task_id);
			$db->setQuery($sql);
			$employeeWorking = $db->getOne();
			
			 if(strtolower($my->usertype)=="customer"): 
			$sql = "SELECT tm.*,u.name FROM #__task_management as tm LEFT JOIN #__users as u on tm.creator_id=u.uid WHERE tm.task_id=".$db->quote($task_id)." AND tm.internal_comment = 0 ORDER BY tm.id DESC";
			else:
			$sql = "SELECT tm.*,u.name FROM #__task_management as tm LEFT JOIN #__users as u on tm.creator_id=u.uid WHERE tm.task_id=".$db->quote($task_id)."  ORDER BY tm.id DESC";
			endif;
			$db->setQuery($sql);
			$taskContent = $db->loadObjectList();
			
			$sql = "SELECT u.name,u.uid,pr.is_owner from #__users as u LEFT JOIN #__project_relation as pr ON u.uid=pr.relation_id WHERE pr.project_id=".$db->quote($mainTask->project_id);
			$db->setQuery($sql);
			$users = $db->loadObjectList();		
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/taskcontent.php");
			$taskHtml["content"] = ob_get_clean();
			print_r(json_encode($taskHtml)); exit;				
		}
		function GetAttachmentContent()
		{		
			global $Config,$db;	
			include_once(IPATH_ROOT.DS."classes/external/priyaTools/resizer.php");
			$Imageparams = array('width' =>60, 'height' =>60);	
			$post=IRequest::get("POST");
			$AttachmentArray = array();
			if($post['attachment'] != '')
			{
				$Attachment = $post['attachment'];
				foreach($Attachment as $value):
					$attachment = base64_decode($value);
					$key = md5($value);
					$this->post = array('filename'=>$attachment,'token'=>$key);
					parent::bind('attachment');
					parent::save();
					$extension = pathinfo($attachment, PATHINFO_EXTENSION);
					
					if(strtolower($extension) == 'gif' || strtolower($extension) == 'png' || strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg')
					{
						$thumb=Resizer::img_resize($attachment,$Imageparams);
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.$thumb."\" height=\"50%\" weight=\"50%\"></a>";
					}
					if(strtolower($extension) == 'pdf')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/pdf.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'txt')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/txt.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'doc' || strtolower($extension) == 'docx' || strtolower($extension) == 'xls' || strtolower($extension) == 'xlsx' || strtolower($extension) == 'xml' || strtolower($extension) == 'xps')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/docx.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'zip' || strtolower($extension) == 'rar')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/zip.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'psd')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/psd.png'."\" height=\"100%\" weight=\"100%\"></a>";
				endforeach;
			}
			if($post['googleattachment'] != '')
			{
				$GoogleAttachment = $post['googleattachment'];	
				foreach($GoogleAttachment as $value):
					$attachment = base64_decode($value);
					$attachment = json_decode($attachment);
					$AttachmentArray[] = "<a href=\"".$attachment->downloadLink."\" target=\"_blank\"><img src=\"".$attachment->iconLink."\" height=\"60px\" weight=\"60px\"></a>";
				endforeach;
			}
			return $AttachmentArray;
		}
		function saveComment()
		{
			global $db, $template, $Config,$mainframe,$my;
			$feedBack=array();
			$taskdetails = array();
			$post = IRequest::get('POST');
		
			if(strtolower($my->usertype) != "employee")
			{
				unset($post['task_hour']);
			}
			$Attachment = $this->GetAttachmentContent(); 
			$totalAttachment = implode(",",$Attachment);
			$post['task_content'] = $post['comment']."<br>".$totalAttachment;
			$post['creator_id'] = $my->uid;
			$post['create_date'] = date('Y-m-d H:i');
			$post['status'] = 1;
			$this->post = $post;
			parent::bind('task_management');
			parent::save();
			$taskContentId = $db->insertid();
			
			$updateArray = array();
			$sql = "SELECT status,total_hour,project_id from #__task WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			$taskDetails = $db->loadObjectList();
			$taskDetails = $taskDetails[0];
			
			//if task is closed..do below..
			if((int)$taskDetails->status==1 && $my->usertype!="employee")
			{
				$query="DELETE FROM #__employee_review WHERE task_id=".$db->quote($post['task_id']);
				$db->setQuery($query);
				$updateArray[] ="status=0";
				$updateArray[] ="task_customer_review=''";
				$feedBack["reopen_status"]=(int)$taskDetails->status;
			}
			
			if((int)$post['task_hour'] != 0 && strtolower($my->usertype) == "employee")
			{
				$taskDetails->total_hour = $taskDetails->total_hour + (int)$post['task_hour'];
				$updateArray[] = "total_hour=".$db->quote($taskDetails->total_hour);
			}
			if((int)$post['text_date'] != 0)
			{
				$updateArray[] = "task_completion=".$db->quote($post['text_date']);
			}
			$updateArray[] ="modified_date=".$db->quote(date('Y-m-d H:i'));
			$updateArray[] ="modified_by=".$db->quote($my->uid);
			
			
			$updateInArray = implode(",",$updateArray); 
			$SQL = "UPDATE #__task SET ".$updateInArray." WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($SQL);
			
			
			if((int)$post['internal_comment'] ==1):
			$where=" WHERE pr.project_id=".$db->quote($taskDetails->project_id)." AND u.usertype !='customer'";
			else:
			$where=" WHERE pr.project_id=".$db->quote($taskDetails->project_id);
			endif;
			
			$sql2 = "SELECT u.email,u.name FROM #__users as u LEFT JOIN #__project_relation pr ON u.uid=pr.relation_id".$where;
			$db->setQuery($sql2);
			$userDetails = $db->loadObjectList();
			
			$sql = "SELECT project_name FROM #__project WHERE id=".$db->quote($taskDetails->project_id);
			$db->setQuery($sql);
			$projectName = $db->getOne();
			
			$mailDetails['users'] = $userDetails;
			$mailDetails['reply'] = nl2br($post['task_content']);
			$mailDetails['replyUser'] = $my->name;
			$mailDetails["project_name"] = $projectName;
			$mailDetails["project_id"] =$taskDetails->project_id;
			$mailDetails["task_id"] =$post['task_id'];
			$this->sendmailToUser($mailDetails); 
			
			$taskHourHtml= ((int)$post['task_hour'] > 0) ? "<strong>Task Hour:</strong>".$post['task_hour'] : " ";
			$removeLink= (strtolower($my->usertype)=="admin") ? "<div style=\"float:right\"><a href=\"javascript:void(0);\" onclick=\"Project.RemoveTaskComment(".(int)$taskContentId.");\">Remove</a></div>" : "" ;
			
			$html="<div id=\"comment_box_".$taskContentId."\"><div class=\"defaultBoxLine5\" style=\"width:96%;\"><div class=\"tb-comment-list\"><div class = \"tb-comment-header\"><div class=\"user_avatar\"><span class=\"tb-avatars-initials undefined\"><i class=\"icon icon-avater\"></i></span></div><div class=\"tb-comment-info tb-comment-info--online\"><a class=\"js-mention-link tb-comment-author\">". $my->name."</a></div>".$removeLink."</div><div class=\"tb-comment-text\"><p>".nl2br($post["task_content"])."</p></div><div>".$taskHourHtml."<span class=\"tb-comment-meta-info\">". date("j F Y h:i A")."</span></div></div></div><div class=\"line\"></div></div>";
			$feedBack["addhtml"]=$html;
			$feedBack["status"]=1;
			
			print_r(json_encode($feedBack)); exit;
		}
		function sendmailToUser($mailDetails)
		{	
			global $Config,$my;
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/ReplyMail_ForProject.inc");
			$message = ob_get_clean();
			$project_link=$Config->site."myprojects/#project/".$mailDetails["project_id"]."/task/".$mailDetails["task_id"];
			$message=str_replace('{project_name}',$mailDetails["project_name"],$message);
			$message=str_replace('{reply}',$mailDetails['reply'],$message);
			$message=str_replace('{executive_name}',$mailDetails['replyUser'],$message);
			$message=str_replace('{project_link}',$project_link,$message);
			foreach($mailDetails['users'] as $value)
			{
				if(trim($value->email)!="info@itcslive.com" && strcasecmp($my->email,$value->email)!=0)
				{
					$mailer->From="info@itcslive.com";
					$mailer->Subject="Project Comment from iTCSLive";
					$mailer->To = trim($value->email);
					$mailer->Message = $message;
					$mailer->send();
				}
			}	
		}
		function getDefaultTaskDetails()
		{
			global $my,$db, $template, $Config,$mainframe;
			$where="";
			$post = IRequest::get('post');
			$taskHtml = array();
			$totalDetails = array();
			$totalHour=array();
			$MonthlyData=array();
			$whereInArray = array();
			if((int)$post['project_id'] != 0)
			{
				$whereInArray[] = "t.project_id=".$db->quote($post['project_id']);
			}
			if((int)$post['user_id'] != 0)
			{
				$whereInArray[] = "tm.creator_id=".$db->quote($post['user_id']);
			} 
			if(strtolower($my->usertype) == 'telecaller' || strtolower($my->usertype) == 'admin')
			{
			}
			else
			{
				$projectIDArray=array();
				$SQL="SELECT project_id FROM #__project_relation WHERE relation_id=".$db->quote($my->uid);
				$db->setQuery($SQL);
				$projectIDs = $db->loadObjectList();
				if(count($projectIDs) > 0 )
				{	
					foreach($projectIDs as $ProjectID)
					$projectIDArray[]=$ProjectID->project_id;
				}
				$whereInArray[] = "tm.creator_id=".$db->quote($my->uid);
				$whereInArray[] = "t.project_id IN(".implode(",",$projectIDArray).")";
			}
			
			$whereInArray[]="t.creator_id > 0";
			$whereInArray[]="tm.task_hour > 0";
			
			if(count($whereInArray) != 0):
				$where =" WHERE ".implode(" AND ",$whereInArray);
			endif;
			
			$sql = "SELECT u.uid,u.name,t.id,t.task_name,sum(tm.task_hour) as task_hour,tm.creator_id,tm.create_date FROM #__task_management as tm LEFT JOIN #__task as t ON tm.task_id=t.id LEFT JOIN #__users as u ON tm.creator_id=u.uid ".$where." GROUP BY tm.task_id,tm.creator_id,DATE(tm.create_date)"; 
			$db->setQuery($sql);
			$taskDetails = $db->loadObjectList();
				
			foreach($taskDetails as $value):
				$date = date_parse_from_format("Y-m-d", $value->create_date);
				$MonthlyData[$date["month"]][]=$value;
				$value->create_date = date('Y-m-d',strtotime($value->create_date));
			endforeach;
			foreach($MonthlyData as $key=>$values):
				for($j=0;$j < count($values); $j++):
					$taskHour=$values[$j]->task_hour;
					for($i=0;$i < count($values); $i++)
					{
						if($j==$i){ continue; }	
					 	if($values[$j]->uid == $values[$i]->uid && $values[$j]->id == $values[$i]->id)
						{
					 		$taskHour +=$values[$i]->task_hour;	
							array_splice($values,$i,1);	
						}
					}
					$totalDetails[$key][]="<tr><td>".$values[$j]->task_name."</td><td><a href=javascript:void(0) onclick='Calendar.userevent(".$values[$j]->uid."); id'>".$values[$j]->name."</a></td><td>".$taskHour."hr</td></tr>";		
				   
				   $totalHour[$key] += $values[$j]->task_hour;
				endfor;
			endforeach;
			$taskHtml['total_hour'] = $totalHour;
			$taskHtml['total_details'] = $totalDetails;
			$taskHtml['defaults'] = $taskDetails;
			print_r(json_encode($taskHtml)); exit;		
		}		
		function getTimeTracking()
		{
			global $my,$db,$Config;
			$taskHtml=array();
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/timetracking.php");
			$taskHtml["timetracking"]= ob_get_clean();
			print_r(json_encode($taskHtml)); exit;
		}
		function getProject_fromAjax()
		{
			global $my,$db,$Config;
			$RefUsers=array();	
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				if($my->usertype == "customer")
				{
					$where= " WHERE pr.relation_id=".$db->quote($my->uid)." AND pr.is_owner=1";
				}
				else if($my->usertype == "employee")
				{
					$where = " WHERE pr.relation_id=".$db->quote($my->uid);
				}
				else
				{
					$where = " WHERE 1";
				}
				$sql = "SELECT p.id as value,p.project_name as text FROM #__project as p LEFT JOIN #__project_relation as pr ON p.id=pr.project_id".$where." AND LOWER(project_name) LIKE '%".$userHint."%' GROUP BY p.id ORDER BY p.id DESC";
				$db->setQuery($sql);
				$RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		function getAttendance()
		{
			global $my,$db,$Config;
			$taskHtml=array();
			ob_start();
				include_once(IPATH_ROOT."/templates/itcslive/project/myattendance.php");
			$taskHtml["myattendance"]= ob_get_clean();
			print_r(json_encode($taskHtml)); exit;
		}
		function getUser_fromAjax()
		{
			global $my,$db,$Config;
			$RefUsers=array();	
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];
			if(trim($userHint)!="")
			{
				if(strtolower($my->usertype) == 'admin')
				{
					$where = " 1";
				}
				else
				{
					$where = " uid=".$db->quote($my->uid);
				}
				$sql="SELECT uid as value,name as text FROM #__users WHERE".$where." AND LOWER(name) LIKE '%".$userHint."%' AND usertype='employee'";				
				$db->setQuery($sql);
				$RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		function getDefaultattendanceDetails()
		{
			global $my,$db, $template, $Config,$mainframe;
			$post = IRequest::get('post');
			//print_r($post); exit;
			if(strtolower($my->usertype) == 'admin')
			{
				if((int)$post['user_id'] != 0)
					$where = "at.user_id=".$db->quote($post['user_id'])." AND ";
				else
					$where = " ";
				$whereAttendance = $where;
			}
			else
			{
				$whereAttendance = "at.user_id=".$db->quote($my->uid)." AND ";
			}
			$taskHtml = array();
			$MonthlyData = array();
			$totalDetails=array();
			if($post['month'] == 'NaN'):
				$month = date('m');
			else:
				if($post['month'] < 10):
					$month = '0'.$post['month'];
				else:
					$month = $post['month'];
				endif;
			endif;			
			$sql = "SELECT u.name,u.uid,EXTRACT(hour FROM at.attendance_in) as inhour,EXTRACT(minute FROM at.attendance_in) as inminute,EXTRACT(hour FROM at.attendance_out) as outhour,EXTRACT(minute FROM at.attendance_out) as outminute,at.today,at.reason FROM #__attendance as at LEFT JOIN #__users as u ON at.user_id=u.uid WHERE ".$whereAttendance."EXTRACT(month FROM at.today)=".$db->quote($month);
			$db->setQuery($sql);
			$attendanceDetails = $db->loadObjectList();
			if(strtolower($my->usertype) == 'admin')
			{
				$whereBreak = $where;
			}
			else
			{
				$whereBreak = "at.user_id=".$db->quote($my->uid)." AND ";
			}
				$sql = "SELECT u.name,u.uid,EXTRACT(hour FROM at.break_start) as starthour,EXTRACT(minute FROM at.break_start) as startminute,EXTRACT(hour FROM at.break_stop) as stophour,EXTRACT(minute FROM at.break_stop) as stopminute,at.break_diff,at.break_start FROM #__breaktime as at LEFT JOIN #__users as u ON at.user_id=u.uid WHERE ".$whereBreak."EXTRACT(month FROM at.break_start)=".$db->quote($month)." AND at.break_start > 0";
			$db->setQuery($sql);
			$breakDetails = $db->loadObjectList();
			foreach($attendanceDetails as $value):
				$date = date_parse_from_format("Y-m-d", $value->today);
				$MonthlyData[$date["month"]][]=$value;
			endforeach;
			foreach($breakDetails as $value):
				$value->break_start = date('Y-m-d',strtotime($value->break_start));
			endforeach;
			
			$values=$MonthlyData[(int)$month];
			$ret_array = array();
			$i=0;
			foreach($values as $value) {
			if((int)$value->inhour > 0):
				foreach($ret_array as $value1) {
					if(	(int)$value1->uid == (int)$value->uid) {
						$value1->no_count++;
						continue 2;
					}
				}
				$ret_array[$i]->no_count = 1;
				$ret_array[$i]->uid = $value->uid;
				$ret_array[$i]->name = $value->name;
				$i++;
			endif;	
			}
			
			foreach($ret_array as $value):
			$totalDetails[]="<tr><td><a href=javascript:void(0) onclick='Calendar.userevent(".$value->uid."); id'>".$value->name."</a></td><td>".$value->no_count." Days</td></tr>";
			endforeach;
			
			/*for($j=0; $j < count($values); $j++)
			{ 
				$total_day = 1;
				for($i=0; $i < count($values); $i++)
				{
				  if((int)$values[$j]->uid > 0 && (int)$values[$i]->uid > 0 && $values[$j]->uid == $values[$i]->uid && $j!=$i )
				  {
						$total_day=$total_day+1;
						unset($values[$i]);
				  }
				}
			
			$totalDetails[]="<tr><td><a href=javascript:void(0) onclick='Calendar.userevent(".$values[$j]->uid."); id'>".$values[$j]->name."</a></td><td>".$total_day." Days</td></tr>";
			$values=array_values($values);
			}*/
				//print_r($totalDetails); exit;
				
				$taskHtml['defaultsattendance'] = $attendanceDetails;
				$taskHtml['defaultsbreaktime'] = $breakDetails;
				$taskHtml['total_day'] = $totalDetails;
				print_r(json_encode($taskHtml)); exit;
			
		}
		function addCompletionDate()
		{
			global $db,$my,$Config,$mainframe;
			$post = IRequest::get('post');
			$sql = "UPDATE #__task SET task_completion=".$db->quote($post['completion_date']) ."WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			
			$post['task_id'] =$post['task_id'];
			$post['employee_id'] =$my->uid;
			$post['task_complete_on'] =$post['completion_date'];
			$this->post = $post;
			parent::bind('employee_task_challenge');
			parent::save();
			$employeeTask_id = $db->insertid();
			print_r($employeeTask_id); exit;
		}
		function completetask()
		{
			global $db, $template, $Config,$mainframe,$my;
			$taskHtml=array();
			$task_id = IRequest::getInt('task_id');
			
			$sql1="SELECT project_id from #__task WHERE id=".$db->quote($task_id);
			$db->setQuery($sql1);
			$mainTask = $db->loadObjectList();
			$mainTask = $mainTask[0];
			
			$sql = "SELECT u.name,u.uid FROM #__project_relation as pr RIGHT JOIN #__task_management as tm ON tm.creator_id=pr.relation_id LEFT JOIN #__users as u ON u.uid=pr.relation_id WHERE pr.project_id=".$db->quote($mainTask->project_id)." AND tm.task_id=".$db->quote($task_id)." and pr.is_owner=0 and u.usertype='employee' and tm.task_hour > 0 GROUP BY tm.creator_id";
			//print_r($sql); exit;
			$db->setQuery($sql);
			$users = $db->loadObjectList();	
			$completeTask['users'] = $users;
			$completeTask['task_id'] = $task_id;	
			$template->assignRef('completeTask',$completeTask);
		}
		function customerreview()
		{
			global $db, $Config,$my;
			$date = date('Y-m-d');
			$post = IRequest::get('POST');
			$mailDetails = array();
			$userRatings=array_filter($post["rating_user"]);
			$sql = "SELECT task_name FROM #__task WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			$taskName = $db->getOne();
			foreach($userRatings as $userID=>$rating)
			{
				$insertData = array(); 
				$insertData['star'] = (int)$rating;
				$insertData['employee_id'] = $userID;
				$insertData['create_date'] = $date;
				$insertData['task_id'] = $post['task_id'];
				$this->post = $insertData;
				parent::bind('employee_review');
				parent::save();
				$sql = "SELECT name,email FROM #__users WHERE uid=".$db->quote($userID);
				$db->setQuery($sql);
				$user = $db->loadObjectList();
				$mailDetails = array("UserName"=>$user[0]->name,"Email"=>$user[0]->email,"TaskName"=>$taskName,"Star"=>(int)$rating);
				$this->mailsendForRating($mailDetails);
			}
			$post["comment"] =mysql_real_escape_string(IRequest::getVar('comment','','POST','STRING',IREQUEST_ALLOWHTML));
			$sql = "UPDATE #__task SET status=1, modified_date=".$db->quote(date('Y-m-d H:i')).", modified_by=".$db->quote($my->uid).", task_customer_review=".$db->quote($post['comment'])." WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			
			echo "<script>window.parent.location.reload(true);</script>";
			echo "<script> parent.jQuery.fn.colorbox.close(); </script>";
		}
		function mailsendForRating($mailDetails)
		{	
			global $Config;	
			$mailer=new IMail;
			ob_start();
			include(IPATH_ROOT."/mail_inc/mailForReview.inc");
			$message = ob_get_clean();
			$message=str_replace('{task_name}',$mailDetails["TaskName"],$message);
			$message=str_replace('{user_name}',$mailDetails["UserName"],$message);
			$message=str_replace('{star}',$mailDetails["Star"],$message);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="Rating on Task For You";
			$mailer->To = $mailDetails['Email'];
			$mailer->Message = $message; 
			$mailer->send();
		}		
		function addtaskdescription()
		{
			global $db,$template;
			$taskDetails = array();
			$task_id = IRequest::getInt('task_id');
			$sql = "SELECT * from #__task WHERE id=".$db->quote($task_id);
			$db->setQuery($sql);
			$task = $db->loadObjectList();
			
			$taskDetails['task_id'] = $task_id;
			$taskDetails['task'] = $task[0];
			$template->assignRef('taskDetails',$taskDetails);
		}
		function savedescription()
		{
			global $db;
			$post = IRequest::get('post');
			//$post["description"] =str_replace("\r\n","", $description );
			$post["description"] =IRequest::getVar('description','','POST','STRING',IREQUEST_ALLOWHTML);
			$sql="UPDATE #__task SET task_description=".$db->quote($post['description'])."WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			
			$sql = "SELECT project_id from #__task WHERE id=".$db->quote($post['task_id']);
			$db->setQuery($sql);
			$project_id = $db->getOne();
			echo "<script>window.parent.location.reload(true);</script>";
			echo "<script> parent.jQuery.fn.colorbox.close(); </script>";
		}
		function RemoveTaskComment()
		{
			global $db;
			$post = IRequest::get('post');
			if((int)$post["comment_id"] > 0)
			{
				$SQL="SELECT task_hour, task_content ,task_id FROM #__task_management WHERE id=".$db->quote($post["comment_id"]);
				$db->setQuery($SQL);
				$result=$db->loadObjectList();
				
				$match=array();
				$url = preg_match_all('/href=["\']?([^"\'>]+)["\']?/', $result[0]->task_content, $match);
				if(count($match) > 0)
				{
					foreach($match[1] as $href):
						$QueryString = parse_url($href)["query"]; $queryArray=explode("=",$QueryString); $token=$queryArray[1];
						
						if($token!="")
						{
							$Query="SELECT filename FROM #__attachment WHERE token = ".$db->quote(trim($token));
							$db->setQuery($Query);
							$file=$db->getOne();
							$file_path=IPATH_ROOT."/".$file;
							if($file!="" && file_exists($file_path))
							{ 
								unlink($file_path); 
								$DELQuery="DELETE FROM #__attachment WHERE token=".$db->quote(trim($token));
								$db->setQuery($DELQuery);
							}
						}
					endforeach;
				}
	
				if($result[0]->task_hour > 0)
				{
					$sql="UPDATE #__task SET total_hour = total_hour - ".(int)$result[0]->task_hour." WHERE id=".$db->quote($result[0]->task_id);
					$db->setQuery($sql);
				}
				
				$Query="DELETE FROM #__task_management WHERE id=".$db->quote($post["comment_id"]);
				$db->setQuery($Query);
				$message="Successfully Deleted!";
				$status=1;
			}
			else
			{
				$message="Not Deleted!";
				$status=0;
			}
			
			print_r(json_encode(array("message"=>$message,"status"=>$status))); exit;
		}
		/*function array_atha_values($array) {
			$ret_array = array();
			foreach($array as $value) {
				foreach($ret_array as $key2 => $value2) {
					if(	$key2 == $value->uid && (int)$values->inhour > 0) {
						$ret_array[$key2]++;
						continue 2;
					}
				}
				$ret_array[$value->uid] = 1;
			}
			return $ret_array;
		}*/
	}		
?>