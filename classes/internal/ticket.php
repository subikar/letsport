<?php
error_reporting(0); 
defined ('ITCS') or die ("Go away.");
  class Ticket extends Master{
	 var $ticket_id = NULL;
	 function __construct()
		{
			global $my,$mainframe,$Config;
			$ticket_id=IRequest::getVar("ticket_id","");
	   		$this->ticket_id=$ticket_id;
		    parent::__construct();
		}
		function display()
		{
		
		}
		function getTicket()
		{
		    global $db,$mainframe,$Config,$my;  
			$Tickets=array();
			$ticket_id = IRequest::getVar('ticket_id');
			$Query="SELECT t.* ,u.name as owner_name FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id WHERE t.id=".$db->quote($ticket_id)." AND t.status=1";
			$db->setQuery($Query);
			
			$ParentTickets = $db->LoadObjectList();
			$Tickets["main"]=$ParentTickets[0];
			
			$whereArray=array();
			$whereArray[]="t.status=1";
			$whereArray[]="t.parent_id=".$db->quote($ticket_id);
			if(isset($my->uid) && $my->usertype !="telecaller"):
				$whereArray[]="t.track=0";
			endif;			
			$where=" WHERE ".implode(" AND ", $whereArray);			
			$Query="SELECT t.* ,u.name as owner_name FROM #__ticket as t LEFT JOIN #__users as u ON u.uid=t.owner_id".$where." ORDER BY t.id ASC";
			$db->setQuery($Query);
			$threadTickets = $db->LoadObjectList();	
			$sql = "SELECT * from #__ticket ORDER BY id DESC";
			$db->setQuery($sql);
			$request_no = $db->getOne();
			if(count($threadTickets) > 0):		
				$Tickets["thread"]=$threadTickets;
				$Tickets["Request_no"]=$request_no +1;
			else:
				$Tickets["thread"]=array();
				$Tickets["Request_no"]=$ParentTickets[0]->id +1;
			endif;
			if($Tickets['main']->attachment !='')
			{
				$sql="select * from #__attachfile where `ticket_id`='".$Tickets['main']->id."' and id in (".$Tickets['main']->attachment.")";
				$db->setQuery($sql);
				$Result=$db->loadObjectList();
				if($Result):
				$ResultInArray=$this->object_to_array($Result);
				$Tickets['files']=$ResultInArray;
				endif;
			}
			return $Tickets;
		}
		function object_to_array($data)
		{
			if (is_array($data) || is_object($data))
			{
				$result = array();
				foreach ($data as $key => $value)
				{
					$result[$key] = $this->object_to_array($value);
				}
				return $result;
			}
			return $data;
		}
		function GetAttachmentContent()
		{		
			global $Config,$db;	
			include_once(IPATH_ROOT.DS."classes/external/priyaTools/resizer.php");
			$Imageparams = array('width' =>60, 'height' =>60);	
			$post=IRequest::get("POST");
			$AttachmentArray = array();
			if($post['attachment'] != ''):
				$Attachment = $post['attachment'];	
				foreach($Attachment as $value):
					$attachment = base64_decode($value);
					$key = md5($value);
					$this->post = array('filename'=>$attachment,'token'=>$key);
					parent::bind('attachment');
					parent::save();
					$extension = pathinfo($attachment, PATHINFO_EXTENSION);
					
					if(strtolower($extension) == 'gif' || strtolower($extension) == 'png' || strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg' )
					{
						$thumb = Resizer::img_resize($attachment,$Imageparams);
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.$thumb."\" height=\"50%\" weight=\"50%\"></a>";
					}
					if(strtolower($extension) == 'pdf')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/pdf.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'txt')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/txt.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'doc' || strtolower($extension) == 'docx' || strtolower($extension) == 'xlsx' || strtolower($extension) == 'xls'  || strtolower($extension) == 'xml' || strtolower($extension) == 'xps')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/docx.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'zip' || strtolower($extension) == 'rat' || strtolower($extension) == 'rar' )
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/zip.png'."\" height=\"100%\" weight=\"100%\"></a>";
					if(strtolower($extension) == 'psd')
						$AttachmentArray[] = "<a href=\"".$Config->site.'download?token='.$key."\" target=\"_blank\"><img src=\"".$Config->site.'images/psd.png'."\" height=\"100%\" weight=\"100%\"></a>";
				endforeach;
				endif;
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
		function addcomment()
		{
			global $db,$mainframe,$Config,$my;  
			$InsertArray=array();
			$feedBack=array();
			$post=IRequest::get("POST");

			
			
			$post["comment"]=IRequest::getVar('comment','','POST','STRING',IREQUEST_ALLOWHTML);
			if((int)$post["ticket_id"] > 0)
			{
			    $Attachment = $this->GetAttachmentContent(); 
				$totalAttachment = implode(",",$Attachment);
				
				$Query="SELECT * FROM #__ticket WHERE id=".$db->quote($post["ticket_id"]);
				$db->setQuery($Query);
				$mainTickets = $db->LoadObjectList();		
				if((int)$mainTickets[0]->owner_id == (int)$post["user_id"])
				{
					$InsertArray["subject"]=$mainTickets[0]->subject;
				}	
				else
				{
					$InsertArray["subject"]="Re: ".$mainTickets[0]->subject; 
				}
				
				$InsertArray["parent_id"]	= $post["ticket_id"];
				$InsertArray["category_id"]	= $mainTickets[0]->category_id;
				$InsertArray["ticket_content"]	= $post["comment"].'<br>'.$totalAttachment;
				$InsertArray['contact_type'] = $mainTickets[0]->contact_type;
				$InsertArray['status'] = 1;
				$InsertArray['created_on'] = date('Y-m-d h:i');
				$InsertArray['owner_id']=$post["user_id"];
				$InsertArray['track']=$post["no-email-customer"];
				
				$this->post = $InsertArray;
				parent::bind('ticket');
				parent::save();
				$TicketID=$db->insertid();
				if((int)$TicketID > 0)
				{
					$date=date("Y-m-d");
					$Query="UPDATE #__ticket SET alert_date=".$db->quote($date)." WHERE id=".$db->quote($post["ticket_id"]);
					$db->setQuery($Query);
					
					$feedBack["status"]=1;
					$feedBack["req_no"]=$TicketID+1;
					$feedBack["message"]="Your Query Send Successfully!";
					$html="<div class='defaultBoxLine'>From : ".$my->name."<br>".$post["comment"]."<br>".$totalAttachment."<br><span class='right small'>Created On: ". date("j F Y h:i A")."</span></div><div class='line'></div>";
					$feedBack["addhtml"]=$html;	
					
					if((int)$mainTickets[0]->owner_id != (int)$post["user_id"] && $post['no-email-customer'] == 1)
					{
					  // print("subika"); exit;
						$userDetails=$this->getUserName($mainTickets[0]->owner_id);
						$mailArray=array();
						$mailArray["customer_name"]=$userDetails->name;
						$mailArray["executive_name"]=$my->name;
						$mailArray["customer_query"]= $mainTickets[0]->ticket_content;
						$mailArray["reply"]=$post["comment"];
						$mailArray["ticket_link"]=$Config->site."ticket/".$post["ticket_id"];
						$mailArray["reply_email"]=$userDetails->email;
						$this->sendMailToUser($mailArray);
					}
				}
				else
				{
					$feedBack["status"]=0;
					$feedBack["message"]="Sorry, Query Not Send!";
				}
			}
			else
			{
				$feedBack["status"]=0;
				$feedBack["message"]="Sorry, Invalid Ticket!";
			}
			print_r(json_encode($feedBack)); exit;
		}
		function sendMailToUser($mailarray)
		{
			//print_r($mailarray); exit;	
			$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/ReplyMail_ForTicket.inc");
			$message = ob_get_clean();
			 foreach($mailarray as $key=>$value)
			 {
				$message=str_replace('{'.$key.'}',$value,$message); 
			 } 
			
			//$mailer->To="subikar.web@gmail.com";
			$mailer->To=$mailarray["reply_email"];
			$mailer->From="info@itcslive.com";
			$mailer->Subject="New Reply from iTCSLive Enquiry Details";
			$mailer->Message = $message;
			$mailer->send();
		
		}
		function getUserName($user_id)
		{
			global $db;
			$Query="SELECT name,usertype,email FROM #__users WHERE uid=".$db->quote($user_id);
			$db->setQuery($Query);
			$UserDetails = $db->LoadObjectList();		
			return $UserDetails[0];
		}
  }
?>