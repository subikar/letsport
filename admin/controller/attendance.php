<?php  
//error_reporting(0); 
  class Attendance extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/attendance.js');
			$this->getAttendance();
			$template->display('header');
			$template->display('attendance/index');
			$template->display('footer');
	  	 }  
		function  getAttendance()
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
            if($filter_date!="" )
            {
                $date1=$filter_date."-01"; $date2=$filter_date."-31";;
            }
            else
            {
                $date1 = $date2 = date('Y-m-d');
            }
           
            $datetime1=$date1." 01:00:00";
            $datetime2=$date2." 23:59:00";
               
            $whereArray[]="(at.attendance_in BETWEEN ".$db->quote($datetime1)." AND ".$db->quote($datetime2)." OR at.attendance_out BETWEEN ".$db->quote($datetime1)." AND ".$db->quote($datetime2)." OR at.today BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
           
            $where="WHERE ".implode(" AND ",$whereArray);
                       
            //$Query = "select count(*) from #__attendance as at ".$where;
            $Query = "SELECT count(*) FROM #__attendance as at LEFT JOIN #__users as u ON at.user_id=u.uid ".$where;
            $db->setQuery($Query);
            $TestCount = $db->getOne();
            $template->SetPagination($TestCount);
             
            $Query = "SELECT at.*,u.name FROM #__attendance as at LEFT JOIN #__users as u ON at.user_id=u.uid ".$where." order by at.id desc";
            $db->setQuery($Query,$start,$Limit);
            $AttendanceList = $db->loadObjectList();
            $template->assignRef('AttendanceList',$AttendanceList);
			//print_r($db); exit;
			$users = array();
			foreach($AttendanceList as $attendance):
				$users[]= $attendance->user_id;
			endforeach;
			$breakQuery = "SELECT * FROM #__breaktime WHERE user_id IN (".implode(",",$users).") AND (break_start BETWEEN ".$db->quote($datetime1)." AND ".$db->quote($datetime2).")";
			$db->setQuery($breakQuery);
			$BreakList = $db->loadObjectList();
			$template->assignRef('BreakList',$BreakList);
        }
		function getUsers()
		{
			global $db;
			$Sql="SELECT name FROM #__users WHERE usertype LIKE 'employee'";
			$db->setQuery($Sql);
			$Users = $db->loadObjectList();
			print_r(json_encode($Users)); exit;
		}
		
		function editattendance()
		{
			global $template,$db;
			$template->includejs('templates/itcslive/js/attendance.js');
			$AttendanceID = IRequest::getVar("attendance_id", "");
			if($AttendanceID != "")
			{
				$sql = "SELECT u.name,at.* FROM #__attendance as at LEFT JOIN #__users as u ON at.user_id=u.uid WHERE at.id=".$db->quote($AttendanceID);
				$db->setQuery($sql);
				$attendaceDetails = $db->loadObjectList();
				$attendaceDetails = $attendaceDetails[0];
			}
			$template->assignRef('attendaceDetails',$attendaceDetails);
			$template->display('header');
			$template->display('attendance/editattendance');
			$template->display('footer');
		}
		function saveattendance()
		{
			global $db, $template, $Config,$mainframe;
            $post = IRequest::get('POST');
			if($post['attendance_out'] != '')
			{
				$sql = "UPDATE #__attendance SET attendance_out=".$db->quote($post['attendance_out']).",
												attendance_in=".$db->quote($post['attendance_in']).",
												reason=".$db->quote($post['reason']).",
												ip=".$db->quote($post['ip_address']).",
												timezone=".$db->quote($post['timezone'])." WHERE id=".$db->quote($post['attendance_id']);
				$db->setQuery($sql);
			}
			if($post['Save_close'] != '')
			{				
				$mainframe->redirect('index.php?view=attendance');
			}				
			else
			{
				$mainframe->redirect('index.php?view=attendance&task=editattendance&attendance_id='.$post['attendance_id']);
			}
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