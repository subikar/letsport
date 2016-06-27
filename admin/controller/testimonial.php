<?php 
error_reporting(0); 
  class Testimonial extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/testimonial.js');
			$this->getpages();
			$template->display('header');
			$template->display('testimonial/testimonial');
			$template->display('footer');
	  	 }  
	  	function  getpages()
		{
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$searchTest = IRequest::getVar('search_txt');
			$Limit = ($Config->limit)?$Config->limit:20;
			if($searchTest != '')
			{
				$where = "WHERE client_name LIKE '%".$searchTest."%' OR client_address  LIKE '%".$searchTest."%'";
			}
			else
			{
				$where = "";
			}
			
			$Query = "select count(*) from #__testimonial ".$where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__testimonial ".$where." order by id desc";
			$db->setQuery($Query,$start,$Limit);
			$Testimonials = $db->loadObjectList();
			$template->assignRef('testimonial',$Testimonials);
		}
		function addnew()	
		{
			global $template;
			$template->includejs('templates/itcslive/js/testimonial.js');
			$TestimonialID = IRequest::getVar("testimonial_id", "");
			//print_r($TestimonialID); echo "tesing.."; exit;
			if($TestimonialID!="")
			{
				$this->getTestimonialdetails($TestimonialID);
				$this->getSeodetails($TestimonialID);
			}
			$template->display('header');
			$template->display('testimonial/addnew');
			$template->display('footer');
		}
		function getTestimonialdetails($TestimonialID)
		{
			global $db,$template;
			$Query = "select *  from #__testimonial WHERE id=".(int)$TestimonialID;
			$db->setQuery($Query);
			$Pages = $db->loadObjectList();
			$Pages=$Pages[0];
			if((int)$Pages->gallery_id > 0)
			{
				$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$Pages->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Pages->gallery=unserialize($Data);
			}
			$template->assignRef('testimonialData',$Pages);
		}
		function getSeodetails($TestimonialID)
		{
			global $db,$template;
			$Query = "select *  from #__404 WHERE type='testimonial' AND type_id=".(int)$TestimonialID;
			$db->setQuery($Query);
			$Pages = $db->loadObjectList();
			$Pages=$Pages[0];
			$template->assignRef('seoData',$Pages);
		}
		function savepage()
		{
			 global $db, $template, $Config,$mainframe;
              $post = IRequest::get('POST');
			  $content =IRequest::getVar('testimonial_content','','POST','STRING',IREQUEST_ALLOWHTML);
			  $post['testimonial_content']=$content;			  
			  $post['modified'] = date('Y-m-d h:i');
			  
			if(is_numeric($post["client_name"]))
			{
				$userID=$post["client_name"];
				$post["client_name"]=$post["client_name_input"];
			}
			else
			{
				$userID=$this->registerUser($post);
			}
			  
			  $UploadedFiles=$this->uplodeGallery();
			   
				if((int)$post["testimonial_id"] > 0)
				{
				   $removeFiles= IRequest::getVar("remove_gallery");				  
					if(count($UploadedFiles) > 0 || count($removeFiles) > 0 ) 
					{
						$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$post["gallery_id"];
						$db->setQuery($SQL);
						$Data = $db->getOne();
						
						if($Data!="")
						$ExistGallery=unserialize($Data);
						else
						$ExistGallery="";
						
						if(count($removeFiles) > 0)
						{
							$GalleryPath=IPATH_ROOT.'/images/gallery/';
							foreach($removeFiles as $Gallery):
								unlink($GalleryPath.$Gallery);
								if($ExistGallery !="")
								{
									if(($key = array_search($Gallery, $ExistGallery)) !== false) {
										unset($ExistGallery[$key]);
									}
								}
							endforeach;
						}						
						$AllFiles=array_merge((array)$UploadedFiles,(array)$ExistGallery);						
						$allFiles=array_filter($AllFiles);
						$InsertableFiles=serialize($allFiles);
						if((int)$post["gallery_id"] > 0)
						{
							$SQL="UPDATE #__gallery SET data=".$db->quote($InsertableFiles)." WHERE gallery_id=".(int)$post["gallery_id"];
							$db->setQuery($SQL);
						}
						else
						{
							$this->post = array("data"=>$InsertableFiles);
							 parent::bind('gallery');
							 parent::save();
							$post["gallery_id"]=$db->insertid();
						}
					 }					 
					 $Query="UPDATE #__testimonial SET client_name=".$db->quote($post['client_name']).",
													client_email=".$db->quote($post['client_email']).",
													client_phone=".$db->quote($post['client_phone']).", 
													client_address=".$db->quote($post['client_address']).", 
													client_id=".$db->quote($userID).", 
													testimonial_content=".$db->quote($post['testimonial_content']).", 
													gallery_id=".$db->quote($post["gallery_id"]).",
													website=".$db->quote($post["website"]).",
													modified=".$db->quote($post['modified'])." 
													WHERE id=".$db->quote($post['testimonial_id']);
					$db->setQuery($Query);	
					if($post["alias"]=="")
					{	
					 	$seo=str_replace(" ","-",strtolower(trim($post["client_name"])));
					 }
					 else
					 {
					 	$seo=trim($post["alias"]);
					 }		
					$orgUrl="testimonial.php?id=".(int)$post['testimonial_id'];
					
					$Query="SELECT count(*) FROM #__404 WHERE original LIKE ".$db->quote($orgUrl);
					$db->setQuery($Query);		
					$seoExist = $db->getOne();	
					if((int)$seoExist >0):
						$SQL="UPDATE #__404 SET seo=".$db->quote($seo)." WHERE original LIKE ".$db->quote($orgUrl);
						$db->setQuery($SQL);		
					else:
						$this->post=array("original"=>$orgUrl,"seo"=>$seo, "hits"=>0,"type"=>"testimonial","type_id"=>$post['testimonial_id']);
						parent::bind('404');
						parent::save();			 
				   endif;
				   
				   }
				   else
				   {
				   		$InsertableFiles=serialize($UploadedFiles);
				   		$this->post = array("data"=>$InsertableFiles);
						parent::bind('gallery');
						parent::save();
						
						$post["gallery_id"]=$db->insertid();
					   	$post['status'] = 1;
					   	$post['created'] = date('Y-m-d h:i');
						$post['client_id'] = $userID;
						$this->post = $post;
						parent::bind('testimonial');
						parent::save();
						$TestimonialID=$db->insertid();
						if($post["alias"]=="")
						{	
							$seo=str_replace(" ","-",strtolower(trim($post["client_name"])));
						 }
						 else
						 {
							$seo=trim($post["alias"]);
						 }	
						$orgUrl="testimonial.php?id=".$TestimonialID;
						$this->post=array("original"=>$orgUrl,"seo"=>$seo, "hits"=>0,"type"=>"testimonial","type_id"=>$TestimonialID);
						parent::bind('404');
						parent::save();
				  } 	
				if($post['Save_close'])
				{
			   	 	$mainframe->redirect('index.php?view=testimonial');
				}
				else if($TestimonialID != '')
				{
					$mainframe->redirect('index.php?view=testimonial&task=addnew&testimonial_id='.$TestimonialID);
				}
				else
				{
					$mainframe->redirect('index.php?view=testimonial&task=addnew&testimonial_id='.$post['testimonial_id']);
				}
			}	
			
		function uplodeGallery()
		{
			global $db, $template, $Config,$mainframe;
			$nameArray=array();
			$img_path = IPATH_ROOT.'/images/gallery/';
			$files =  IRequest::getVar('image_upload', null, 'files', 'array');
			if(count($files['name']) >0):
				for($i=0;$i < count($files['name']) ; $i++)
				{
					$res=0;
					//$ext =  JFile::getExt($files['name'][$i]);
					$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
					
					$filename = $files['name'][$i];
					if(is_file($img_path.$files['name'][$i]))
					{
						$filename = $filename;
					}
					$name =  'gallery'.rand(0,9999).time().'.'.$ext;
					if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif')
					{
						$res =move_uploaded_file($files['tmp_name'][$i], $img_path.$name);
					}
					if($res == 1)
					{
						$nameArray[]=$name;
					}
				}
			endif;			
			return $nameArray;		
		}	
		
		function Fn_validate_submitForm()
		{
			global $db;
			$post = IRequest::get('POST');
			if((int)$post["testimonial_id"] > 0)
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["client_name"]))." AND type != 'testimonial' AND type_id NOT IN(".$db->quote($post["testimonial_id"]).")";
			}
			else
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["client_name"]));
			}
			$SQL="SELECT count(*) FROM #__404 ".$where;
			//print_r($SQL); exit;
			$db->setQuery($SQL);
			$Data = $db->getOne();
			print_r((int)$Data); exit;
		}
		function RemoveTestimonial()
		{
			global  $db,$mainframe;
			$testimonial_id=IRequest::getInt("testimonial_id");
			if((int)$testimonial_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__testimonial WHERE id=".$db->quote($testimonial_id);
				$db->setQuery($sql);
				$galleryId = $db->getOne();			
				
				if($galleryId != '')
				{
					$GalleryPath=IPATH_ROOT.'/images/gallery/';
					$SQL = "SELECT data FROM #__gallery WHERE gallery_id=".$galleryId;					
					$db->setQuery($SQL);
					$galleryData = $db->getOne();					
					$newData = unserialize($galleryData);
					
					foreach($newData as $File)
					{
						if(file_exists($GalleryPath.$File)){
    							unlink($GalleryPath.$File);
						}		
					}					
					$sql = "DELETE FROM #__gallery WHERE gallery_id=".$galleryId;
					$db->setQuery($sql);
				}				
				
				$sql = "DELETE FROM #__404 WHERE type='testimonial' AND type_id=".$db->quote($testimonial_id);
				$db->setQuery($sql);
				
				$sql = "DELETE FROM #__testimonial WHERE id=".$db->quote($testimonial_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=testimonial');
		}
		
		function getUserForTestimonial()
		{
				global $db,$my;
				$post=IRequest::get("POST"); 
				$whereArray=array(); $Contacts=array();
				$userHint=$post["filter"]["filters"][0]["value"];
				
				if($userHint!=""):
					$whereArray[]="LOWER(name) LIKE '%".strtolower($userHint)."%'";
										
					$where=" WHERE ".implode(" AND ", $whereArray);
					$Query="SELECT uid as value, name as text, email, phone FROM #__users ".$where." ORDER BY uid DESC";
					$db->setQuery($Query);
					$Contacts = $db->LoadObjectList(); 
				endif;	
				return print_r(json_encode($Contacts)); exit;
		}	
		function getUserDetailsByName()
		{
			global $db,$my;
				$post=IRequest::get("POST"); 
				$Query="SELECT uid ,name, email, phone, address FROM #__users WHERE name =".$db->quote($post["name"]);
				$db->setQuery($Query);
				$UserINFO = $db->LoadObjectList(); 
			return print_r(json_encode($UserINFO[0])); exit;
		}
		
		function registerUser($post)
		{
			global $db,$my;
			$userWhere=array();
			if($post["client_email"]!="")
			$userWhere[]="email LIKE ".$db->quote(trim($post["client_email"]));
			
			if($post["client_phone"]!="")
			$userWhere[]="phone LIKE '%".trim($post["client_phone"])."%'";
			
			$where=" WHERE ".implode(" OR ",$userWhere);
			
			$Query="SELECT count(*) FROM #__users".$where;
			$db->setQuery($Query);
			$userCount = $db->getOne();
			
			if((int)$userCount > 0)
			{
				$Query="SELECT uid FROM #__users".$where;
				$db->setQuery($Query);
				$userID = $db->getOne();
			}
			else
			{
				$postArray = array (
													 'name'=>$post["client_name"],
													 'email'=>$post["client_email"],
													 'phone'=>$post["client_phone"],
													 'address'=>$post["client_address"],
													 'password'=> 'itcslive',
													 'status' => 1,
													 'sendmail' =>1,
													 'usertype' => 'registered',
													 'register_date' =>date('Y-m-d h:i'),
													 'refrer_id' =>$my->uid
												  );  
				  
			    $this->post = $postArray;
				parent::bind('users');
				parent::save();	
				$userID= $db->insertid();
			}
		
		return $userID;
		}
		
   }
?>