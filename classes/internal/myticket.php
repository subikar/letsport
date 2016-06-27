<?php
defined ('ITCS') or die ("Go away.");
  class Myticket extends Master {
	 var $user_id = NULL;
	 function __construct()
	  {
			global $my,$mainframe,$Config;
			if(isset($my->uid) && $my->uid >0)
		   $this->user_id=$my->uid;
		   
		   parent::__construct(); 
		}
		function getCustomersFromAjax()
		{
			global $db,$my;		
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];			
			if($userHint != '')
			{
				if(strtolower($my->usertype) == 'admin')
				{
					$Sql="SELECT customer_id FROM #__user_telecaller_relation";
				}
				else
				{
					$Sql="SELECT customer_id FROM #__user_telecaller_relation WHERE telecaller_id=".$db->quote($my->uid);
				}
				$db->setQuery($Sql);
				$customer_ids = $db->LoadObjectList(); 
				foreach($customer_ids as $customer)
				{
					$customerInArray[]=$customer->customer_id;
				}
			
			  $sql="select name FROM #__users WHERE name LIKE '%".$userHint."%' AND uid IN(".implode(",",$customerInArray).")";
			  $db->setQuery($sql);
			  $RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		function mytickets()
		{
		    global $db,$template,$my;
			
			$customerInArray=array();
/*			if(strtolower($my->usertype) == "telecaller")
			{
				$Sql="SELECT customer_id FROM #__user_telecaller_relation WHERE telecaller_id=".$db->quote($my->uid);
				$db->setQuery($Sql);
				$customer_ids = $db->LoadObjectList(); 
				foreach($customer_ids as $customer)
				{
					$customerInArray[]=$customer->customer_id;
				}
			}
			else*/ 
			if(strtolower($my->usertype) == "admin" || strtolower($my->usertype) == "telecaller")
			{
				$Sql="SELECT customer_id FROM #__user_telecaller_relation ";
				$db->setQuery($Sql);
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
				$whereArray=array();	
				$customers=implode(",",$customerInArray);
				$whereArray[]="t.owner_id IN(".$customers.")";
				$whereArray[]="t.status=1";
				$whereArray[]="t.parent_id=0";
				$post=IRequest::get("POST");
				if(isset($post["text_content"]) && $post["text_content"] !="")
					$whereArray[]="(LOWER(t.subject) LIKE '%".strtolower(trim($post["text_content"]))."%' OR LOWER(t.ticket_content) LIKE '%".strtolower(trim($post["text_content"]))."%')";
				if(isset($post["text_user"]) && $post["text_user"] != "")
				{
					$sql = "SELECT u.uid from #__users as u RIGHT JOIN #__user_telecaller_relation as utr ON utr.customer_id=u.uid WHERE u.name=".$db->quote($post["text_user"]);
					$db->setQuery($sql);
					$owner_id = $db->getOne();
					$whereArray[]="t.owner_id =".$owner_id;
				}
				if(isset($post["text_date"]) && $post["text_date"]!="" )
				{
					$start=$post["text_date"]." 00:00:00";
					$end=$post["text_date"]." 12:00:00";
					$whereArray[]="( t.created_on BETWEEN ".$db->quote($start)." AND ".$db->quote($end)." OR t.alert_date LIKE ".$db->quote($post["text_date"]).")";
				}

				if(isset($post["text_email"]) && $post["text_email"]!="" )
				{
					$whereArray[]="u.email =".$db->quote($post["text_email"]);
				}				
				if(isset($post["text_mobile"]) && $post["text_mobile"]!="" )
				{
					$whereArray[]="u.phone =".$db->quote($post["text_mobile"]);
				}				
				
				$where=" WHERE ".implode(" AND ",$whereArray);
				$Query="SELECT count(t.id) as countoftickets FROM #__ticket as t LEFT JOIN #__users as u ON t.owner_id=u.uid".$where." ORDER BY t.id DESC";
				//print_r($post); exit;
				$db->setQuery($Query);
				$this->countoftickets = $db->getOne(); 
				
				$Query="SELECT t.*, u.name,u.Company FROM #__ticket as t LEFT JOIN #__users as u ON t.owner_id=u.uid".$where." ORDER BY t.id DESC";
				$db->setQuery($Query,0,10);
				$Tickets = $db->LoadObjectList(); 
				
				$this->getAlert($customerInArray);	
			}
			else
			{
				$Tickets=array();
			}
			$template->assignRef('countoftickets',$this->countoftickets);
			$template->assignRef('Tickets',$Tickets);
		}
		function getAlert($customerInArray)
		{
			global $db,$template,$my;
			$whereArray=array();
			$customers=implode(",",$customerInArray);
			$whereArray[]="t.owner_id IN(".$customers.")";
			$whereArray[]="t.status=1";
			$whereArray[]="t.parent_id=0";
			
			$date=IRequest::getVar("text_date","");
			$date=($date !="") ? $date : date("Y-m-d");
			$date1=$date." 01:00:00";
			$date2=$date." 23:59:00";
			$whereArray[]="(t.alert_date LIKE ".$db->quote($date)." OR t.visit_date BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
			
			$where=" WHERE ".implode(" AND ",$whereArray);
			$Query="SELECT u.name, u.Company, t.id, t.alert_date, t.visit_date, t.ticket_content  FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id".$where." ORDER BY id DESC";
			
			//print_r($Query); exit;
			$db->setQuery($Query);
			$alerts = $db->LoadObjectList(); 
			foreach($alerts as $value)
			{
				$showDate=($value->alert_date==$date)? $value->alert_date: $value->visit_date;	
				$value->show_date='';
				$value->show_date=$showDate;	
			}
			$template->assignRef('Alerts',$alerts);
		}
	   function addticket() 
	   {
	  // print("subikar"); exit;
		global $template;
		$Category=$this->Category();
		$template->assignRef('Category',$Category);	
	   }
	    function Category()
	   {
		 global $db;
		 $Query = "select id,category_name from #__category Where type='ticket'";
		 $db->setQuery($Query);
		 $Category = $db->loadObjectList();
		 return $Category;
	   }
	   function getContactsForAddTicket_fromAjax()
		{
			global $db,$my;
			$post=IRequest::get("POST");
			$whereArray=array(); $Contacts=array();
			$userHint=$post["filter"]["filters"][0]["value"];
			if($userHint!=""):
				$whereArray[]="LOWER(name) LIKE '%".strtolower($userHint)."%'";
			
/*				if($my->usertype=="telecaller"): 
					$whereArray[]="refrer_id=".$db->quote($my->uid);
				endif;
*/					
                $whereArray[]="status=1";
				$where=" WHERE ".implode(" AND ", $whereArray);
				
				$Query="SELECT uid as value, CONCAT_WS('-',name,email,phone) as text FROM #__users ".$where." ORDER BY uid DESC";
				/*$this->post = array("datas"=>$Query);
				parent::bind('atha');
				parent::save();
				exit;*/
				$db->setQuery($Query);
				$Contacts = $db->LoadObjectList(); 
			endif;	
			return print_r(json_encode($Contacts)); exit;
		} 
		function getTelecallerForAddTicket_fromAjax()
		{
			global $db,$my;
			$post=IRequest::get("POST");
			$whereArray=array(); $Telecaller=array();
			$userHint=$post["filter"]["filters"][0]["value"];
			if($userHint!=""):
				$whereArray[]="LOWER(name) LIKE '%".strtolower($userHint)."%'";
				$whereArray[]="status=1";
				$whereArray[]="usertype='telecaller'";
				$where=" WHERE ".implode(" AND ", $whereArray);
				$Query="SELECT uid as value, name as text FROM #__users ".$where." ORDER BY uid DESC";
				$db->setQuery($Query);
				$Telecaller = $db->LoadObjectList(); 
			endif;
			return print_r(json_encode($Telecaller)); exit;
		} 	
		 function saveticket()
		  {
		  	global $db,$mainframe,$Config,$my;
			$addArray=array();
			$post=IRequest::get("POST");
			//print_r($post); exit;
			$post["message"] =IRequest::getVar('message','','POST','STRING',IREQUEST_ALLOWHTML);
			$SQL = "SELECT category_name from #__category WHERE id =".$post['category'];
			$db->setQuery($SQL);
			$categoryName = $db->getOne();
			
			$addArray['parent_id'] = 0;
			$addArray['category_id'] = (int)$post['category'];
			$addArray['subject'] = $post['name']." ".$categoryName;
			$addArray['ticket_content'] = $post['message'];
			$addArray['contact_type'] = $categoryName;
			$addArray['status'] = 1;
			$addArray['created_on'] = date('Y-m-d H:i:s');
			$addArray['alert_date'] = date('Y-m-d');
			$addArray['owner_id']=(int)$post['contact'];
			$this->post = $addArray;
			parent::bind('ticket');
			parent::save();
			$TicketID=$db->insertid();
			if((int)$TicketID > 0)
			{
				$this->post=array("original"=>"ticket.php?view=ticket&ticket_id=".$TicketID, "seo"=>"ticket/".$TicketID, "type"=>"ticket","type_id"=>$TicketID);
				parent::bind('404');
				parent::save();
				
				$this->post =array("customer_id"=>$addArray['owner_id'],"telecaller_id"=>(int)$post["caller_id"]);
				parent::bind('user_telecaller_relation');
				parent::save();
				
				$updatesql = "update #__users set ticket_id = ".$TicketID." WHERE uid= ".$db->quote($addArray['owner_id']);	
				$db->setQuery($updatesql);
				
				$SQL = "SELECT name, email, password from #__users WHERE uid= ".$db->quote($addArray['owner_id']);				
				$db->setQuery($SQL);
				$userDetails = $db->loadObjectList();
				$addArray['user_email']=$userDetails[0]->email;
				$addArray['user_password']=$userDetails[0]->password;
				$addArray['ticket_id']=$TicketID;
				$this->sendmailToUser($addArray);
			}
			//$mainframe->redirect($Config->site."mytickets");
			echo "<script>window.parent.location.href='".$Config->site.'mytickets'."'</script>";
			echo "<script>window.parent.SqueezeBox.close() </script>";
		  }
		  
		  function sendmailToUser($mailDetails)
		 {	
			global $Config,$my;	
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/TeleExecutiveTicketAddingEmail.inc");
			$message = ob_get_clean();
			
			$message=str_replace('{teleexecutive_name}',$my->name,$message);
			$message=str_replace('{ticket_link}',$Config->site.'ticket/'.$mailDetails['ticket_id'], $message);
			$message=str_replace('{customer_query}',$mailDetails['ticket_content'],$message);
			$message=str_replace('{user_name}',$mailDetails['user_email'],$message);
			$message=str_replace('{password}',$mailDetails['user_password'],$message);

			$mailer->To=trim($mailDetails['user_email']);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="Ticket Added For You in iTCSLive";
			$mailer->Message = $message;
			$mailer->send();
		}
		
		function modifyticket()
		{
			global $template;
			$ticket_id=IRequest::getInt("ticket_id");
			$TicketDetails=$this->getTicket($ticket_id);
			$template->assignRef('TicketDetails',$TicketDetails);	
		}
		
		function getTicket($ticket_id)
		{
		    global $db,$Config;  
			$Tickets=array();
			$Query="SELECT t.* ,u.name as owner_name, u.Company, u.address FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id WHERE t.id=".$db->quote($ticket_id)." AND t.track=0 AND t.status=1";
			$db->setQuery($Query);
			$ParentTickets = $db->LoadObjectList();
			$Tickets["main"]=$ParentTickets[0];
	
			$Query="SELECT t.* ,u.name as owner_name FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id WHERE t.parent_id=".$db->quote($ticket_id)." AND t.status=1 ORDER BY t.id DESC";
			$db->setQuery($Query);
			$threadTickets = $db->LoadObjectList();	
			if(count($threadTickets) > 0):		
				$Tickets["thread"]=$threadTickets;
				$Tickets["Request_no"]=$threadTickets[count($threadTickets)-1]->id +1;
			else:
				$Tickets["thread"]=array();
				$Tickets["Request_no"]=$ParentTickets[0]->id +1;
			endif;
			
			return $Tickets;
		}
		function saveComment()
		{
			global $db,$Config;  
			$InsertArray=array();
			$updateArray=array();
			$post=IRequest::get("POST");
			if((int)$post["ticket_id"] > 0)
			{
				$Query="SELECT * FROM #__ticket WHERE id=".$db->quote($post["ticket_id"]);
				$db->setQuery($Query);
				$mainTickets = $db->LoadObjectList();		
				if((int)$mainTickets[0]->owner_id == (int)$post["user_id"])
				{
					$InsertArray["subject"]=$mainTickets[0]->subject;
				}	
				else
				{
					$InsertArray["subject"] = "Re: ".$mainTickets[0]->subject; 
					$InsertArray["track"] = 1;
				}
				
				$InsertArray["parent_id"]	= $post["ticket_id"];
				$InsertArray["category_id"]	= $mainTickets[0]->category_id;
				$InsertArray["ticket_content"]	= $post["comment"];
				$InsertArray['contact_type'] = $mainTickets[0]->contact_type;
				if(isset($post["alert_date"]) && $post["alert_date"] !="")
				{
					$InsertArray['alert_date'] = $post["alert_date"];
					$updateArray[]='alert_date='.$db->quote($post["alert_date"]);
				}
				if(isset($post["visit_datetime"]) && $post["visit_datetime"]!="")
				{
					$InsertArray['visit_date'] = $post["visit_datetime"];
					$InsertArray['field_executive']=$post['field_executive'];
					$updateArray[] ='visit_date='.$db->quote($post["visit_datetime"]);
					$updateArray[]='field_executive='.$db->quote($post['field_executive']);
				}
				$InsertArray['status'] = 1;
				$InsertArray['created_on'] = date('Y-m-d H:i:s');
				$InsertArray['owner_id']=$post["user_id"];
				$this->post = $InsertArray;
				parent::bind('ticket');
				parent::save();
				$TicketID=$db->insertid();
				
				if((int)$TicketID > 0 && count($updateArray) > 0)
				{
					$setValue="SET ".implode(",",$updateArray);
					$Query="UPDATE #__ticket ".$setValue." WHERE id=".$db->quote($post["ticket_id"]);
					$db->setQuery($Query);
				}
			}
					
			echo "<script>window.parent.location.href='".$Config->site.'mytickets'."'</script>";
			echo "<script>parent.jQuery.colorbox.close();</script>";
		}
		function closeTicket()
		{
			global $db,$my;	
			$post=IRequest::get("POST");
			if((int)$post["ticket_id"] > 0)
			{
				$Query="UPDATE #__ticket SET activity_status=0 WHERE id=".$db->quote($post["ticket_id"]);
				$db->setQuery($Query);
			}	
		
		}
		function getUserName($user_id)
		{
			global $db;
			$Query="SELECT name FROM #__users WHERE uid=".$db->quote($user_id);
			$db->setQuery($Query);
			$name = $db->getOne();
			return $name;
		}
		function getFieldExecutive_fromAjax()
		{
			global $db,$my;		
			$RefUsers=array();
			$post=IRequest::get("POST");
			$userHint=$post["filter"]["filters"][0]["value"];			
			if($userHint != '')
			{
			  $sql="select uid as value, name as text FROM #__users WHERE name LIKE '%".$userHint."%' AND usertype='fieldexecutive'";
			  $db->setQuery($sql);
			  $RefUsers = $db->LoadObjectList();
			}
			print_r(json_encode($RefUsers)); exit;
		}
		
}
?>