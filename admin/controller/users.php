<?php 
  class Users extends Master {
         function __construct()
		   {
		        
			    parent::__construct();
			  
		   }
		  function display()
		   {
		        global $template; 
				$template->includejs('templates/itcslive/js/user.js');
				$this->getusers();
				$template->display('header');
				$template->display('users/users');
				$template->display('footer');
		   }  
		  function  getusers()
			{
			    global $db, $template, $Config;
				$post=IRequest::get("POST");
				if($post["text_title"]!="")
				{
					$where="WHERE LOWER(name) LIKE '%".strtolower($post["text_title"])."%' OR email LIKE '%".strtolower($post["text_title"])."%'";
				}
				else
				{
					$where="WHERE 1";
				}
				
				$start = IRequest::getInt('start',0) * $Config->limit;
				$Limit = ($Config->limit)?$Config->limit:20; 
				
				$Query = "select count(uid) from #__users ".$where;
				$db->setQuery($Query);
				$UserCount = $db->getOne();
                $template->SetPagination($UserCount);
				
				$Query = "select uid, name, email, status, sendmail, usertype,last_login,register_date  from #__users ".$where." order by uid desc";
				$db->setQuery($Query,$start,$Limit);
				$Users = $db->loadObjectList();
				$template->assignRef('users',$Users);
			}
		 function addnew()	
		    {
			    global $template;
				$template->includejs('templates/itcslive/js/user.js');
				$template->display('header');
				$uid=IRequest::getInt("uid");
				if($uid > 0)
				{
					$UserDetailsInArray=$this->getUserDetails($uid);
					$template->assignRef('User',$UserDetailsInArray);
				}
				$template->display('users/addnew');
				$template->display('footer');
			}
		function getUserDetails($uid)
		{
			global $db;
			$SQL="SELECT * FROM #__users WHERE uid=".$db->quote($uid);
			$db->setQuery($SQL);
			$User = $db->loadObjectList();
			return $User[0];
		}
		function saveuser()
		{
		   global $db,$mainframe;
		   $post = IRequest::get('POST');
		   if((int)$post["uid"] > 0)
		   {
			  $updateArray=array();
				foreach($post as $key=>$value):
					if(!in_array($key,array("task","view","uid","Save_user"))):
						$updateArray[]=$key."=".$db->quote($value);
					endif;
				endforeach;
			$updateString="SET ".implode(",",$updateArray);
			$Query="UPDATE #__users ".$updateString." WHERE uid=".$db->quote($post["uid"]);
			$db->setQuery($Query);
		   }
		   else
		   {
			   unset($post['uid']);
			   $post['sendmail'] = 1;
			   $post['register_date'] = date('Y-m-d h:i');
			   $this->post = $post;
			   parent::bind('users');
			   parent::save();
		   }
		   $mainframe->redirect('index.php?view=users');
		}
	   function checkEmail()
	   {
			global $db,$mainframe;
			$post=IRequest::get("POST");
			if($post['user_id'] != '')
				$where = " AND uid NOT IN (".$db->quote($post['user_id']).")";
			else
				$where = "";
			$SQL = "SELECT count(*) from #__users WHERE email LIKE ".$db->quote($post['email']).$where;
			$db->setQuery($SQL);
			$countUser = $db->getOne();
			print_r($countUser); exit;
	    }
		 	
		function RemoveUser()
		{
			global $db;
			$user_id = IRequest::getInt('user_id');
			if((int)$user_id > 0)
			{
				$SQL = "DELETE from #__users WHERE uid=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$SQL = "UPDATE #__users SET refrer_id=0 WHERE refrer_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$sql= "DELETE FROM #__user_telecaller_relation WHERE customer_id=".$db->quote($user_id)." OR telecaller_id=".$db->quote($user_id);
				$db->setQuery($sql);
				
				//delete ticket..
				$SQL = "SELECT id from #__ticket WHERE owner_id=".$db->quote($user_id)." AND parent_id=0";
				$db->setQuery($SQL);
				$ticket_ids= $db->loadObjectList();
				foreach($ticket_ids as $ticket):
					$ticket_id=$ticket->id;
					if((int)$ticket_id > 0)
					{	
						$SQL = "UPDATE #__formdata SET ticket_id=0 WHERE ticket_id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
				
						$SQL = "DELETE from #__ticket WHERE id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
						
						$SQL = "DELETE from #__ticket WHERE parent_id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
					
						$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
						$db->setQuery($SQL1);
					}			
				endforeach;
				
				//Delete company and project.
				$SQL = "SELECT id from #__company WHERE owner_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				$company_ids = $db->loadObjectList();
				foreach($company_ids as $company):
					$company_id=$company->id;
					if((int)$company_id > 0)
					{
						$SQL = "DELETE from #__project WHERE company_id=".$db->quote($company_id);
						$db->setQuery($SQL);
					}
				endforeach;
				$SQL = "DELETE from #__company WHERE owner_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$SQL = "DELETE from #__project_relation WHERE relation_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
			}	
		}
		function RemoveMultiple()
		{
			 global $db, $mainframe;
			$post = IRequest::get('POST');
			$idInArray=array_values($post["to_select"]);
			foreach($idInArray as $user_id):
			if((int)$user_id > 0)
			{
				$SQL = "DELETE from #__users WHERE uid=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$SQL = "UPDATE #__users SET refrer_id=0 WHERE refrer_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$sql= "DELETE FROM #__user_telecaller_relation WHERE customer_id=".$db->quote($user_id)." OR telecaller_id=".$db->quote($user_id);
				$db->setQuery($sql);
				
				//delete ticket..
				$SQL = "SELECT id from #__ticket WHERE owner_id=".$db->quote($user_id)." AND parent_id=0";
				$db->setQuery($SQL);
				$ticket_ids= $db->loadObjectList();
				foreach($ticket_ids as $ticket):
					$ticket_id=$ticket->id;
					if((int)$ticket_id > 0)
					{	
						$SQL = "UPDATE #__formdata SET ticket_id=0 WHERE ticket_id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
				
						$SQL = "DELETE from #__ticket WHERE id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
						
						$SQL = "DELETE from #__ticket WHERE parent_id=".$db->quote($ticket_id);
						$db->setQuery($SQL);
					
						$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
						$db->setQuery($SQL1);
					}			
				endforeach;
				
				
				//Delete company and project.
				$SQL = "SELECT id from #__company WHERE owner_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				$company_ids = $db->loadObjectList();
				foreach($company_ids as $company):
					$company_id=$company->id;
					if((int)$company_id > 0)
					{
						$SQL = "DELETE from #__project WHERE company_id=".$db->quote($company_id);
						$db->setQuery($SQL);
					}
				endforeach;
				$SQL = "DELETE from #__company WHERE owner_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
				$SQL = "DELETE from #__project_relation WHERE relation_id=".$db->quote($user_id);
				$db->setQuery($SQL);
				
			}	
		endforeach;
		$mainframe->redirect('index.php?view=users');
		}	
   }
?>