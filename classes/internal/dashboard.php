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
		
	    $this->getMyTruck();
	    $this->getMyDriver();
		$template->assignRef('TrucksAvailable',$this->getTruckLoadAvailable('truck'));
		$template->assignRef('LoadAvailable',$this->getTruckLoadAvailable('load'));
		
/*	   	$Tickets=$this->getTicket();
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
		}*/
	}
	
	function mysubscription()
		{	
			global $db,$template,$my;
			$post=IRequest::get("POST");
			$whereArray=array();
			$where=' WHERE subscription_id IS NOT NULL'; 		
			//$where=" WHERE ".implode(" AND ",$where);
			
			$Query="SELECT s.*, g.data FROM #__gallery as g LEFT JOIN #__subscription_plan as s ON s.image=g.gallery_id ".$where." ORDER BY subscription_id DESC";
			//$Query="SELECT * FROM #__subscription_plan";			
			//echo $Query;exit;
			$db->setQuery($Query);
			$Mysubscription = $db->LoadObjectList(); 
			foreach($Mysubscription as $subscription){
				$subscription->data = unserialize($subscription->data);
				//print_r($subscription);
					
			}
			//print_r($Mysubscription);exit;
			
	
			
			//print_r($post);exit;
			
			$template->assignRef('Mysubscription',$Mysubscription);
			
		}
	
	function subscribe()
	{
			global $db,$template,$my;
			$id=IRequest::getVar("id");
			$bids=IRequest::getVar("bids");
			
			$post[subscription_id]=$id;
			$post[owner]=$my->uid;
			$post[status]=0;
			$post[lead]=$bids;
			$post[lead_count]=$bids;
			$this->post=$post;
			//print_r($this->post);exit;
			parent::bind('subscriber');
			parent::save();
			$Query="SELECT * FROM #__subscription_plan WHERE subscription_id=".$db->quote($id);			
			//echo $Query;exit;
			$db->setQuery($Query);
			$package_name = $db->LoadObjectList();
			//print_r($package_name);exit;
			$template->assignRef('PackageName',$package_name);
		
	}
	
	
	function getTruckLoadAvailable($type)
	 {
		global $db,$my,$template;
		$Query="SELECT * FROM #__ourworks WHERE owner_id=".$db->quote($my->uid)." AND operation_type=".$db->quote($type)." ORDER BY avaliable_date DESC LIMIT 0,5";
		$db->setQuery($Query);
		$Listings = $db->LoadObjectList();
		//print_r($db); exit; 
		return $Listings;
	 } 
	function getMyTruck()
	{
		global $db,$my,$template;
		$Query="SELECT * FROM #__truck WHERE truck_owner_id=".$db->quote($my->uid)." ORDER BY truck_id DESC LIMIT 0,5";
		$db->setQuery($Query);
		$Trucks = $db->LoadObjectList(); 
	//	print_r($Trucks); exit;
		$template->assignRef('Trucks',$Trucks);
	}
	function addtruck()
	 {
		global $db,$my,$template;
		$TruckID = IRequest::getInt('id',0);
		if($TruckID > 0)
		  {
			$Query="SELECT * FROM #__truck WHERE truck_owner_id=".$db->quote($my->uid)." AND truck_id=".$db->quote($TruckID)." ORDER BY truck_id DESC LIMIT 0,5";
			$db->setQuery($Query);
			$Trucks = $db->LoadObjectList();
			$template->assignRef('truckdetails',$Trucks[0]);
		  }
		$template->VehcleType();  

	   
	 }
	function savetruck()
	 {
	    global $mainframe,$Config,$db;
	    $post = IRequest::get('POST');
		$TruckID = IRequest::getInt('truck_id',0);
		if($TruckID <= 0)
		  {
				unset($post["view"]);
				unset($post["task"]);
				$this->post = $post;
				parent::bind('truck');
				parent::save();
		   }
		 else
		   {
		     $Where = array();
			 $Where[] = 'truck_id = '.$db->quote($TruckID);
			 $this->where = implode(' AND ', $Where);
			 unset($post["view"]);
			 unset($post["task"]);
			 unset($post["truck_id"]);
			 $this->post = $post;
			 parent::bind('truck'); 
			 parent::update();
		   }  
		$mainframe->miniredirect($Config->site."dashboard");

	   //print_r($post); exit;
	 }  
	 
	function getMyDriver()
	{
		global $db,$my,$template;
		$Query="SELECT * FROM #__driver WHERE driver_id=".$db->quote($my->uid)." ORDER BY driver_id DESC LIMIT 0,5";
		$db->setQuery($Query);
		$Drivers = $db->LoadObjectList(); 
		$template->assignRef('Drivers',$Drivers);
	}
	function adddriver()
	 {
	  
		global $db,$my,$template;
		$DriverID = IRequest::getInt('id',0);
		if($DriverID > 0)
		  {
			$Query="SELECT * FROM #__driver WHERE driver_owner=".$db->quote($my->uid)." AND driver_id=".$db->quote($DriverID)."  ORDER BY driver_id DESC LIMIT 0,5";
			$db->setQuery($Query);
			$Driver = $db->LoadObjectList(); 
		//	print_r($db); exit;
			$template->assignRef('driverdetails',$Driver[0]);
		  }


	   
	 }
	function savedriver()
	 {
	    global $mainframe,$Config,$db;
	    $post = IRequest::get('POST');
		$driver_id = IRequest::getInt('driver_id',0);
		if($driver_id <= 0)
		  {
		        $post['driver_avatar'] = $this->uploadAvatar();
				unset($post["view"]);
				unset($post["task"]);
				$this->post = $post;
				parent::bind('driver');
				parent::save();
		   }
		 else
		   {
		     $Where = array();
			 $Where[] = 'driver_id = '.$db->quote($driver_id);
			 $this->Where = implode(' AND ', $Where);
			 $post['driver_avatar'] = $this->uploadAvatar();
			 unset($post["view"]);
			 unset($post["task"]);
			 unset($post["driver_id"]);
			 $this->post = $post;
			 parent::bind('driver'); 
			 parent::update();
		   }  
		$mainframe->miniredirect($Config->site."dashboard");
	 }
       function uploadAvatar()
		{
		       
				 global $db, $template, $Config,$mainframe;
				 $files = IRequest::get('FILES');
				 $img_path = IPATH_ROOT.'/images/driver_avatar/';
				 $AcceptedFilesInArray = array('jpg','png','jpeg','gif');
				 $ext = pathinfo($files['driver_avatar']['name'], PATHINFO_EXTENSION);
				
				 if(in_array($ext,$AcceptedFilesInArray) && $files['driver_avatar']['size'] < 100000)
				   {
 				     $name = md5(time()).'.'.$ext;     
				     $res =move_uploaded_file($files['driver_avatar']['tmp_name'], $img_path.$name);
					// print($img_path.$name);
					 //print_r($res); exit;
					if($res == 1)
						$avatar = $name;
					 
					 
				   }
				 else
				   {
						$template->assignRef('Title','Add Driver');
						$template->display('tmplpopup/header');
						$Model = includeclass('dashboard');
						$template->display('ticket/adddriver');
						$template->display('tmplpopup/footer');
					    exit;
				   }  
				  return $avatar;
			
		}	   	 
	
	//No Function after this is usable 	
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
	
	function bid()
	 {
	 	$this->VehicleNumber();
		$this->SelectDriver();
	 
	 }
	 
	 function bid1()
	 {
	 	$this->MaterialType();
		
	 }
	 
	 
