<?php
//error_reporting(0); 
defined ('ITCS') or die ("Go away.");
  class Dashboard extends Master 
  {
  	var $test = NULL;
    function __construct()
	{
		parent::__construct();
	}
	function dashboard()
	{
		global $template,$my,$db;
	    $Contacts=$this->getContact();
	  	$template->assignRef('Contacts',$Contacts);
	   	$Tickets=$this->getTicket();
	  	$template->assignRef('Tickets',$Tickets);
	   	$Projects=$this->getProject();
	  	$template->assignRef('Projects',$Projects);
	  	$Invoice=$this->getInvoice();
	  	$template->assignRef('TotalDue',$Invoice);
	  
	 	$attendance = $this->getAttendance();
	  	$template->assignRef('attendance',$attendance);
	 	$googleToken = $this->getGoogleToken();
	  	$template->assignRef('googleToken',$googleToken);
		if(strtolower($my->usertype)!="admin" && strtolower($my->usertype)!="customer")
		{
			$leaveDetail = $this->getLeaveDetail();
			$template->assignRef('leaveDetail',$leaveDetail);
		}
	}
	function getGoogleToken()
	{
		global $my,$db,$template;
		$Query="SELECT * FROM #__googleapi WHERE user_id=".$db->quote($my->uid);
		$db->setQuery($Query);
		$googletoken = $db->loadObjectList();
		$googletoken = $googletoken[0];
		return $googletoken;
	}
	function getLeaveDetail()
	{
		global $my,$db,$template;
		$leaveList=array();		
		$Query="SELECT * FROM #__employee_leave_record WHERE employee_id=".$db->quote($my->uid);
		$db->setQuery($Query);
		$leaveRecord = $db->loadObjectList();
		$leaveList["leave_record"]=$leaveRecord;
		
		$Query="SELECT no_of_paid_leave FROM #__employee_leave_relation WHERE employee_id=".$db->quote($my->uid);
		$db->setQuery($Query);
		$paid_leave = $db->getOne();
		$leaveList["paid_leave"]=$paid_leave;
		
		$Query="SELECT * FROM #__employee_leave_allocation WHERE employee_id=".$db->quote($my->uid);
		$db->setQuery($Query);
		$allocationList = $db->loadObjectList();
		$leaveList["allocation_record"]=$allocationList;
		return $leaveList;
	}
			
	function getAttendance()
	{
		global $my,$db,$template;
		date_default_timezone_set("Asia/Kolkata");
		$whereArray=array();
		$date = date('Y-m-d');
		$date1=$date." 01:00:00";
		$date2=$date." 23:59:00";
		$whereArray[]="user_id=".$db->quote($my->uid);
		$whereArray[]="(attendance_in BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2)." OR attendance_out BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
		$where="WHERE ".implode(" AND ",$whereArray);
		$sql = "SELECT attendance_in, attendance_out FROM #__attendance ".$where;
		$db->setQuery($sql);
		$attendance = $db->loadObjectList();
		$attendance=$attendance[0];
		if(isset($attendance->attendance_in) && $attendance->attendance_in=="0000-00-00 00:00:00")
			unset($attendance->attendance_in);
			
		if(isset($attendance->attendance_out) && $attendance->attendance_out=="0000-00-00 00:00:00")
			unset($attendance->attendance_out);
				
		return $attendance;
	}
	function getTicket()
	{
		global $db,$template,$my;
		$customerInArray=array();
		if(strtolower($my->usertype) == "telecaller")
		{
			$Sql="SELECT customer_id FROM #__user_telecaller_relation WHERE telecaller_id=".$db->quote($my->uid);
			$db->setQuery($Sql);
			$customer_ids = $db->LoadObjectList(); 
			foreach($customer_ids as $customer)
			{
				$customerInArray[]=$customer->customer_id;
			}
		} 
		else if(strtolower($my->usertype) == "admin")
		{
			$sql = "SELECT customer_id FROM #__user_telecaller_relation";
			$db->setQuery($sql);
			$customer_ids = $db->LoadObjectList(); 
			foreach($customer_ids as $customer)
			{
				$customerInArray[]=$customer->customer_id;
			}
		}
		else
		{
			$customerInArray[]=$my->uid;
		}
			
		if(count($customerInArray) > 0)
		{
			$customers=implode(",",$customerInArray);
			$Query="SELECT t.*,u.name,u.Company FROM #__ticket as t LEFT JOIN #__users as u ON t.owner_id=u.uid WHERE t.owner_id IN(".$customers.") AND t.status=1 AND t.parent_id=0 ORDER BY t.id DESC LIMIT 0,4";
			$db->setQuery($Query);
			$Tickets = $db->LoadObjectList(); 
		}
		else
		{
			$Tickets=array();
		}
		return $Tickets;
	}	
	function getContact()
	{
		global $db,$my;
		if(strtolower($my->usertype) == 'admin')
			$Query="SELECT uid,refrer_id,name,email,phone FROM #__users WHERE status=1 AND usertype='customer' OR refrer_id=".$db->quote($my->uid)." ORDER BY uid DESC LIMIT 0,5";
		else
		$Query="SELECT uid,refrer_id,name,email,phone FROM #__users WHERE status=1 AND refrer_id=".$db->quote($my->uid)." ORDER BY uid DESC LIMIT 0,5";
		$db->setQuery($Query);
		$Contacts = $db->LoadObjectList(); 
		return $Contacts;
	}
	function getProject()
	{
		global $db,$my;
		if($my->usertype == "customer")
		{
			$where= " WHERE pr.relation_id=".$db->quote($my->uid)." AND pr.is_owner=1";
		}
		else if($my->usertype == "employee")
		{
			$where = " WHERE pr.relation_id=".$db->quote($my->uid)." AND p.archive=0";
		}
		else
		{
			$where = " WHERE p.archive=0";
		}
		$SQL="SELECT p.* FROM #__project as p LEFT JOIN #__project_relation as pr ON p.id=pr.project_id".$where." GROUP BY p.id ORDER BY p.id DESC LIMIT 0,5";
		$db->setQuery($SQL);
		$projects = $db->loadObjectList();
		return $projects;	
	}
	function getInvoice()
	{
		global $db,$my;
		if(strtolower($my->usertype) == "telecaller" || strtolower($my->usertype) == 'admin')
		{
			$where="WHERE net_amount > 0";
		}
		else
		{
			$where="WHERE user_id = ".$db->quote($my->uid)." AND net_amount > 0";
		}
		$sql = "SELECT id,net_amount,currency FROM #__invoices ".$where." ORDER BY id DESC LIMIT 5";
		$db->setQuery($sql);
		$InvoiceList = $db->loadObjectList();
		$totalDue=0;
		$totalDueINR = 0; 
		$totalDueDoller = 0;
		foreach($InvoiceList as $invoice)
		{
			if($invoice->currency == "INR")
				$totalDueINR = $totalDueINR + $invoice->net_amount;
			else
				$totalDueDoller = $totalDueDoller + $invoice->net_amount;
			$totalDue= $totalDue + $invoice->net_amount;
		}
		$invoice = array("totalDue"=>$totalDue,"totalINR"=>$totalDueINR,"totallDoller"=>$totalDueDoller);
		return $invoice;
	}
	function Category()
	{
		global $db;
		$Query = "select id,category_name from #__category Where type='ticket'";
		$db->setQuery($Query);
		$Category = $db->loadObjectList();
		return $Category;
	}  
  }
?>