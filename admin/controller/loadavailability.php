<?php 
 
  class loadavailability extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{	
			global $template; 
			$template->includejs('templates/itcslive/js/ourworks.js');
			$this->getworks();
			$template->display('header');
			$template->display('loadavailability/index');
			$template->display('footer');
	  	 }  
	  	function  getworks()
		{ 
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$searchTest = IRequest::getVar('search_txt');
			$post=IRequest::get('POST');
			$Limit = ($Config->limit)?$Config->limit:20;
			
			$Where = array();
			$Where[] = "operation_type =".$db->quote('load');
            if($post['start_location'] != '')
			  {
			      $Where[] = "start_location =".$db->quote($post['start_location']);
			  	
			  } 			
			
            if($post['end_location'] != '')
			  {
			      $Where[] = "end_location =".$db->quote($post['end_location']);
			  	
			  } 			
			$Where = (count($Where) > 0)? 'Where '.implode(' AND ',$Where):'';
			
			
			$Query = "select count(*) from #__ourworks ".$Where; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__ourworks ".$Where." order by id desc";
			//echo $Query;exit; 
			$db->setQuery($Query,$start,$Limit);
			$works = $db->loadObjectList();
			//print_r($db); exit;
			$template->assignRef('Works',$works);
		}
		function addnew()	
		{
			 
			global $template,$db;
			
			$Query = "select uid,name from #__users ";
			 
			$db->setQuery($Query);
			$owner_id = $db->loadObjectList();
			
			$ownerid = array();
			foreach($owner_id as $oid)
		  {
		  	
		    $ownerid[$oid->uid] = $oid->name;
			//$ownerid[$oid->uid] = $oid->uid; 
		  }
		 
			$template->assignRef('Owner_id',$ownerid);
			
			$template->includejs('templates/itcslive/js/ourworks.js');
			$workID = IRequest::getInt("work_id");
			if((int)$workID >0)
			{
				$this->getworksdetails($workID);
			}
			$template->display('header');
			$template->display('loadavailability/addnew');
			$template->display('footer');
			
			
			
		}
		function getworksdetails($workID)
		{
			global $db,$template;
			$Query = "select *  from #__ourworks WHERE id=".(int)$workID;
			$db->setQuery($Query);
			$Work = $db->loadObjectList();
			$Work=$Work[0];
			if((int)$Work->gallery_id > 0)
			{
				$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$Work->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Work->gallery=unserialize($Data);
			}
			$template->assignRef('WorkData',$Work);
		}
		function savepage()
		{
			  global $db, $template, $Config,$mainframe,$my;
              $post = IRequest::get('POST');
			  
			  $post['modified'] = date('Y-m-d h:i');
			  $UploadedFiles=$this->uplodeGallery();
			   
				if((int)$post["work_id"] > 0)
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
					 $Query="UPDATE #__ourworks SET start_location=".$db->quote($post['start_location']).",
													end_location=".$db->quote($post['end_location']).",
													avaliable_date=".$db->quote($post['avaliable_date']).", 
													vehicle_type=".$db->quote($post['vehicle_type']).",
													reporting_time=".$db->quote($post['reporting_time']).",
													material_type=".$db->quote($post["material_type"]).",
													consignment_weight=".$db->quote($post["consignment_weight"]).",
													owner_id=".$db->quote($post["name"]).",
													modified_id=".$my->id.",
													modified=".$db->quote($post['modified'])." 
													WHERE id=".$db->quote($post['work_id']);
					$db->setQuery($Query);	
				   }
				   else
				   {
				   		$InsertableFiles=serialize($UploadedFiles);
				   		$this->post = array("data"=>$InsertableFiles);
						parent::bind('gallery');
						parent::save();
						$post["gallery_id"]=$db->insertid();
					   	$post['modified_id'] = $my->id;
					   	$post['status'] = 1;
						$post['owner_id'] = $post['name'];
					   	$post['created_on'] = date('Y-m-d h:i');
						$this->post = $post;
						parent::bind('ourworks');
						parent::save();
						$workID=$db->insertid();
				  } 	
				if($post['Save_close'])
				{
			   	 	$mainframe->redirect('index.php?view=loadavailability');
				}
				else if($workID >0 )
				{
					$mainframe->redirect('index.php?view=loadavailability&task=addnew&work_id='.$workID);
				}
				else
				{
					$mainframe->redirect('index.php?view=loadavailability&task=addnew&work_id='.$post['work_id']);
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
		
		function Removework()
		{
			global  $db,$mainframe;
			$work_id=IRequest::getInt("work_id");
			//echo $work_id;exit;
			if((int)$work_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__ourworks WHERE id=".$db->quote($work_id);
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
								
				$sql = "DELETE FROM #__ourworks WHERE id=".$db->quote($work_id);
				$db->setQuery($sql);
			}
			//echo "before redirect";exit;
			$mainframe->redirect('index.php?view=loadavailability');
		}
		
   }
?>