function MaterialType()
	 {	//echo("hi");exit;
	 	global $db,$my,$template; 
		$Query="SELECT * FROM #__ourworks";
		$db->setQuery($Query);
		$MaterialType = $db->LoadObjectList();
		//print_r($VehicleDriver);exit;
		$vno = array();
		foreach($MaterialType as $Mtrl)
		  {
		    $vno[$Mtrl->material_type] = $Mtrl->material_type; 
		  }
		$template->assignRef('MaterialType',$vno); 
		//print_r($vno);exit;
	 	
	 } 
	 	 
function VehicleNumber()
	 {	//echo("hi");exit;
	 	global $db,$my,$template; 
		$Query="SELECT * FROM #__truck";
		$db->setQuery($Query);
		$VehicleNumber = $db->LoadObjectList();
		//print_r($VehicleNumber);exit;
		$vno = array();
		foreach($VehicleNumber as $Vehcle)
		  {
		    $vno[$Vehcle->truck_no] = $Vehcle->truck_no; 
		  }
		$template->assignRef('VehicleNumber',$vno); 
		//print_r($vno);exit;
	 	
	 }   

function SelectDriver()
	 {	//echo("hi");exit;
	 	global $db,$my,$template; 
		$Query="SELECT * FROM #__driver";
		$db->setQuery($Query);
		$VehicleDriver = $db->LoadObjectList();
		//print_r($VehicleDriver);exit;
		$vno = array();
		foreach($VehicleDriver as $Vehcle)
		  {
		    $vno[$Vehcle->name] = $Vehcle->name; 
		  }
		$template->assignRef('DriverName',$vno); 
		//print_r($vno);exit;
	 	
	 } 	
	 
function bidstruck()
	 {	

	 	global $db,$my,$template; 
		$ID = IRequest::getVar(id);
		//echo $ID;exit; 
		
		$where=' WHERE u.uid IS NOT NULL';
		$Query="SELECT b. *, u. * , o . *  FROM #__bids AS b LEFT JOIN #__users AS u ON b.work_id = u.uid LEFT JOIN #__ourworks AS o ON o.id = u.uid".$where;
		//$Query="SELECT * FROM #__bids WHERE bid_owner_id=".$ID;
		//echo $Query;exit; 
		$db->setQuery($Query);
		$truckbid = $db->LoadObjectList();
		//print_r($truckbid);exit;
		foreach($truckbid as $bids)
			{
				$bids->bid_text=json_decode($bids->bid_text);
				//print_r($bids);//exit;
				//print("<br/>");exit;
				
			}
	
		
		$template->assignRef('TruckBids',$truckbid);
		$this->dashboard();
	 }
	 
function bidsload()
	 {	
	 	global $db,$my,$template; 
		$ID = IRequest::getVar(id);
		//echo $ID;exit; 
		
		$where=' WHERE u.uid IS NOT NULL';
		$Query="SELECT b. *, u. * , o . *  FROM #__bids AS b LEFT JOIN #__users AS u ON b.work_id = u.uid LEFT JOIN #__ourworks AS o ON o.id = u.uid".$where;
		//$Query="SELECT * FROM #__bids WHERE bid_owner_id=".$ID;
		//echo $Query;exit; 
		$db->setQuery($Query);
		$loadbid = $db->LoadObjectList();
		
		foreach($loadbid as $bids)
			{
				$bids->bid_text=json_decode($bids->bid_text);
				//print_r($bids);//exit;
				//print("<br/>");exit;
				
			}
	
		//print_r($loadbid);exit;
		$template->assignRef('Loadbid',$loadbid);
		$this->dashboard();
		
	 } 	

  }
?>