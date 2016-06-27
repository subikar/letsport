<?php 
  class Page extends Master {
         function __construct()
		   {
		        
			    parent::__construct();
			  
		   }
		  function display()
		   {
		        global $template; 
				$template->includejs('templates/itcslive/js/page.js');
				
				$this->getpages();
				$template->display('header');
				$template->display('page/page');
				$template->display('footer');
		   }  
		  function  getpages()
			{
			    global $db, $template, $Config;
				$searchBy=IRequest::getVar("title_text","");
				if($searchBy!="")
				{
					$where=" WHERE title LIKE '%".$searchBy."%' OR metadescription LIKE '".$searchBy."' OR metatitle LIKE '%".$searchBy."%'";
				}
				else
				{
					$where=" WHERE 1";
				}
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				$start = $start * $Limit;
				$Query = "select count(*) from #__page".$where;
				$db->setQuery($Query);
				$PageCount = $db->getOne();
                $template->SetPagination($PageCount);
				
				$Query = "select *  from #__page".$where." order by id desc";
				$db->setQuery($Query,$start,$Limit);
				$Pages = $db->loadObjectList();
				$template->assignRef('pages',$Pages);
			}
		 function addnew()	
		    {
			    global $template;
				$template->includejs('templates/itcslive/js/page.js');
				$PageID=IRequest::getVar("page_id", "");
				if($PageID!="")
				{
				$this->getPagedetails($PageID);
				}
				$template->display('header');
				$template->display('page/addnew');
				$template->display('footer');
			}
		function getPagedetails($PageID)
		{
			global $db,$template;
			$Query = "select *  from #__page WHERE id=".(int)$PageID;
				$db->setQuery($Query);
				$Pages = $db->loadObjectList();
				$Pages=$Pages[0];
				$SQL="SELECT seo FROM #__404 WHERE type='page' AND type_id=".$db->quote($PageID);
				$db->setQuery($SQL);
				$seo = $db->getOne();
				$Pages->alias=$seo;
				
				if((int)$Pages->gallery_id > 0)
				{
				$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$Pages->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Pages->gallery=unserialize($Data);
				}
				
				$template->assignRef('pageData',$Pages);
		}
		function savepage()
		{
			  global $db, $template, $Config,$mainframe;
			  //print_r($_POST); exit;
              $post = IRequest::get('POST');
			  $content =IRequest::getVar('content','','POST','STRING',IREQUEST_ALLOWHTML);
			  $jsscript =IRequest::getVar('jsscript','','POST','STRING',IREQUEST_ALLOWRAW);
			 // $content =preg_replace("/&#?[a-z0-9]+;/i","",$content ); 
			  //print_r($content); exit;
			 $post['content']=$content ;
			  $post['modified'] = date('Y-m-d h:i');
			  $UploadedFiles=$this->uplodeGallery();
			   
				if((int)$post["page_id"] > 0)
				{
				   $removeFiles= IRequest::getVar("remove_gallery");
				  
					if(count($UploadedFiles) > 0 || count($removeFiles) > 0 ) 
					{
						$Data="";
						if((int)$post["gallery_id"] > 0)
						{
							$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$post["gallery_id"];
							$db->setQuery($SQL);
							$Data = $db->getOne();
						}
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
					
					 $Query="UPDATE #__page SET title=".$db->quote($post['title']).",
												content='".mysql_real_escape_string($post['content'])."',
												metadescription=".$db->quote($post['metadescription']).", 
												metatitle=".$db->quote($post['metatitle']).", 
												metakeyword=".$db->quote($post['metakeyword']).", 
												jsscript=".$db->quote($jsscript).", 
												gallery_id=".$db->quote($post["gallery_id"]).",
												modified=".$db->quote($post['modified']).",
												pageclass=".$db->quote($post['pageclass']).",
												isfullpage=".$db->quote($post['isfullpage'])."
												WHERE id=".$db->quote($post['page_id']);
					$db->setQuery($Query);
					//print_r($Query); exit;
					//print_r($db); exit;
					if($post["alias"]=="")
					{	
					 	$seo=str_replace(" ","-",strtolower(trim($post["title"])));
					 }
					 else
					 {
					 	$seo=trim($post["alias"]);
					 }
					 $orgUrl="page.php?id=".(int)$post['page_id'];
					 
					 $SQL="UPDATE #__404 SET seo=".$db->quote($seo)." WHERE original LIKE ".$db->quote($orgUrl);
					 $db->setQuery($SQL);
					 $PageID=(int)$post['page_id'];
				   }
				   else
				   {
				   		if(count($UploadedFiles) > 0)
						{
							$InsertableFiles=serialize($UploadedFiles);
							$this->post = array("data"=>$InsertableFiles);
							parent::bind('gallery');
							parent::save();
							$post["gallery_id"]=$db->insertid();
					    }
					    else
					    {
					   		$post["gallery_id"]=0;
					    }
					   $post['status'] = 1;
					   $post['created'] = date('Y-m-d h:i');
					   $post['content']  = $content;
						$this->post = $post;
						 parent::bind('page');
						 parent::save();
						$PageID=$db->insertid();
						
					 $seo=trim($post["alias"]);
					 $orgUrl="page.php?id=".$PageID;
					 $this->post = array("original"=>$orgUrl,"seo"=>$seo, "hits"=>0, "type"=>'page', "type_id"=>$PageID);
                     parent::bind('404');
                     parent::save();
					// print_r($db); exit;
				  } 
				if(isset($post["Save"]))
				$mainframe->redirect('index.php?view=page&task=addnew&page_id='.$PageID);
				else
			   $mainframe->redirect('index.php?view=page');
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
			if((int)$post["page_id"] > 0)
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["alias"]))." AND type!='page' AND type_id NOT IN(".$db->quote($post["page_id"]).")";
			}
			else
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["alias"]));
			}
			$SQL="SELECT count(*) FROM #__404 ".$where;
			$db->setQuery($SQL);
			$Data = $db->getOne();
			
			print_r((int)$Data); exit;
		}
		
		function RemovePage()
		{
			 global  $db,$mainframe;
			$page_id=IRequest::getInt("page_id");
			if((int)$page_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__page WHERE id=".$db->quote($page_id);
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
				
				$sql = "DELETE FROM #__404 WHERE type='page' AND type_id=".$db->quote($page_id);
				$db->setQuery($sql);
				
				$sql = "DELETE FROM #__page WHERE id=".$db->quote($page_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=page');
		}
		
   }
?>