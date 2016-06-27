<?php 
error_reporting(0);
  class Login extends Master {
         function __construct()
		   {
			  parent::__construct();
		   }
		 function display()
		   {
		     global $template; 
		     $template->display('login');	
		   }
		 function checklogin()
		   {
		      global $db,$mainframe;  
              $Email = IRequest::getString('email');
			  $password = IRequest::getString('password');   
			  if($Email != '' && $password != '')
			    {
				  $Query = "select uid from #__users WHERE email=".$db->quote($Email)." AND password=".$db->quote($password);
				  $db->setQuery($Query);
				  $uid = $db->getOne();
				  if($uid > 0)
				    {
					   $session_id = md5(session_id()); 
					   $Query = "update #__session SET user_id=".$db->quote($uid)." WHERE session_id =".$db->quote($session_id);
					   $db->setQuery($Query);
					   $Query = "update #__users SET last_login =NOW() WHERE uid =".$db->quote($uid);
					   $db->setQuery($Query);
					   $mainframe->redirect('index.php?view=dashboard');
					}
				}
		   } 
   }
?>