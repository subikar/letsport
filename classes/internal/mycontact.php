<?php
	error_reporting(0); 
	defined ('ITCS') or die ("Go away.");
	class Mycontact extends Master
	{
		var $user_id = NULL;
		function __construct()
		{
			global $my,$mainframe,$Config;
			if(isset($my->uid) && $my->uid >0)
				$this->user_id=$my->uid;	 
			parent::__construct();
		}
		
		function display()
		{
			
		}
		
		function mycontacts($Limit = 20) 
		{
			global $db,$template,$mainframe,$Config,$my;
			$user_id = $this->user_id;
			$post = IRequest::get('POST');
			$start = IRequest::getInt('start',0);
			$start = $start * 2;
			$whereInArray = array();
			if($post['name'] != '' && strlen($post['name']) > 3)
			{
				$whereInArray[] = "LOWER(u.name) LIKE '%".(strtolower($post['name']))."%'";
			}
			if($post['email'] != '')
			{
				$whereInArray[] = "LOWER(u.email) = ".$db->quote(strtolower($post['email'])); 
			}
			if($post['phone'] != '')
			{
				$whereInArray[] = "u.phone = ".$db->quote(trim($post['phone']));
			}
			if(isset($post['hasrequirement']) && $post['hasrequirement'] == 'on' )
			{
				$whereInArray[] = "u.hasrequirement = 1";
				$whereInArray[] = "u.ticket_id = 0 ";
			}
			
			$whereAnd=array();
			if(count($whereInArray) > 0)
			{	
				$whereAnd[] = join(" AND ",$whereInArray);
			}
			
			if(strtolower($my->usertype) == 'admin' || strtolower($my->usertype) == 'telecaller') //subikar da told me to show all contact for telecaller(8/6/2015 5:21).
			{
				//$whereAnd[]="u.usertype='customer' OR u.refrer_id=".$db->quote($my->uid);
			}
			else
			{
 				$whereAnd[]="u.refrer_id=".$db->quote($my->uid);
			}
			//$whereAnd[]="t.parent_id = 0";
			if(count($whereAnd) > 0 )
			  {
					$where= " WHERE ".implode(" AND ", $whereAnd);
			  }
					$sql = "SELECT u.*, t.id as ticket, t.alert_date as alert FROM `#__users` as u  
					        LEFT JOIN #__ticket as t on u.uid = t.owner_id 
							".$where." ORDER BY u.uid DESC ";
					$db->setQuery($sql,$start,$Limit);
					$contactsDetails = $db->loadObjectList();

					$sql = "SELECT count(DISTINCT u.uid) as total FROM `#__users` as u 
					        LEFT JOIN #__ticket as t on u.uid = t.owner_id  
							".$where." ORDER BY u.uid DESC ";
					//print($sql); exit;
					$db->setQuery($sql);
					$CountOfContactDetails = $db->getOne();
					//print_r($db); exit;
					//print($CountOfContactDetails); exit;
			        $template->SetPaginationFront($CountOfContactDetails); 
					$template->assignRef('countofcontacts',$CountOfContactDetails);
			        $template->assignRef('contactsDetails',$contactsDetails);
		}
		function addcontact()
		{
			global $db,$template,$mainframe,$Config;
			$uid = IRequest::getInt('uid');
			if($uid > 0)
			{
				$sql = "SELECT * from #__users WHERE uid=".$uid;
				$db->setQuery($sql);
				$editDetails = $db->loadObjectList();
			}
			$template->assignRef('editDetails',$editDetails);		
		}
			  //Code and Functions For contact Us.
	   function savecontact()
	   {
			global $db,$mainframe,$Config;
			$post=IRequest::get("POST");
			$post['hasrequirement'] = (isset($post['hasrequirement']) && $post['hasrequirement'] == 'on')?1:0;
			//print_r($post); exit;
			unset($post["view"]);
			unset($post["task"]);

			$uid = $post['user_id'];
			if($uid != '')
			{
				$sql = "UPDATE #__users SET name=".$db->quote($post['name']).",
											Company=".$db->quote($post['Company']).",
											email=".$db->quote(trim($post['email'])).",
											phone=".$db->quote(trim($post['phone'])).",
											landphone=".$db->quote($post['landphone']).",
											skype_id=".$db->quote($post['skype_id']).",
											designation=".$db->quote($post['designation']).",
											country=".$db->quote($post['country']).",
											state=".$db->quote($post['state']).",
											city=".$db->quote($post['city']).",
											postal=".$db->quote($post['postal']).",
											address=".$db->quote($post['address']).",
											hasrequirement=".$post['hasrequirement'].",
											note=".$db->quote($post['note'])."
											WHERE uid=".$uid;
				//print($sql); exit;							
				$db->setQuery($sql);
				//print_r($db); exit;
				echo "<script>window.parent.location.href='".$Config->site.'mycontacts'."'</script>";
				echo "<script> window.parent.SqueezeBox.close() </script>";
			}
			else
			{
				$userWhere=array();
				if($post["email"]!="")
				$userWhere[]="email LIKE ".$db->quote(trim($post["email"]));
				
				if($post["phone"]!="")
				$userWhere[]="phone LIKE '%".trim($post["phone"])."%'";
				
				$where=" WHERE ".implode(" OR ",$userWhere);
				$Query="SELECT count(*) FROM #__users".$where;
				$db->setQuery($Query);
				$countUser = $db->getOne();
				if((int)$countUser==0)
				{
					$post['password'] = 'thankyouitcslive';
					$post['status'] = 1;
					$post['sendmail'] = 1;
					$post['usertype'] = 'customer';
					$post['register_date'] = date('Y-m-d h:i');
					$post['email'] = trim($post['email']);
					$post['phone'] = trim($post['phone']);
					$this->post = $post;
					parent::bind('users');
					parent::save();
					$UserID = $db->insertid();
					
				  	echo "<script>window.parent.location.href='".$Config->site.'mycontacts'."'</script>";
					echo "<script> window.parent.SqueezeBox.close() </script>";
				}
				else
				{
					 $mainframe->redirect($Config->site."addcontact");
				}
			}	   
	   }
	
	
		function getDetails($uid)
		{
			
		}
	}
?>