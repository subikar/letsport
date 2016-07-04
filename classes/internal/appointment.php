<?php
defined ('ITCS') or die ("Go away.");
  class Appointment extends Master {
	 var $user_id = NULL;
	  function __construct()
	  {
			global $my,$mainframe,$Config;
			if(isset($my->uid) && $my->uid >0)
		   $this->user_id=$my->uid;
		   
		   parent::__construct(); 
		}
		function appointment()
		{
			global $db,$template,$my;
			$post=IRequest::get("POST");
			$whereArray=array();
			$whereArray[]="t.status=1";
			$whereArray[]="t.parent_id=0";
			if(isset($post["text_customer"]) && $post["text_customer"] !="" )
			{
				$whereArray[]="LOWER(u.name) LIKE '%".$db->quote(strtolower($post["text_customer"]))."%' ";
			}
			if(isset($post["text_executive"]) && (int)$post["text_executive"] != 0)
			{
				$whereArray[]="t.field_executive=".$db->quote($post["text_executive"]);
			}
			
			$date=(isset($post["text_date"]) && $post["text_date"] !="" ) ? $post["text_date"] : date("Y-m-d");
			$date1=$date." 01:00:00";
			$date2=$date." 23:59:00";
			$whereArray[]="t.visit_date BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2);
			
			$where=" WHERE ".implode(" AND ",$whereArray);
			
			$Query="SELECT u.*, t.id, t.visit_date, t.ticket_content  FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id".$where." ORDER BY id DESC";
			
			$db->setQuery($Query);
			$Appointments = $db->LoadObjectList(); 
			$template->assignRef('Appointments',$Appointments);
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
			//exit;
			$template->assignRef('Mysubscription',$Mysubscription);
			
		}

	
}
?>