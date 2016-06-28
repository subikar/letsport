<?php
	defined ('ITCS') or die ("Go away.");
  	class Login extends Master 
  	{
		var $test = NULL;
		function __construct()
		{
			parent::__construct();
		}
		function checklogin()
		{
			global $db,$mainframe,$Config;  
			$Email = IRequest::getString('email');
			$password = IRequest::getString('password'); 
			if($Email == '')
			{
				echo "<script type='text/javascript'>window.location.href='".$Config->site."login?error=01'</script>";
			}
			else if($password == '')
			{
				echo "<script type='text/javascript'>window.location.href='".$Config->site."login?error=02'</script>";
			}  
			else if($Email != '' && $password != '')
			{
				if(is_numeric($Email))
				{
					$where = "phone=".$db->quote($Email);
				}
				else if(filter_var($Email, FILTER_VALIDATE_EMAIL))
				{
					$where = "email=".$db->quote($Email);
				}
				$Query = "select uid from #__users WHERE ".$where." AND password=".$db->quote($password);
				$db->setQuery($Query);
				$uid = $db->getOne();
				if($uid > 0)
				{
					$session_id = md5(session_id()); 
					$Query = "update #__session SET user_id=".$db->quote($uid)." WHERE session_id =".$db->quote($session_id);
					$db->setQuery($Query);
					$Query = "update #__users SET last_login =NOW() WHERE uid =".$db->quote($uid);
					$db->setQuery($Query);
					
					echo "<script>window.parent.location.href='".$Config->site."dashboard'</script>";
					echo "<script> window.parent.SqueezeBox.close() </script>";	
				}
				else
				{
					echo "<script type='text/javascript'>window.location.href='".$Config->site."login?error=11'</script>";
				}
			}
		} 
		function checkLoginDetails()
		{
			global $db;
			$post = IRequest::get('post');
			if(is_numeric($post['email']))
			{
				$where = "phone=".$db->quote($post['email']);
			}
			else if(filter_var($post['email'], FILTER_VALIDATE_EMAIL))
			{
				$where = "email=".$db->quote($post['email']);
			}
			$sql = "SELECT uid FROM #__users WHERE ".$where." AND password=".$db->quote($post['password']);
			$db->setQuery($sql);
			$uid = $db->getOne();
			print_r(json_encode($uid)); exit;
		}
	  function SKey()
	    {
		  $post = IRequest::get('POST');
		  $formname = md5(time().$post['formname']);
		  IRequest::get('POST');
		  IRequest::setVar($post['formname'],$formname,'SESSION');
		  echo $formname;
		  
		}
	  function signup()
	    {
		  $template->display('header');	
		  $template->display('login/index');
		  $template->display('footer');	
		}	
		
  	}
?>