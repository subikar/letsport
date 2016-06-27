<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Attach extends Master 
	{
        function __construct()
		{
			parent::__construct();
		}
		function display()
		{
			global $db,$my,$Config,$template;
			$googlelinkHtml = array();
			$sql = "SELECT * from #__googleapi WHERE user_id=".$db->quote($my->uid);
			$db->setQuery($sql);
			$google_token = $db->loadObjectList();
			$google_token = $google_token[0];
			$template->assignRef('google_token',$google_token);
			$template->display('attach/index');
		}
		function startapi()
		{
			
		}
		function oauth2callback()
		{
			global $Config,$db,$my,$template;
			$oauth2callbaskHtml = array();
			require_once '../templates/itcslive/attach/google-api-php-client/src/Google_Client.php';
			require_once '../templates/itcslive/attach/google-api-php-client/src/contrib/Google_DriveService.php';
			require_once '../templates/itcslive/attach/google-api-php-client/src/contrib/Google_Oauth2Service.php';
			if($_GET['code'] != '')
			{
				$client = new Google_Client();
				$client->setClientId('775371548590-a5bqn5kemee7kev2n46smqn6tu60pq37.apps.googleusercontent.com');
				$client->setClientSecret('2POekLfEMNjltt-dYONb5PvM');
				$client->setRedirectUri('http://www.itcslive.in/oauth2callback');
				$client->setScopes(array('https://www.googleapis.com/auth/userinfo.profile',
											 'https://www.googleapis.com/auth/userinfo.email',
											 'https://www.googleapis.com/auth/drive',
											 'https://www.googleapis.com/auth/calendar',
											 'https://www.googleapis.com/auth/drive.apps.readonly'));
				$service = new Google_DriveService($client);
				$plus = new Google_Oauth2Service($client);
				$client->authenticate($_GET['code']);
				$accessToken = $client->getAccessToken();
				$userinfo = $plus->userinfo;
    			$userinfo = json_encode($userinfo->get());
				$this->post = array('token_key'=>$accessToken,'linking_email'=>$userinfo,'user_email'=>$my->email,"user_id"=>$my->uid);
				parent::bind('googleapi');
				parent::save();
				$link_id = $db->insertid();
				$template->assignRef("link_id",$link_id);
				echo "<script type='text/javascript'>window.location.href='".$Config->site."dashboard'</script>";
			}
			if($_GET['error'] != '')
			{
				echo "<script type='text/javascript'>window.location.href='".$Config->site."dashboard';</script>";
			}
			
		}
		function unlink()
		{
			global $db,$my,$Config,$template;
			$sql = "DELETE FROM #__googleapi WHERE user_id=".$db->quote($my->uid);
			$db->setQuery($sql);
			$template->display('tmplpopup/header');
			echo "<script type='text/javascript'>window.location.href='".$Config->site."dashboard';</script>";
			$template->display('tmplpopup/footer');
		}
		function ajaxUpload()
		{
			global $db,$Config;
			$post=IRequest::get('post');
			if($_FILES['files']['size'] > 5*1024*1024)
			{
				echo "<scrip>alert('File is too large. Please upload below 5MB.'); </script>";
			}
			else
			{
				if($post['type'] == 'ticket')
				{
					$path=IPATH_ROOT.DS.'images/files/ticket/'.$post['link_id'].'/'.date('Y-m-d H:i:s').'/';
				}
				else if($post['type'] == 'task')
				{
					$path=IPATH_ROOT.DS.'images/files/task/'.$post['link_id'].'/'.date('Y-m-d H:i:s').'/';
				}
				if(!file_exists ( $path ))
				{
					mkdir($path, 0777, true);
				}
				$allowed = array('png','jpg','jpeg','gif','txt','doc','pdf','docx','zip','rar','xlsx','xls','xml','xps','psd','ai');
				if(isset($_FILES['files']) && (int)$_FILES['files']['error'] == 0)
				{			
					$extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
					if(in_array(strtolower($extension), $allowed))
					{ 
						if(move_uploaded_file($_FILES['files']['tmp_name'], $path.$_FILES['files']['name']))
						{
							$Arraylink=explode('/images',$path.$_FILES['files']['name']);
							$finalLink='images'.$Arraylink[1];
							$num=rand(0000,999999);
							$linkForScript=base64_encode($finalLink);
							echo "<script type='text/javascript'>
							var li = document.createElement(\"li\"); 
							li.setAttribute(\"id\",\"li".$num."\");
							li.innerHTML='".$_FILES['files']['name']."<a href=\"javascript:void(0);\" onclick=\"Attachment.delAttachfile(\'".$linkForScript."\',\'li".$num."\');\"><i class=\"fa fa-trash-o fa-right\"></i></a><input type=\"hidden\" name=\"attachment[]\" value=\"".$linkForScript."\">';
							window.parent.document.getElementById('allAttechFile').appendChild(li); 
							parent.jQuery.fn.colorbox.close();
							</script>";
						}
						else
						{
							echo '<scrip>alert("File attachment operation fail due to move uplode file problem, please try again "); </script>';
							echo '<script> parent.jQuery.fn.colorbox.close(); </script>';
						}	
					}
					else
					{
						echo '<scrip>alert("File attachment operation fail due to Invalid Extension, please try again "); </script>';
						echo '<script> parent.jQuery.fn.colorbox.close(); </script>';
					}			
				}
				else
				{
					echo '<scrip>alert("File attachment operation fail due to some reason, please try again "); </script>';
					echo '<script> parent.jQuery.fn.colorbox.close(); </script>';
				}
			}
		}
		
		function unlinkAttachFile()
	    {
			global $db;
			$success=0;
			$link=base64_decode(IRequest::getVar('alink'));
			$nwLink=IPATH_ROOT.DS.$link;
			if(file_exists($nwLink))
			{
				unlink($nwLink);
				$success=1;
			}
			else
			{
				$success=0;
			}
			print_r(json_encode(array("status"=>$success))); exit;
		} 
		
		function googleupload()
		{
			global $db,$Config;
			$post=IRequest::get('post');
			$googlefile = explode(",",$post['googlefile']);
			$filename = $googlefile[0];
			$googlefilelink = array("filename"=>$googlefile[0],"downloadLink"=>$googlefile[1],"iconLink"=>$googlefile[2]);
			$linkForScript = json_encode($googlefilelink);
			$googlefile = base64_encode($linkForScript);
			$num=rand(0000,999999);
			echo "<script type='text/javascript'>
							var li = document.createElement(\"li\"); 
							li.setAttribute(\"id\",\"li".$num."\");
							li.innerHTML='".$filename."<a href=\"javascript:void(0);\" onclick=\"Attachment.delgoogleAttachfile(\'li".$num."\');\"><i class=\"fa fa-trash-o fa-right\"></i></a><input type=\"hidden\" name=\"googleattachment[]\" value=\"".$googlefile."\">';
							window.parent.document.getElementById('allAttechFile').appendChild(li); 
							parent.jQuery.fn.colorbox.close();
							</script>";

		}	
	}
?>