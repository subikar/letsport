<?php 
error_reporting(0); 
  class Enquiry extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/enquiry.js');
			$this->getFormdata();
			$template->display('header');
			$template->display('enquiry/enquiry');
			$template->display('footer');
	  	 }  
	  	function  getFormdata()
		{
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$Limit = ($Config->limit)?$Config->limit:20;
						
			$Query = "select count(*) from #__formdata "; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__formdata order by id desc";
			$db->setQuery($Query);
			$Tickets = $db->loadObjectList();
			foreach($Tickets as $details){
					$DataInArray=array();
					$DataInArray=json_decode($details->form_data, true);
					$details->form_data =$DataInArray; 
			}			
			$template->assignRef('formdata',$Tickets);
		}
		
		function OpenReply()
		{
			global $template;
			$Enquiry_id = IRequest::getInt('enquiry_id');
			$this->getContent($Enquiry_id);
			$template->assignRef('Enquiry_id',$Enquiry_id);
			$template->display('enquiry/reply');
		}
		
		function getContent($Enquiry_id)
		{
			global $db,$template;
			$SQL = "SELECT form_data from #__formdata WHERE id=".$db->quote($Enquiry_id);
			$db->setQuery($SQL);
			$formdata = $db->getOne();
			$QueryDetails = json_decode($formdata,true);
			
			$SQL = "SELECT category_name from #__category WHERE id =".$db->quote($QueryDetails['category']);
			$db->setQuery($SQL);
			$categoryName = $db->getOne();
			
			$sql= "SELECT * FROM #__users WHERE LOWER(usertype) LIKE 'telecaller' ";
			$db->setQuery($sql);
			$RefUsers = $db->loadObjectList();
					
			$QueryDetails['categoryName'] = $categoryName;
			$QueryDetails['user'] = $RefUsers;
			$template->assignRef('QueryDetails', $QueryDetails);
		}
		
		function savepage()
		{
			global $db, $template, $Config,$mainframe;
            $post = IRequest::get('POST');
			$ticket_id = IRequest::getInt("ticket_id");
		
			$SQL = "SELECT form_data from #__formdata WHERE id=".$ticket_id;
			$db->setQuery($SQL);
			$formdata = $db->getOne();
			$ticketDetails = json_decode($formdata,true);
			 
			$SQL = "SELECT category_name from #__category WHERE id =".$ticketDetails['category'];
			$db->setQuery($SQL);
			$categoryName = $db->getOne();
			$post['parent_id'] = 0;
			$post['category_id'] = (int)$ticketDetails['category'];
			$post['subject'] = $ticketDetails['name']." ".$categoryName;
			$post['ticket_content'] = $ticketDetails['message'];
			$post['contact_type'] = $categoryName;
			$post['status'] = 1;
			$post['created_on'] = date('Y-m-d h:i');
			$this->post = $post;
			parent::bind('ticket');
			parent::save();
			$TicketID=$db->insertid();
			if((int)$TicketID > 0)
			{
				$this->post=array("original"=>"ticket.php?view=ticket&ticket_id=".$TicketID, "seo"=>"ticket/".$TicketID, "type"=>"ticket","type_id"=>$TicketID);
				parent::bind('404');
				parent::save();
				
				$SQL = "UPDATE #__formdata SET ticket_id=".$db->quote($TicketID)." WHERE id=".$db->quote($ticket_id);
				$db->setQuery($SQL);				
				
				$SQL = "SELECT * from #__users WHERE email LIKE ".$db->quote($ticketDetails['email']);				
				$db->setQuery($SQL);
				$userDetails = $db->loadObjectList();

				$mailDetails = array();
				if((int)$userDetails != '')
				{
					$UserPass = $userDetails[0]->password;
					$customer_id=$userDetails[0]->uid;
				}
				else
				{
					$newUser=$this->registerUser($ticketDetails);
					$UserPass=$newUser["password"];
					$customer_id=$newUser["user_id"];
				}
				
				$sql = "UPDATE #__ticket SET owner_id=".$db->quote($customer_id)." WHERE id=".$db->quote($TicketID);
				$db->setQuery($sql);
				
				$post['customer_id'] = $customer_id;
				$post['telecaller_id'] = $post['user_id'];
				$this->post = $post;
				parent::bind('user_telecaller_relation');
				parent::save();
				
				$content = $this->addReply($TicketID);
				$mailDetails['form_data'] = $ticketDetails;
				$mailDetails['ticket_id'] = $TicketID;
				$mailDetails['reply'] =$content;
				$mailDetails['Password'] = $UserPass;
				$this->sendmailToUser($mailDetails);				
			}				
			echo "<script>window.parent.location.href='index.php?view=enquiry'</script>";
			echo "<script> window.parent.SqueezeBox.close() </script>";
		}	
		function registerUser($ticketDetails)
		{
			global $db;
			$post['name'] = $ticketDetails['name'];
			$post['country'] = $ticketDetails['country'];
			$post['email'] = $ticketDetails['email'];
			$post['phone'] = $ticketDetails['phonenunber'];
			$post['password'] = 'itcslive';
			$post['status'] = 1;
			$post['sendmail'] = 1;
			$post['usertype'] = 'customer';
			$post['register_date'] = date('Y-m-d h:i');
			$this->post = $post;
			parent::bind('users');
			parent::save();
			$UserID = $db->insertid();
			$password["password"] = 'itcslive';
			$password["user_id"]=$UserID;
			return $password;
		}
		function sendmailToUser($mailDetails)
		{	
			global $Config;	
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/ActivationMail_ForTicket.inc");
			$message = ob_get_clean();
			
			$message=str_replace('{customer_name}',$mailDetails['form_data']['name'],$message);
			$message=str_replace('{ticket_link}',$Config->site.'ticket/'.$mailDetails['ticket_id'], $message);
			$message=str_replace('{customer_query}',$mailDetails['form_data']['message'],$message);
			$message=str_replace('{ticket_id}',$mailDetails['ticket_id'],$message);
			$message=str_replace('{reply}',$mailDetails['reply'],$message);
			$message=str_replace('{user_name}',$mailDetails['form_data']['email'],$message);
			$message=str_replace('{password}',$mailDetails['Password'],$message);

			$mailer->To=trim($mailDetails['form_data']['email']);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="Ticket Details For Enquiry To iTCSLive";
			$mailer->Message = $message;
			$mailer->send();
		}
		
		function addReply($TicketID)
		{
			global $db, $template, $Config,$mainframe;
			$content = IRequest::getVar('ticket_content');
			$enquiry_id = IRequest::getVar('ticket_id');			
			$SQL = "SELECT form_data from #__formdata WHERE id=".$enquiry_id;
			$db->setQuery($SQL);
			$formdata = $db->getOne();
			$ticketDetails = json_decode($formdata,true);
			
			$SQL = "SELECT category_name from #__category WHERE id =".$ticketDetails['category'];
			$db->setQuery($SQL);
			$categoryName = $db->getOne();
			
			$post['parent_id'] = $TicketID;
			$post['category_id'] = (int)$ticketDetails['category'];
			$post['subject'] = "Re: ".$ticketDetails['name']." ".$categoryName;
			$post['ticket_content'] = $content;
			$post['contact_type'] = $categoryName;
			$post['status'] = 1;
			$post['created_on'] = date('Y-m-d h:i');
			$post['owner_id'] = 1;
			$this->post = $post;
			parent::bind('ticket');
			parent::save();
			$TicketID=$db->insertid();
			return $content;
		}	
		
		function RemoveEnquiry()
		{
			global  $db,$mainframe;
			$enquiry_id = IRequest::getVar('enquiry_id');
			$sql="SELECT ticket_id FROM #__formdata WHERE id=".$db->quote($enquiry_id);
			$db->setQuery($sql);
			$ticket_id = $db->getOne();
			
			$SQL = "DELETE from #__formdata WHERE id=".$db->quote($enquiry_id);
			$db->setQuery($SQL);
			if((int)$ticket_id > 0)
			{
				$SQL = "DELETE from #__ticket WHERE id=".$db->quote($ticket_id);
				$db->setQuery($SQL);
				
				$sql = "DELETE from #__ticket WHERE parent_id=".$db->quote($ticket_id);
				$db->setQuery($sql);
				
				$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
				$db->setQuery($SQL1);
			}
		}
		function RemoveMultiple()
		{
			global  $db,$mainframe;
				$post=IRequest::get("POST");
				$idInArray=array_values($post["to_select"]);
				$ids=implode(",", $idInArray);
			
			foreach($idInArray as $enquiry_id)	:
				$sql="SELECT ticket_id FROM #__formdata WHERE id=".$db->quote($enquiry_id);
				$db->setQuery($sql);
				$ticket_id = $db->getOne();
				
				$SQL = "DELETE from #__formdata WHERE id=".$db->quote($enquiry_id);
				$db->setQuery($SQL);
				if((int)$ticket_id > 0)
				{
					$SQL = "DELETE from #__ticket WHERE id=".$db->quote($ticket_id);
					$db->setQuery($SQL);
					
					$sql = "DELETE from #__ticket WHERE parent_id=".$db->quote($ticket_id);
					$db->setQuery($sql);
					
					$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
					$db->setQuery($SQL1);
				}
			endforeach;
					
			$mainframe->redirect('index.php?view=enquiry');			
		}
   }
?>