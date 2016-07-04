<?php 
 
  class Alltruck extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{	//echo "inside all truck";exit;
			global $template; 
			$template->includejs('templates/itcslive/js/ourworks.js');
			$this->getworks();
			$template->display('header');
			$template->display('alltruck/index');
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
			
			$Query = "select count(*) from #__truck ".$where; 
			//echo $Query;exit;
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__truck ".$where." order by 	truck_id desc";
			//echo $Query;exit;
			$db->setQuery($Query,$start,$Limit);
			$truck = $db->loadObjectList();
			//print_r($truck);exit;
			$template->assignRef('Trucks',$truck);
			
		}
		function addnew()	
		{
			global $template;
			$template->includejs('templates/itcslive/js/ourworks.js');
			$workID = IRequest::getInt("truck_id");
			//echo $workID ;exit;
			if((int)$workID >0)
			{
				$this->getworksdetails($workID);
			}
			$template->display('header');
			$template->display('alltruck/addnew');
			$template->display('footer');
		}
		function getworksdetails($workID)
		{
			global $db,$template;
			$Query = "select *  from #__truck WHERE truck_id=".(int)$workID;
			//echo $Query;exit;
			$db->setQuery($Query);
			$Work = $db->loadObjectList();
			$Work=$Work[0];
			//print_r($Work);exit;
			if((int)$Work->gallery_id > 0)
			{
				$SQL="SELECT data FROM #__truck WHERE gallery_id=".(int)$Work->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Work->gallery=unserialize($Data);
			}
			
			$template->assignRef('Trucks',$Work);
		}
		function savepage()
		{
			  global $db, $template, $Config,$mainframe,$my;
              $post = IRequest::get('POST');
			 // print_r($post);exit;
			  $post['modified'] = date('Y-m-d h:i');
			  $UploadedFiles=$this->uplodeGallery();
			   
				if((int)$post["truck_id"] > 0)
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
					 $Query="UPDATE #__truck SET truck_type=".$db->quote($post['truck_type']).",
													registration_no=".$db->quote($post['registration_no']).",
													chasis_no=".$db->quote($post['chasis_no']).", 
													engine_no=".$db->quote($post['engine_no']).",
													truck_registration_date=".$db->quote($post['truck_registration_date']).",
													insurance_date=".$db->quote($post["insurance_date"]).",
													truck_no=".$db->quote($post["truck_no"])."
													WHERE truck_id=".$db->quote($post['truck_id']);
					//echo $Query;exit;
					$db->setQuery($Query);	
				   }
				   else
				   {
				   		$InsertableFiles=serialize($UploadedFiles);
				   		$this->post = array("data"=>$InsertableFiles);
						parent::bind('gallery');
						parent::save();
						$post["truck_id"]=$db->insertid();
					   //	$post['modified_id'] = $my->id;
					  // 	$post['status'] = 1;
					   	$post['created_on'] = date('Y-m-d h:i');
						$this->post = $post;
						parent::bind('truck');
						parent::save();
						$workID=$db->insertid();
				  } 	
				if($post['Save_close'])
				{
			   	 	$mainframe->redirect('index.php?view=alltruck');
				}
				else if(truck_id >0 )
				{
					$mainframe->redirect('index.php?view=alltruck&task=addnew&truck_id='.$post['truck_id']);
				}
				else
				{
					$mainframe->redirect('index.php?view=alltruck&task=addnew&truck_id='.$post['truck_id']);
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
			if((int)$work_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__truck WHERE id=".$db->quote($work_id);
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
								
				$sql = "DELETE FROM #__truck WHERE subscriber_id=".$db->quote($work_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=truck');
		}
		
   }
?>