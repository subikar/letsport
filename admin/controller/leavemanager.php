<?php  
//error_reporting(0); 
  class Leavemanager extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/leavemanager.js');
			$this->getLeaveRecord();
			$template->display('header');
			$template->display('leavemanager/index');
			$template->display('footer');
	  	 }  
		 
		 function getLeaveRecord()
		 {
		 	global $db, $template, $Config;
            $start = IRequest::getInt('start',0);
            $Limit = ($Config->limit)?$Config->limit:20;
            $start = $start * $Limit;
			
            $whereArray=array();
			$filter_name=$this->getUserState("filter_name");
			$template->assignRef("filter_name",$filter_name);
			
			$filter_date=$this->getUserState("filter_date");
			$template->assignRef("filter_date",$filter_date);
			
            if($filter_name!="")
            {
                $whereArray[]="u.name LIKE ".$db->quote($filter_name);
            }
           if($filter_date!="")
		   {
		   		$dateArray=explode("-",$filter_date);
		   		$whereArray[]="er.month =".(int)$dateArray[1];
				$whereArray[]="er.year =".(int)$dateArray[0];
		    }
            else
			{
				$whereArray[]="er.month =".(int)date("m");
				$whereArray[]="er.year =".(int)date("Y");
			}  
			
            $where="WHERE ".implode(" AND ",$whereArray);
                       
            $Query = "SELECT count(*) FROM #__employee_leave_record as er LEFT JOIN #__employee_leave_relation as elr ON er.employee_id=elr.employee_id LEFT JOIN #__users as u ON elr.employee_id=u.uid ".$where; 
            $db->setQuery($Query);
            $TestCount = $db->getOne();
            $template->SetPagination($TestCount);
             
            $Query = "SELECT er.*,elr.no_of_paid_leave,u.name FROM #__employee_leave_record as er LEFT JOIN #__employee_leave_relation as elr ON er.employee_id=elr.employee_id LEFT JOIN #__users as u ON elr.employee_id=u.uid ".$where;
            $db->setQuery($Query,$start,$Limit);
            $LeaveList = $db->loadObjectList();
			//print_r($Query); exit;
            $template->assignRef('LeaveList',$LeaveList); 
		 }
		 function addmonthlyLeave()
		 {
		 	global $template; 
			$template->includejs('templates/itcslive/js/leavemanager.js');
			$template->display('tmplpopup/header');
			$template->display('leavemanager/addmonthlyleave');
		 	$template->display('tmplpopup/footer');
		 }
		 function saveLeave()
		 {
		 	global $db,$mainframe;
			$post=IRequest::get("POST");
			if((int)$post["user"] > 0 && (int)$post["text_leave"] > 0)
			{
				$monthArray=explode("-",$post["text_month"]);
				if(count($monthArray) > 1)
				{
						$this->post = array("employee_id"=>$post["user"],"leave_deduct"=>$post["text_leave"],"month"=>(int)$monthArray[1],"year"=>$monthArray[0],"create_date"=>date("Y-m-d H:i:s"));
						parent::bind('employee_leave_record');
						parent::save();

						$Query="UPDATE #__employee_leave_relation SET no_of_paid_leave=no_of_paid_leave - ".(int)$post["text_leave"]." WHERE employee_id=".$db->quote($post["user"]);
						$db->setQuery($Query);
						echo '<script>window.parent.location.href="index.php?view=leavemanager"</script>';
						echo "<script>parent.jQuery.colorbox.close();</script>";
				}
				else
				{
					$mainframe->redirect("index.php?view=leavemanager&task=addmonthlyLeave");
				}
			}
			else
			{
				$mainframe->redirect("index.php?view=leavemanager&task=addmonthlyLeave");
			}
			
		 }
		 function addyearlyLeave()
		 {
		 	global $template; 
			$template->includejs('templates/itcslive/js/leavemanager.js');
			$template->display('tmplpopup/header');
			$template->display('leavemanager/addyearlyleave');
		 	$template->display('tmplpopup/footer');
		 }
		 function saveYearlyLeave()
		 {
		 	global $db,$mainframe;
			$post=IRequest::get("POST");
			if((int)$post["user"] > 0 && (int)$post["text_leave"] > 0)
			{
				
				if((int)$post["text_year"] > 0)
				{
						$this->post = array("employee_id"=>$post["user"], "year"=>$post["text_year"], "leave_allocated"=>$post["text_leave"], "create_date"=>date("Y-m-d H:i:s"));
						parent::bind('employee_leave_allocation');
						parent::save();

						$Query="SELECT count(*) FROM `#__employee_leave_relation` WHERE employee_id=".$db->quote($post["user"]);
						$db->setQuery($Query);
            			$recordExist = $db->getOne();
						if((int)$recordExist > 0)
						{
							$Query="UPDATE #__employee_leave_relation SET no_of_paid_leave=no_of_paid_leave + ".(int)$post["text_leave"]." WHERE employee_id=".$db->quote($post["user"]);
							$db->setQuery($Query);
						}
						else
						{
							$this->post = array("employee_id"=>$post["user"], "no_of_paid_leave"=>$post["text_leave"]);
							parent::bind('employee_leave_relation');
							parent::save();
						}
						echo '<script>window.parent.location.href="index.php?view=leavemanager"</script>';
						echo "<script>parent.jQuery.colorbox.close();</script>";
				}
				else
				{
					$mainframe->redirect("index.php?view=leavemanager&task=addyearlyLeave");
				}
			}
			else
			{
				$mainframe->redirect("index.php?view=leavemanager&task=addyearlyLeave");
			}
		 
		 }
		 function ajaxValidateMonthlyLeave()
		 {
		 	global $db;
			$post=IRequest::get("POST");
			$message=""; $status=1;
		 	if((int)$post["user"] == 0):
				$message="Please Select User"; $status=0;
			elseif((int)$post["text_leave"]==0):
				$message="Please fillup leave"; $status=0;
			elseif($post["text_month"]==""):
				$message="Please Select Month"; $status=0;
			endif;
			
			if($status==1)
			{
				$monthArray=explode("-",$post["text_month"]);
				if(count($monthArray)>1)
				{
				
					//check if leave alocation for this year is exist or not..
				$Query="SELECT count(*) FROM #__employee_leave_allocation WHERE employee_id=".$db->quote($post["user"])." AND year=".$db->quote($monthArray[0])." AND year=".$db->quote($monthArray[0]);
					$db->setQuery($Query);
					$allocationExist = $db->getOne();	
					if((int)$allocationExist > 0)
					{
						$Query="SELECT count(*) FROM #__employee_leave_record WHERE employee_id=".$db->quote($post["user"])." AND month=".$db->quote($monthArray[1])." AND year=".$db->quote($monthArray[0]);
						$db->setQuery($Query);
						$recordExist = $db->getOne();	
						if((int)$recordExist > 0)
						{
							$message="Sorry You have already added leave for this user in this month of ".$post["text_month"]; $status=0;
						}
					}
					else
					{
						$message="Please first allocate yearly leave for this user on this year ".$monthArray[0]; $status=0;
					}	
				}	
				else
				{
					$message="Please Select Proper Month"; $status=0;
				}
			}
			print_r(json_encode(array("message"=>$message,"status"=>$status))); exit;
			
		 }
		  function ajaxValidateYearlyLeave()
		 {
		 	global $db;
			$post=IRequest::get("POST");
			$message=""; $status=1;
		 	if((int)$post["user"] == 0):
				$message="Please Select User"; $status=0;
			elseif((int)$post["text_leave"]==0):
				$message="Please fillup leave"; $status=0;
			elseif($post["text_year"]==""):
				$message="Please Select Year"; $status=0;
			endif;
			
			if($status==1)
			{
				$Query="SELECT count(*) FROM #__employee_leave_allocation WHERE employee_id=".$db->quote($post["user"])." AND year=".$db->quote($post["text_year"]);
				$db->setQuery($Query);
            	$recordExist = $db->getOne();	
				if((int)$recordExist > 0)
				{
					$message="Sorry You have already added leave for this user in the year of ".$post["text_year"]; $status=0;
				}
			}
			print_r(json_encode(array("message"=>$message,"status"=>$status))); exit;
		 }
		 function editLeaveRecord()
		 {
		 	global $template,$db; 
			$template->includejs('templates/itcslive/js/leavemanager.js');
			$template->display('tmplpopup/header');
			
			$record_id=IRequest::getInt("record_id");
			$sql="SELECT elr.*,u.name FROM #__employee_leave_record as elr LEFT JOIN #__users as u ON elr.employee_id=u.uid WHERE elr.id=".$db->quote($record_id);
			$db->setQuery($sql);
            $leaveRecord = $db->loadObjectList();
            $template->assignRef('leaveRecord',$leaveRecord[0]); 
			
			$template->display('leavemanager/editleaverecord');
		 	$template->display('tmplpopup/footer');
		 }
		 function updateLeaveRecord()
		 {
		 	global $db;
			$post=IRequest::get("POST");
			
		 	$Query="SELECT leave_deduct FROM #__employee_leave_record WHERE id=".$db->quote($post["record_id"]);
			$db->setQuery($Query);
            $oldRecord = $db->getOne();
			
			$Query="SELECT no_of_paid_leave FROM #__employee_leave_relation WHERE employee_id=".$db->quote($post["employee_id"]);
			$db->setQuery($Query);
            $paidLeave = $db->getOne();
			
			$leaveDiff=(int)$post["text_leave"] - (int)$oldRecord;
			$newPaidLeave=(int)$paidLeave - $leaveDiff;
			
			$UpdateQuery1="UPDATE #__employee_leave_record SET leave_deduct=".$db->quote($post["text_leave"])." WHERE id=".$db->quote($post["record_id"]);
			$db->setQuery($UpdateQuery1);
			
			$UpdateQuery2="UPDATE #__employee_leave_relation SET no_of_paid_leave=".$db->quote($newPaidLeave)." WHERE employee_id=".$db->quote($post["employee_id"]);
			$db->setQuery($UpdateQuery2);
			
			echo '<script>window.parent.location.href="index.php?view=leavemanager"</script>';
			echo "<script>parent.jQuery.colorbox.close();</script>";		
				
		 }
		 function getuserFromAjax()
		 {
		 	global $db;
			$post=IRequest::get("POST");
			$whereArray=array(); $Contacts=array();
			$userHint=$post["filter"]["filters"][0]["value"];
			if($userHint!=""):
				$whereArray[]="LOWER(name) LIKE '%".strtolower($userHint)."%'";
			
				$whereArray[]="status=1";
				$whereArray[]="LOWER(usertype)!='admin'";
				$whereArray[]="LOWER(usertype)!='customer'";
				$where=" WHERE ".implode(" AND ", $whereArray);
				$Query="SELECT uid as value, name as text FROM #__users ".$where." ORDER BY uid DESC";
				$db->setQuery($Query);
				$Contacts = $db->LoadObjectList(); 
			endif;	
			return print_r(json_encode($Contacts)); exit;
		 }
		function getUserState($variable)
		{
			 $post=IRequest::get("POST");
			    if(isset($post[$variable]))
				{
					setcookie($variable,$post[$variable]);
					return $post[$variable];
				}	
				else
				{
					return $_COOKIE[$variable];
				}
		}
		
   }
?>