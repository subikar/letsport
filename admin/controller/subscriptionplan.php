<?php 
 
  class Subscriptionplan extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{	//echo "inside all drivers";exit;
			global $template; 
			$template->includejs('templates/itcslive/js/ourworks.js');
			$this->getworks();
			$template->display('header');
			$template->display('subscriptionplan/index');
			$template->display('footer');
	  	 }  
	  	function  getworks()
		{ 
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$searchTest = IRequest::getVar('search_txt');
			$Limit = ($Config->limit)?$Config->limit:20;
			if($searchTest != '')
			{
				$where = "WHERE start_location LIKE '%".$searchTest."%' OR end_location LIKE '%".$searchTest."%' OR vehicle_type LIKE '%".$searchTest."%' OR material_type LIKE '%".$searchTest."%' OR consignment_weight LIKE '%"
				.$searchTest."'%";
				
			} 
			else
			{
				$where = "";
				
			}
			
			$Query = "select count(*) from #__subscription_plan ".$where; 
			//echo $Query;exit;
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__subscription_plan ".$where." order by 	subscription_id desc";
			//echo $Query;exit;
			$db->setQuery($Query,$start,$Limit);
			$Splan = $db->loadObjectList();
			//print_r($Splan);exit;
			$template->assignRef('SubscriptionPlan',$Splan);
		}
		function addnew()	
		{
			global $template;
			$template->includejs('templates/itcslive/js/ourworks.js');
			$workID = IRequest::getInt("subscription_id");
			//echo $workID;exit;
			if((int)$workID >0)
			{
				$this->getworksdetails($workID);
			}
			$template->display('header');
			$template->display('subscriptionplan/addnew');
			$template->display('footer');
		}
		function getworksdetails($workID)
		{
			global $db,$template;
			$Query = "select *  from #__subscription_plan WHERE subscription_id=".(int)$workID;
			//echo $Query;exit; 
			$db->setQuery($Query);
			$Work = $db->loadObjectList();
			$Work=$Work[0];
			//print_r($Work);exit;
			if((int)$Work->gallery_id > 0)
			{
				$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$Work->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Work->gallery=unserialize($Data);
			}
			$template->assignRef('SubscriptionPlan',$Work);
		}
		function savepage()
		{
			  global $db, $template, $Config,$mainframe,$my;
			 
              $post = IRequest::get('POST');
			  $post['modified'] = date('Y-m-d h:i');
			  $UploadedFiles=$this->uplodeGallery();
			   //print_r ($post);//exit;
				if((int)$post["subscription_id"] > 0)
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
			 //echo "in save page"; exit;
					 $Query="UPDATE #__subscription_plan SET   subscription_name=".$db->quote($post['subscription_name']).",
													amount=".$db->quote($post['amount']).",
													bids_number=".$db->quote($post['bids_number']).", 
													status=".$db->quote($post['status'])."
													
													WHERE subscription_id=".$db->quote($post['subscription_id']);
					//echo $Query;exit;
					$db->setQuery($Query);	
				   }
				   else
				   {
				   		$InsertableFiles=serialize($UploadedFiles);
				   		$this->post = array("data"=>$InsertableFiles);
						parent::bind('gallery');
						parent::save();
						$post["image"]=$db->insertid();
					   	//echo "$post[gallery_id]";exit;
					   	$post['modified_id'] = $my->driver_id;
					   //	$post['status'] = 1;
					   	//$post['created_on'] = date('Y-m-d h:i');
						$this->post = $post;
						//print_r($this->post);exit;
						parent::bind('subscription_plan');
						parent::save();
						$driver_id=$db->insertid();
				  } 	
				if($post['Save_close'])
				{
			   	 	$mainframe->redirect('index.php?view=subscriptionplan');
				}
				else if($workID >0 )
				{
					$mainframe->redirect('index.php?view=subscriptionplan&task=addnew&subscription_id='.$post['subscription_id']);
				}
				else
				{
					$mainframe->redirect('index.php?view=subscriptionplan&task=addnew&subscription_id='.$post['subscription_id']);
				}
			}	
			
		function uplodeGallery()
		{
			global $db, $template, $Config,$mainframe;
			$nameArray=array();
			$img_path = IPATH_ROOT.'/images/gallery/';
			$files =  IRequest::getVar('image_upload', null, 'files', 'array');
			//print_r($files);exit;
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
		
		function Removework()
		{
			global  $db,$mainframe;
			$work_id=IRequest::getInt("subscription_id");
			if((int)$work_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__subscription_plan WHERE id=".$db->quote($work_id);
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
								
				$sql = "DELETE FROM #__subscription_plan WHERE subscription_id=".$db->quote($work_id);
				
				//echo $sql ;exit;
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=subscriptionplan');
		}
		
   }
?>