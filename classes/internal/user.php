<?php
error_reporting(0); 
defined ('ITCS') or die ("Go away.");
class User extends Master
{
	var $user_id = NULL;
	function __construct()
	{
		global $my;
		$this->user_id=$my->uid;		
		parent::__construct();
	}
	
	function display()
	{
	
	}	
	
	function edituser()
	{
		global $db,$mainframe,$template;
		$uid = $this->user_id;
		$sql = "SELECT * from #__users WHERE uid=".$db->quote($uid);
		$db->setQuery($sql);
		$userDetails = $db->loadObjectList();
		$template->assignRef('userDetails',$userDetails);
	}
	function changepassword()
	{
		
	}
	function saveuser()
	{
		global $db, $template, $Config,$mainframe;
        $post = IRequest::get('POST');
		$user_id = IRequest::getInt("user_id");

		$path=IPATH_ROOT.DS.'images/avatar/'.$user_id.'/';
		$thumb_path=IPATH_ROOT.DS.'images/avatar/thumb/'.$user_id.'/';
		if(!file_exists ( $path ))
		{
			mkdir($path, 0777, true);
		}
		if(!file_exists ( $thumb_path ))
		{
			mkdir($thumb_path, 0777, true);
		}
		$allowed = array('png','jpg','jpeg','gif');
		if(isset($_FILES['avatar']) && (int)$_FILES['avatar']['error'] == 0)
		{			
			$extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			if(in_array(strtolower($extension), $allowed))
			{ 
				if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path.$_FILES['avatar']['name']))
				{
					$Arraylink=explode('/images',$path.$_FILES['avatar']['name']);
					$finalLink='images'.$Arraylink[1];
					$num=rand(0000,999999);
					$linkForScript=base64_encode($finalLink);
					
					//thumb generation..
					include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
					$Imageparams = array('width' =>210, 'height' =>179);	
					$thumb=Resizer::img_resize($finalLink,$Imageparams,"images/avatar/thumb/".$user_id,$_FILES['avatar']['name']);
				}
				else
				{
					echo '<scrip>alert("File attachment operation fail due to move uplode file problem, please try again "); </script>';
				}	
			}			
		}
		if($finalLink != '')
		{
			$sql = "UPDATE #__users SET avatar=".$db->quote($finalLink).",thumb=".$db->quote($thumb)." WHERE uid=".$user_id;
			$db->setQuery($sql);
		}
		$sql = "UPDATE #__users SET name=".$db->quote($post['name']).",
									Company=".$db->quote($post['Company']).",
									country=".$db->quote($post['country']).",
									email=".$db->quote($post['email']).",
									phone=".$db->quote($post['phone']).",
									address=".$db->quote($post['address']).",
									postal=".$db->quote($post['postal']).",
									city=".$db->quote($post['city']).",
									state=".$db->quote($post['state'])."
									WHERE uid=".$user_id;
		$db->setQuery($sql);
		echo "<script>window.parent.location.href='".$Config->site.'dashboard'."'</script>";
		echo "<script> window.parent.SqueezeBox.close() </script>";
	}
	
	//calling this function from ticket.js for calidate email on blur.
	function validateEmail() 
	{	
		global $db;
		$post = IRequest::get('POST');
		$where="WHERE LOWER(email) LIKE ".$db->quote(strtolower($post['email']))." AND uid NOT IN(".$db->quote($post["user_id"]).")";		
		$SQL="SELECT count(*) FROM #__users ".$where;
		$db->setQuery($SQL);
		$Data = $db->getOne();
		print_r($Data); exit;
	}
	
	function makeattendance()
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
		if(isset($attendance[0]->attendance_out) && $attendance[0]->attendance_out=="0000-00-00 00:00:00")
		{
			$status=2;
		}
		else
		{
			$status=1;
			$sql="SELECT MAX(attendance_in) FROM #__attendance WHERE user_id=".$db->quote($my->uid);
			$db->setQuery($sql);
			$LastdateTime = $db->getOne(); 
			if($LastdateTime!="")
			{
				$date1=date_create(date("Y-m-d",strtotime($LastdateTime)));
				$date2=date_create(date("Y-m-d"));
				$diff=date_diff($date1,$date2);
				$absentDays=array();
				if((int)$diff->days > 1);
				{
					for($i=1;$i< $diff->days ; $i++)
					{
						$absentDays[] = date('Y-m-d',strtotime($LastdateTime) + (24 * 3600 * $i));
					}
				}
			}
		}
		
		$template->assignRef('attendance',$status);
		$template->assignRef('absentDays',$absentDays);
	}
	function recordBreak()
	{
		date_default_timezone_set("Asia/Kolkata");
		global $db;
		$postArray=array();
		$post=IRequest::get("POST");
		if((int)$post["break_status"]==1):
			$postArray['user_id']=$post["user_id"];
			$postArray['break_start'] = date('Y-m-d H:i:s');			
			$this->post = $postArray;
			parent::bind('breaktime');
			parent::save();
			//$this->sendAttendanceEmail($postArray['break_start'],'Break-In Time','B');
			echo "<script>window.location.href='".$Config->site.'breaktime'."'</script>";
		else:
			$hours = $minutes = $seconds = "00";
           
            $break_stop= date('Y-m-d H:i:s');
            $break_start = $post["b_start"];
           
		  /* $dateTwo = new DateTime(date("Y-m-d H:i:s"));
		   $dateOne=new DateTime($post["b_start"]);
				$diff = $dateOne->diff($dateTwo);
				$Format=$diff->h." hours ".$diff->i." minutes ".$diff->s." Seconds";
				$Format=($diff->d==0 ? ($diff->h==0 ? $diff->i." minutes" : $diff->h." hours" ) : $diff->d." days" ); */
		   
            $b_start=strtotime($break_start);
            $b_stop=strtotime($break_stop);
            $seconds = $b_stop - $b_start;
            $days = floor($seconds/86400);
            $seconds -= $days * 86400;
            $hours = floor($seconds/3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds/60);
            $seconds -= $minutes * 60;
            $break_diff = $hours."h ".$minutes."m ".$seconds."s";
			
            $SQL="UPDATE #__breaktime SET break_stop=".$db->quote($break_stop).", break_diff=".$db->quote($break_diff)." WHERE user_id=".$post["user_id"]." AND break_stop IS NULL";
            $db->setQuery($SQL);
			
			//$this->sendAttendanceEmail($break_stop,'Break-Out Time','B');
            echo "<script>window.parent.location.href='".$Config->site.'dashboard'."'</script>";
            echo "<script>parent.jQuery.colorbox.close();</script>";
		endif;
	}
	
	function breaktime()
	{
		global $db,$template;
		
		$uid = $this->user_id;
		date_default_timezone_set("Asia/Kolkata");
		$whereArray=array();
		$date = date('Y-m-d');
		$date1=$date." 01:00:00";
		$date2=$date." 23:59:00";
		$whereArray[]="user_id=".$db->quote($uid);
		$whereArray[]="(break_start BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
		$where="WHERE ".implode(" AND ",$whereArray);
		$sql = "SELECT break_start, break_stop FROM #__breaktime ".$where;
		$db->setQuery($sql);
		$breakDetails = $db->loadObjectList();
		$template->assignRef('breakDetails',$breakDetails);
	}
	function addAttendance()
	{
		global $db;
		date_default_timezone_set("Asia/Kolkata");
		$postArray=array();
		$post=IRequest::get("POST");
		//print_r($post); exit;
		if((int)$post["attendance_type"]==1):
			$date = new DateTime();
			$tz = $date->getTimezone();
			$timezone = $tz->getName();	
			$postArray['ip'] = $_SERVER['REMOTE_ADDR'];
			$postArray['timezone'] = isset($post["time_zone"]) ? $post["time_zone"] : $timezone;	
			if(isset($post["leave_reason"]) && count($post["leave_reason"]) > 0)
			{
				foreach($post["leave_reason"] as $key=>$reason):
					$today=$post["leave_days"][$key];
					$this->post = array("user_id"=>$post["user_id"],"today"=>$today,"reason"=>$reason,"ip"=>$postArray['ip'],"timezone"=>$postArray['timezone']);
					parent::bind('attendance');
					parent::save();
				endforeach;
			}
			$postArray['today']=date('Y-m-d');
			$postArray['attendance_in'] = isset($post["attendance_time"]) ? $post["attendance_time"] : date('Y-m-d h:i:s');
			$postArray['reason']=$post["reason"];
			$postArray['user_id']=$post["user_id"];
			$this->post = $postArray;
			parent::bind('attendance');
			parent::save();
			//$this->sendAttendanceEmail($postArray['attendance_in'],"Attendance-in Time",'A');
		else:
			$date = date('Y-m-d');
			$date1=$date." 01:00:00";
			$date2=$date." 23:59:00";
			$timeZone=isset($post["attendance_time"]) ? $post["attendance_time"] : date('Y-m-d h:i:s');
			$SQL="UPDATE #__attendance SET attendance_out=".$db->quote($timeZone)." WHERE user_id=".$post["user_id"]." AND (attendance_in BETWEEN ".$db->quote($date1)." AND ".$db->quote($date2).")";
			$db->setQuery($SQL);
			//$this->sendAttendanceEmail($timeZone,"Attendance-Out Time");
		endif;
		
		echo "<script>window.parent.location.href='".$Config->site.'dashboard'."'</script>";
		echo "<script> window.parent.SqueezeBox.close();</script>";
	}
	function sendAttendanceEmail($in_time,$state,$type='A')
	{
		global $my,$Config;
		$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/attendanceMailtoAdmin.inc");
			$message = ob_get_clean();
			$message=str_replace("{user_name}",$my->name,$message);
			$message=str_replace("{attendance_time}",$in_time,$message); 
			$message=str_replace("{attendance_state}",$state,$message);
			$message=str_replace("{attendance_link}",$Config->site."admin/index.php?view=attendance",$message);
			
			$mailer->To="subikar.web@gmail.com";
			//$mailer->To="itsmeatha@gmail.com";
			$mailer->From="info@itcslive.com";
			if($type=='B'):
				$mailer->Subject="Break at iTCSLive";
			else:
				$mailer->Subject="Attendance at iTCSLive";
			endif;
			$mailer->Message = $message;
			$mailer->send();
	}
	function validateLocalDateFromAjax()
	{
		global $db;
		$post=IRequest::get("POST");
		$localDate=$post["localdate"];
		$dateTwo = new DateTime(date("Y-m-d H:i:s"));
		$dateOne=new DateTime($localDate);
		$diff = $dateOne->diff($dateTwo);
		$status= $diff->y > 0 ? 0 : ($diff->m > 0 ? 0 : ($diff->d > 0 ? 0 : ($diff->h > 0 ? 0 : ($diff->i > 30 ? 0 : 1))));
		$message=$status > 0 ? "ok" : "Please Update Your System Date and time or Contact System Administrator";
	
		print_r(json_encode(array("status"=>$status,"message"=>$message))); exit;
	}
	function updatePassword()
	{
		global $db;
		$post=IRequest::get("POST");
		$status=0;
		if(strcasecmp($post["new_pass"],$post["retype_new_pass"])==0 ) 
		{
			$sql = "SELECT password from #__users WHERE uid=".$db->quote($post["user_id"]);
			$db->setQuery($sql);
			$password = $db->getOne();
			if(strcasecmp($password,$post["old_pass"])==0 ){
			$QUERY="UPDATE #__users SET password=".$db->quote($post["new_pass"])." WHERE uid=".$db->quote($post["user_id"]);
			$db->setQuery($QUERY);
			$message="Your Password Successfully Changed!";
			$status=1;
			$this->sendPasswordChangeEmail($post);
			} else {
				$message="Sorry! you entered the wrong password!";
				$status=0;
			}
		}	
		else
		{
			$message="Sorry! Your new password and retype password does not match!";
			$status=0;
		}
		
		print_r(json_encode(array("message"=>$message,"status"=>$status))); exit;
	}
	
	function sendPasswordChangeEmail($post)
	{
		global $my,$Config;
		$mailer=new IMail;
			ob_start();
			include_once(IPATH_ROOT."/mail_inc/passwordChangeMail.inc");
			$message = ob_get_clean();
	
			$message=str_replace("{user_name}",$my->name,$message);
			$message=str_replace("{site_name}",$Config->site,$message);
			$message=str_replace("{email}",$my->email,$message);
			$message=str_replace("{password}",$post["new_pass"],$message);
			
			$mailer->To=trim($my->email);
			$mailer->From="info@itcslive.com";
			$mailer->Subject="Password Changed in Your account at iTCSLive";
			$mailer->Message = $message;
			$mailer->send();
	}
	
	//calling this function from ticket.js for calidate email or phone adding contact and modify user.
	function checkemailORphone()
	{
		global $db,$mainframe;
		$post=IRequest::get("POST");
		$status=-1; $message=""; $error="";
		if($post['user_id'] != '')
			$where = " AND uid NOT IN (".$db->quote($post['user_id']).")";
		else
			$where = " ";
		
		if($post['email']!=""):
			$SQL = "SELECT count(*) from #__users WHERE email LIKE ".$db->quote($post['email']).$where;
			$db->setQuery($SQL);
			$countUser_for_email = $db->getOne();
			if((int)$countUser_for_email > 0){ $status=0; $message="Email Exist!"; $error="email";} else {$status=1;}
		endif;
		if($post['phone']!="" && $status !=0):
			$SQL = "SELECT count(*) from #__users WHERE phone LIKE '%".$post['phone']."%'".$where;
			$db->setQuery($SQL);
			$countUser_for_phone  = $db->getOne();
		  if((int)$countUser_for_phone > 0){ $status=0; $message="Phone Exist!"; $error="phonenunber";} else {$status=1;}
		endif;  
		
		if($status == -1):
		  $message="Please Enter phone no or email!" ; $status=0; $error="phonenunber";
		endif;
		
		print_r(json_encode(array("message"=>$message,"status"=>$status,"error"=>$error))); exit;
	}	
}
?>	