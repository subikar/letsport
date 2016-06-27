<?php 
error_reporting(0); 
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
			
			$whereArray=array();
			$post=IRequest::get("POST");
			if($post["txt_name"]!="")
			{
				$whereArray[]="u.name LIKE ".$db->quote($post["txt_name"]);
			}
			if($post["txt_date"]!="")
			{
				$date=$post["txt_date"];
			}
			else
			{
				$date = date('Y-m-d');
			}
			
				$date1=$date." 01:00:00";
				$date2=$date." 23:59:00";
			$whereArray[]="(at.attendence_in BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2)." OR at.attendence_out BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
			
			$where="WHERE ".implode(" AND ",$whereArray);
						
			$Query = "select count(*) from #__attendence as at ".$where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "SELECT at.*,u.name FROM #__attendence as at LEFT JOIN #__users as u ON at.user_id=u.uid ".$where." order by at.id desc";
			$db->setQuery($Query,$start,$Limit);
			$AttendanceList = $db->loadObjectList();
			
			$template->assignRef('AttendanceList',$AttendanceList);
		}
		function getUsers()
		{
			global $db;
			$Sql="SELECT name FROM #__users WHERE usertype LIKE 'employee'";
			$db->setQuery($Sql);
			$Users = $db->loadObjectList();
			print_r(json_encode($Users)); exit;
		}
		
   }
?>