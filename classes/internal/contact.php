
<?php 
error_reporting(0);
  class Contact extends Master {
        function __construct()
		  {
		    // print("subikarburman"); 
		    parent::__construct();
		  }
		function display()
		  {
		    // Do Nothing
		  }  
		 function Category()
		   {
		     global $db;
			 $Query = "select id,category_name from #__category Where type='ticket'";
			 $db->setQuery($Query);
			 $Category = $db->loadObjectList();
			 return $Category;
		   }  
		   
		   //Code and Functions For contact Us.
		   function createticket()
		   {
		   		global $db,$template,$mainframe,$Config;
		   		$post=IRequest::get("POST");
				$session = IRequest::get("SESSION");
				if($post["formkey"]!=$session[$post['form']])
					{
						 $mainframe->redirect($Config->site.'error-thank-you');
					}
   			    unset($post["formkey"]);
				unset($post["text_num"]);
				unset($post["form"]);
				unset($post["task"]);
				unset($post["view"]);
				unset($post["view"]);
				unset($post["timeframe"]);
				
			 $PostArgumentsInArray = array (
			                              'form_data'=>json_encode($post),
			                              'form_submitted_on'=>date('Y-m-d h:i'),
			                              'spam'=>0,
										  'status'=>1,
			                           );
			$this->post = $PostArgumentsInArray;
			//print_r($this->post); exit;
			parent::bind('formdata');
			parent::save();
		//	print("test"); exit;
			if((int)$post["category"] > 0)
				{
					 $Query = "select category_name from #__category Where type='ticket' AND id=".$db->quote($post["category"]);
						//echo $Query;exit;
					 $db->setQuery($Query);
					$post["category"]=$db->getOne();
				}	
			$this->sendmailToAdmin($post);
			$this->sendmailToCustomer($post);
		   $mainframe->redirect($Config->site.'thank-you');
		   
		   }
		   function sendmailToCustomer($ArgumentsInArray)
		  {
				$mailer=new IMail;
				ob_start();
				include_once(IPATH_ROOT."/mail_inc/MailToCustomer.inc");
				$message = ob_get_clean();
				  
				$message=str_replace('{CustomerName}',$ArgumentsInArray['name'],$message);
				$mailer->To=$ArgumentsInArray['email'];
				$mailer->From="info@itcslive.com";
				$mailer->Subject="Thank You! Our representative will get back to you soon.";
				$mailer->Message = $message;
				//print_r($ArgumentsInArray); exit;
				$mailer->send();
		  } 
		   
		   function sendmailToAdmin($ArgumentsInArray)
		  {
				$mailer=new IMail;
				ob_start();
				include_once(IPATH_ROOT."/mail_inc/ContactMail_ForTicket.inc");
				$message = ob_get_clean();
								
				$BodyContent = array();
				foreach($ArgumentsInArray as $key=>$Value):
				   $BodyContent[] = ucfirst($key).':'.$Value;
				endforeach; 
				  $BodyContent = implode(' <br> ',$BodyContent);
				  
				$message=str_replace('{admin_name}',"Admin",$message);
				$message=str_replace('{details}',$BodyContent,$message);
				//print($message); exit;
				$toemail = array('subikar.web@gmail.com','pradip3@itcslive','romila@itcslive.com');
				$mailer->To=implode(',',$toemail);
				$mailer->From="kolkata@itcslive.com";
				$mailer->Subject="New Enquiry from iTCSLive Enquiry Details";
				$mailer->Message = $message;
				$mailer->send();
		  } 
		  function varifyCaptcha()
		  {
		  		$post=IRequest::get("POST");
				$feedBack=array();
				if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $post['captcha']) != 0)
				{  
					$feedBack["status"]=0;
					$feedBack["message"]="<span style='color:red'>Error Validation!</span>";// Captcha verification is incorrect.		
				}
				else
				{
					$feedBack["status"]=1;
					$feedBack["message"]="<span style='color:green'>The Validation code has been matched.</span>";		
				}
			print_r(json_encode($feedBack)); exit;	
		  }
		  
		  
		  
		 function searchContent()
		  {
		  	  global $db,$Config; 
			  $limit=5;
			  $post=IRequest::get("POST");
			  $whereArray=array();
			  $searchText=strtolower($post["search_text"]);
			  $whereArray[]="LOWER(p.title) LIKE '%".$searchText."%'";
			  $whereArray[]="LOWER(p.content) LIKE '%".$searchText."%'";
			  
			  $where=" WHERE ".implode(" OR ",$whereArray);
			  
			  $Query="SELECT count(*) FROM `#__page` as p LEFT JOIN 
			  				 `#__404` as handler on (p.id = handler.type_id AND handler.type='page') LEFT JOIN
			  				`#__gallery` as g  ON p.gallery_id=g.gallery_id ".$where;
			 $db->setQuery($Query);
			 $resultCount= $db->getOne();
		
			 $page=(int)$post["page_count"];
			 $limitStart= ($page - 1) * $limit;
			  
			  $Query="SELECT p.title, p.content,g.data,handler.seo FROM 
			                 `#__page` as p LEFT JOIN 
			  				 `#__404` as handler on (p.id = handler.type_id AND handler.type='page') LEFT JOIN
			  				 `#__gallery` as g  ON p.gallery_id=g.gallery_id ".$where." ORDER BY CASE WHEN LOWER(p.title) LIKE '".$searchText."%' THEN 0 WHEN LOWER(p.title) LIKE '%".$searchText."' THEN 1 ELSE 2 END";
			 $db->setQuery($Query,$limitStart,$limit);
			 $Contents= $db->loadObjectList();
			
			 foreach($Contents as $value):
				 if($value->data!="" && $value->data!=NULL ):
					 $gallery=unserialize($value->data);
					 $lastGallery=end(array_filter($gallery));
					 $value->gallery=$Config->site."images/gallery/".$lastGallery;
				 else:
				 	$value->gallery=$Config->site."images/default/default_content_image.png";	 
				 endif;	
				 $value->content= substr(strip_tags($value->content),0,30).'...';
			 endforeach;
			 
			ob_start();
					include_once(IPATH_ROOT."/templates/itcslive/modules/contentsearch/searchresult.php");
			$html = ob_get_clean();
		print_r(json_encode(array("result_html"=>$html))); exit;	 
		}
		
		function clientSPeak()
		{
			 global $db,$Config; 
			  $limit=4;
			  $post=IRequest::get("POST");
			//print_r($post); exit;
			
			$Query="SELECT count(*) FROM `#__testimonial` as t LEFT JOIN #__gallery as g ON t.gallery_id=g.gallery_id";
			  $db->setQuery($Query);
			  $resultCount = $db->getOne();
			  
			  $totalPage=round(($resultCount/$limit), 2);
			  $lastPage= ($totalPage > intval($totalPage)) ? intval($totalPage) +1: intval($totalPage); 
			  
			 $page=(int)$post["page_count"];
			 $limitStart= ($page - 1) * $limit;
			  
			
			$Query="SELECT t.client_name,t.client_address,t.testimonial_content,t.website,g.data FROM `#__testimonial` as t LEFT JOIN #__gallery as g ON t.gallery_id=g.gallery_id ORDER BY t.id DESC";
			  $db->setQuery($Query,$limitStart,$limit);
			  $ClientsSpeakInArray = $db->loadObjectList();
			 include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
			  $Imageparams = array('width' =>236, 'height' =>172, 'rgb' => '0x000000', 'aspect_ratio' =>false, 'crop' =>false);	
			  foreach($ClientsSpeakInArray as $value):
				 if($value->data!="" && $value->data!=NULL ):
					 $galleryInArray=array_values(unserialize($value->data));
					 $file_path="images/gallery/".$galleryInArray[0];
							if(file_exists(IPATH_ROOT."/".$file_path))
							{
								$value->gallery = Resizer::img_resize($file_path,$Imageparams,"cache/clientspeak");
							}
							else
							{
								$value->gallery=$Config->site."templates/itcslive/images/portfolio/customer_review.png";	
							}
				 else:
				 	$value->gallery=$Config->site."templates/itcslive/images/portfolio/customer_review.png";	 
				 endif;	
			 endforeach;
			 
			  ob_start();
					include_once(IPATH_ROOT."/templates/itcslive/modules/clientspeak/eachspeak.php");
			$html = ob_get_clean();
			
			 ob_start();
					include_once(IPATH_ROOT."/templates/itcslive/modules/clientspeak/pagination.php");
			$pagination = ob_get_clean();
			
		print_r(json_encode(array("result_html"=>$html,"pagination"=>$pagination))); exit;	 
		}   
		
		function getGallery()
		{
			global $db,$Config,$params; 
			$paramsInArray=$params->getParams("invoice");
			$post=IRequest::get("POST");
			//print_r($post); exit;
			$limit=((int)$post['limit'] > 0 ) ? (int)$post['limit'] : (((int)$paramsInArray["gallery_page_limit"] > 0) ? $paramsInArray["gallery_page_limit"] : 3);
			//$limit=12;
		   $basePath=$Config->site; $status=0; $htm=""; $fullGallery=array();
     	    include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
			$GalleryImages=array_values(unserialize($post["gallery"]));
			$resultCount=count($GalleryImages);
			if($resultCount > 0)
			{
				$totalPage=round(($resultCount/$limit), 2);
				$lastPage= ($totalPage > intval($totalPage)) ? intval($totalPage) +1: intval($totalPage); 
				  
				 $page=(int)$post["page_count"];
				 $limitStart= ($page - 1) * $limit;
				$GalleryImages=array_slice($GalleryImages, $limitStart, $limit);
				
				foreach($GalleryImages as $key=>$GalleryImage):
				 $file_path="images/gallery/".$GalleryImage;
					 $aspect_ratio = false;
					 $crop = false;
					list($oriwidth, $oriheight) = getimagesize(IPATH_ROOT."/".$file_path);
					if(($oriwidth - $post['width']) > 100 && ($oriheight - $post['height']) > 100 )
					  {
					     $aspect_ratio = true;
						 $crop = true;
					  }
					$Imageparams = array('width' =>$post['width'], 'height' =>$post['height'], 'rgb' => '0x000000', 'aspect_ratio' =>$aspect_ratio, 'crop' =>$crop);	
				 
					if(file_exists(IPATH_ROOT."/".$file_path))
					{
						$fullGallery[$key]["thumb"] = Resizer::img_resize($file_path,$Imageparams,"cache/contentGallery");
					}
					$fullGallery[$key]["org"]=$file_path;
				endforeach;
				
				ob_start();
					include_once(IPATH_ROOT."/templates/itcslive/ImageSlider/classic/content.php");
				$html = ob_get_clean();
				$status=1;
			}
			
			print_r(json_encode(array("result_html"=>$html,"status"=>$status))); exit;
		}
     function SaveRegister()
	   {
	      global $mainframe,$Config,$template,$db;
	   	  $post=IRequest::get("POST");
		  
		  unset($post[view]);
		  unset($post[task]);
	  
		  $email_exists = 0;
		
		  $Query = "select email from #__users Where email=".$db->quote($post[email]);
		  $db->setQuery($Query);
		  $email_exists = $db->getOne();
		  $phone_exists = 0;
		  $Query = "select phone from #__users Where phone =".$db->quote($post["phone"]);
		  $db->setQuery($Query);
		  $phone_exists  = $db->getOne();
			 //echo $email_exists;exit;		
		  if($email_exists >= 1 || $phone_exists >= 1)
		    {
			  if($email_exists >= 1)
			  $template->assignRef('RegistrationError','Email Address already Exists!');
			  if($phone_exists >= 1)
			  $template->assignRef('RegistrationError','Contact Number already Exists!');
			  $template->includejs("templates/itcslive/js/signup.js"); 
			  $template->display('header');	
			  if($post[usertype]=='transporter')
			  	$template->display('login/signuptransporter');
			  else 
			  	$template->display('login/signup');
			  $template->display('footer');	
			  exit;
			}
		 	
		    $_POST['avatar'] =  $this->uplodeAvatar();
			$this->post=$post;
			parent::bind('users');
    		parent::save();
			if($post[usertype]=='transporter')
				{
					
				$id = $db->insertid();
				$_POST['id']=$id;
				//print_r($_POST);exit;
				parent::bind('profiledata');
    			parent::save();
					
				}
			//print($Config->site.'thank-you'); exit;
			$mainframe->redirect($Config->site.'thank-you');
	   }  		


 

       function uplodeAvatar()
		{
				 global $db, $template, $Config,$mainframe;
				 $files = IRequest::get('FILES');
				 $img_path = IPATH_ROOT.'/images/avatar/';
				 $AcceptedFilesInArray = array('jpg','png','jpeg','gif');
				 $ext = pathinfo($files['avatar']['name'], PATHINFO_EXTENSION);
				
				 if(in_array($ext,$AcceptedFilesInArray) && $files['avatar']['size'] < 100000)
				   {
 				     $name = md5(time()).'.'.$ext;     
				     $res =move_uploaded_file($files['avatar']['tmp_name'], $img_path.$name);
					// print($img_path.$name);
					// print_r($res); exit;
					if($res == 1)
						$avatar = $name;
					 
					 
				   }
				 else
				   {
					  $template->assignRef('RegistrationError','Please use small Image to upload');
					  $template->includejs("templates/itcslive/js/signup.js"); 
					  $template->display('header');	
					  $template->display('login/signup');
					  $template->display('footer');	
					  exit;
				   }  
				  return $avatar;
			
		}


	
		   function sendmailToRegisteredUser($ArgumentsInArray)
		  {
				$mailer=new IMail;
				ob_start();
				include_once(IPATH_ROOT."/mail_inc/MailRegisterUser.inc");
				$message = ob_get_clean();
				  
				$message=str_replace('{CustomerName}',$ArgumentsInArray['name'],$message);
				$mailer->To=$ArgumentsInArray['email'];
				$mailer->From="info@itcslive.com";
				$mailer->Subject="Thank You! Your Account is created as Letsport.";
				$mailer->Message = $message;
				//print_r($mailer); exit;
				$mailer->send();
		  } 
	 
 		function addtruckbid()
 		{
 			global $db,$my,$mainframe;
			$id = IRequest::getVar('id');
			$post=IRequest::get('post');
			//print_r($post[amount]);exit;
 			$Query = "select * from #__ourworks Where id=".$db->quote($id);
			$db->setQuery($Query);
		    $Category = $db->loadObjectList();
			//print_r($Category);exit;
			$Category = $Category[0];
			//print_r($Category);exit;
			$arr = array('material_type' => $post[material_type], 'price' => $Category->price);
			//print_r($arr);exit;
			$PostArray[work_id] = $id;
			$PostArray[bid_text] = json_encode($arr);
			$PostArray[amount] = $post[amount];
			$PostArray[bid_owner_id] = $my->uid;
			$PostArray[bid_won] = '0';
			$PostArray[bid_remove] = '0';
			//print_r($PostArray);exit; 
						                   
			$this->post = $PostArray;
			//print_r($this->post);exit;
			parent::bind('bids');
    		parent::save();
			$Query="SELECT * from #__subscriber WHERE owner=".$my->uid;
			 $db->setQuery($Query);
			 $reduce_bids = $db->loadObjectList();
			 $reduce_bids[0]->lead_count=$reduce_bids[0]->lead_count-1;
			// print_r($reduce_bids[0]->lead_count);exit;
			$this->post[lead_count]=$reduce_bids[0]->lead_count;
			//print_r($this->post);exit;
			$Where = "owner = ".$my->uid;
			$this->Where=$Where;
			parent::bind('subscriber');
    		parent::update();
			$mainframe->miniredirect($Config->site."search-truck");
			
 		}
 
 
  		function addloadbid()
 		{
 			global $db,$my,$mainframe;
			$id = IRequest::getVar('id');
			$post=IRequest::get('post');
			//print_r($post);exit;
 			$Query = "select * from #__ourworks Where id=".$db->quote($id);
			$db->setQuery($Query);
		    $Category = $db->loadObjectList();
			$Category = $Category[0];
			//print_r($Category);exit;
			$arr = array('truck_no' => $post[truck_no], 'name' => $post[name]);
			//print_r($arr);exit;
			$PostArray[work_id] = $id;
			$PostArray[bid_text] = json_encode($arr);
			$PostArray[amount] = $post[amount];
			$PostArray[bid_owner_id] = $my->uid;
			$PostArray[bid_won] = '0';
			$PostArray[bid_remove] = '0';
			//print_r($PostArray);exit; 
						                   
			$this->post = $PostArray;
			//print_r($this->post);exit;
			parent::bind('bids');
    		parent::save();
			
			$Query="SELECT * from #__subscriber WHERE owner=".$my->uid;
			 $db->setQuery($Query);
			 $reduce_bids = $db->loadObjectList();
			 $reduce_bids[0]->lead_count=$reduce_bids[0]->lead_count-1;
			// print_r($reduce_bids[0]->lead_count);exit;
			$this->post[lead_count]=$reduce_bids[0]->lead_count;
			//print_r($this->post);exit;
			$Where = "owner = ".$my->uid;
			$this->Where=$Where;
			parent::bind('subscriber');
    		parent::update();
			$mainframe->miniredirect($Config->site."search-truck");
			
 		}
 
 	   function winbidtruck()
		{
			global $db,$my,$mainframe;
			$post=IRequest::get('post');
		//	print_r($post);exit;
			unset($post['task']);	
			unset($post['view']);
			$bid_id=$post[bid_id];
			unset($post['bid_id']);
			//print_r($post);exit;
			$post[bid_won]=1;
			$this->post=$post;
			parent::bind(bids);
			$Where=' bid_id = '.$bid_id;
			$this->Where=$Where;
			parent::update();
			$this->bidstruck();
			$mainframe->miniredirect($Config->site."dashboard");
}
		 

	   function winbidload()
		{
			global $db,$my,$mainframe;
			$post=IRequest::get('post');
			
			unset($post['task']);	
			unset($post['view']);
			$bid_id=$post[bid_id];
			unset($post['bid_id']);
			
			$post[bid_won]=1;
			$this->post=$post;
			//print_r($post);exit;
			parent::bind(bids);
			$Where=' bid_id = '.$bid_id;
			//print_r($Where);exit;
			$this->Where=$Where;
			parent::update();
			$mainframe->miniredirect($Config->site."dashboard");
		}
 
 
   }

?>