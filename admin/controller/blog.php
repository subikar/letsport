<?php 
   class Blog extends Master
     { 
	     function __construct()
		   {
		        parent::__construct();
				//ini_set('display_errors', 0); 
				//error_reporting(0);
		   } 
		  function display()
		   {
		        global $template;
				$this->blogposts();
				$template->display('header');
				$template->display('blog/blog');
				$template->display('footer');
		   }
		  function addnew()
		   {
		        global $template;
				$template->includejs('templates/itcslive/js/blog.js');
				$BlogID=IRequest::getVar("blog_id", "");
				if($BlogID!="")
				{
				$this->getBlogdetails($BlogID);
				}
				$this->getCategories();
				$template->display('header');
				$template->display('blog/blogform');
				$template->display('footer');
		   }  
		   function getBlogdetails($BlogID)
		   {
		   global $db,$template;
			$Query = "select *  from #__blog WHERE id=".(int)$BlogID;
				$db->setQuery($Query);
				$Blogs = $db->loadObjectList();
				$Blogs=$Blogs[0];
				if((int)$Blogs->gallery_id > 0)
				{
				$SQL="SELECT data FROM #__gallery WHERE gallery_id=".(int)$Blogs->gallery_id;
				$db->setQuery($SQL);
				$Data = $db->getOne();
				$Blogs->gallery=unserialize($Data);
				}
				
				$SQL="SELECT seo FROM #__404 WHERE type='blog' AND type_id=".$db->quote($BlogID);
				$db->setQuery($SQL);
				$Blogs->alias = $db->getOne();	
				
				$template->assignRef('BlogData',$Blogs);
		   		
		   }
		   function getCategories()
		   {
		   		global $db,$template;
		   		$SQL= "SELECT id, category_name FROM #__category WHERE type LIKE 'post' AND status=1";
		   		$db->setQuery($SQL);
				$Category = $db->loadObjectList();
				$template->assignRef('Category',$Category);
		   }
		  function blogposts()
		   {
			    global $db, $template, $Config;
				
				$SearchText=IRequest::getVar("search_text","");
				if($SearchText!="")
				{
					$where="WHERE title LIKE '%".$SearchText."%' OR metadescription  LIKE '%".$SearchText."%'";
				}
				else
				{
					$where="WHERE 1";
				}
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				$start = $start * $Limit;
				$Query = "select count(id) from #__blog ".$where;
				$db->setQuery($Query);
				$BlogCount = $db->getOne();
                $template->SetPagination($BlogCount);
				
				$Query = "select id, title, status, created from #__blog ".$where." order by id desc";
				//print_r($Query); exit;
				$db->setQuery($Query,$start,$Limit);
				$Blogs = $db->loadObjectList();
				$template->assignRef('blogs',$Blogs);
		   
		   }
		   
		   function saveblog()
		  {
			 global $db, $template, $Config,$mainframe;
			  $post = IRequest::get('POST');
			  $content = IRequest::getVar('content','','POST','STRING',IREQUEST_ALLOWHTML);
			  $post['content']  = $content;
			  $post['modified'] = date('Y-m-d h:i');
			  $UploadedFiles=$this->uplodeGallery();
			   
				if((int)$post["blog_id"] > 0)
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
					 
					 $Query="UPDATE #__blog SET title=".$db->quote($post['title']).",
					  															content=".$db->quote($post['content']).",
																				metadescription=".$db->quote($post['metadescription']).", 
																				metatitle=".$db->quote($post['metatitle']).", 
																				metakeyword=".$db->quote($post['metakeyword']).", 
																				category=".$db->quote($post['category']).",
																				gallery_id=".$db->quote($post["gallery_id"]).",
																				modified=".$db->quote($post['modified'])." WHERE id=".$db->quote($post['blog_id']);
					$db->setQuery($Query);
					
					if($post["alias"] !="")
					 $seo=str_replace(" ","-",strtolower(trim($post["title"])));
					 else
					 $seo=$post["alias"];
						
					 $orgUrl="blog.php?id=".(int)$post['blog_id'];
					 
					 $SQL="UPDATE #__404 SET seo=".$db->quote($seo)." WHERE original LIKE ".$db->quote($orgUrl)." AND type LIKE 'blog' AND type_id =".$post['blog_id'];
					 $db->setQuery($SQL);
					 
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
						$this->post = $post;
						 parent::bind('blog');
						parent::save();
						$BlogID=$db->insertid();
						
					if($post["alias"] !="")
					  $seo=str_replace(" ","-",strtolower(trim($post["title"])));
					 else
					 $seo=$post["alias"];	
					
					 $orgUrl="blog.php?id=".(int)$BlogID;
					 
					 $this->post = array("original"=>$orgUrl,"seo"=>$seo, "type"=>'blog', "type_id"=>$BlogID, "hits"=>0);
                     parent::bind('404');
                     parent::save();
				  }
				  if($post['Save_close']) 
					$mainframe->redirect('index.php?view=blog');
				  else if($BlogID != '')
				  	$mainframe->redirect('index.php?view=blog&task=addnew&blog_id='.$BlogID);
				  else
				  	$mainframe->redirect('index.php?view=blog&task=addnew&blog_id='.$post['blog_id']);
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
			if((int)$post["blog_id"] > 0)
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["alias"]))." AND type!='blog' AND type_id NOT IN(".$db->quote($post["blog_id"]).")";
			}
			else
			{
				$where="WHERE LOWER(seo) LIKE ".$db->quote(strtolower($post["alias"]));
			}
			$SQL="SELECT count(*) FROM #__404 ".$where;
			//print_r($SQL); exit;
			$db->setQuery($SQL);
			$Data = $db->getOne();
			print_r((int)$Data); exit;
		}
		
		function RemoveBlog()
		{			
			global  $db,$mainframe;
			$blog_id=IRequest::getInt("blog_id");
			if((int)$blog_id > 0)
			{
				$sql = "SELECT gallery_id FROM #__blog WHERE id=".$db->quote($blog_id);
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
				
				$sql = "DELETE FROM #__404 WHERE type='blog' AND type_id=".$db->quote($blog_id);
				$db->setQuery($sql);
				
				$sql = "DELETE FROM #__blog WHERE id=".$db->quote($blog_id);
				$db->setQuery($sql);
			}
			$mainframe->redirect('index.php?view=blog');
		
		}		      
	 } 
?>