<?php 
error_reporting(0);
defined ('ITCS') or die ("Go away.");
  class Blog extends Master {
         var $test = NULL;
         function __construct()
		    {
			   parent::__construct();
			}
		function display()
		{
		
		}	
		 function GetBlogContents()
		   {
			    global $db, $template, $Config;
				$start = IRequest::getInt('start',0);
				$Limit = ($Config->limit)?$Config->limit:20; 
				$start = ($start * $Limit );
			  $Query = "select count(*) from #__blog as b 
			            Left Join #__404 as handler on b.id = handler.type_id  
			            Left Join #__users as u on b.author = u.uid  
			            Left Join #__category as c on b.category = c.id  
						where b.status = 1 AND handler.type='blog'";
				$db->setQuery($Query);
				$BlogCount = $db->getOne();
				//print($BlogCount); exit;
                $template->SetPaginationFront($BlogCount);
				
			  $Query = "select b.*, g.data, handler.seo, u.name, c.category_name from (#__blog as b 
			  			Left Join #__gallery as g on g.gallery_id=b.gallery_id)
			            Left Join #__404 as handler on b.id = handler.type_id  
			            Left Join #__users as u on b.author = u.uid  
			            Left Join #__category as c on b.category = c.id  
						where b.status = 1 AND handler.type='blog' order by b.created desc";
			  $db->setQuery($Query,$start,$Limit);
			  $Blogs = $db->loadObjectList();
			  //print_r($Blogs); exit;
			  include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
			  $Imageparams = array('width' =>210, 'height' =>179, 'rgb' => '0x000000', 'aspect_ratio' => false, 'crop' => false);	
				 foreach($Blogs as $blog):
				 if($blog->data!="" || $blog->data!=NULL):
					 $galleryInArray=array_values(unserialize($blog->data));
					 $file_path="images/gallery/".$galleryInArray[0];
							if(file_exists(IPATH_ROOT."/".$file_path))
							{
								
								$blog->gallery = Resizer::img_resize($file_path,$Imageparams,"cache/blog");
							}
				 endif;
				 endforeach;
			  return $Blogs;
		   }
		 function  GetBlogContentByID($blog_id) 
		   {
		       global $db; 
			   $blogDetails=array();
			  $Query = "select b.*,g.data, handler.seo, u.name, c.category_name from  (#__blog as b 
			  			Left Join #__gallery as g on g.gallery_id=b.gallery_id)
			            Left Join #__404 as handler on b.id = handler.type_id  
			            Left Join #__users as u on b.author = u.uid  
			            Left Join #__category as c on b.category = c.id  
						where b.status = 1 AND handler.type='blog' AND b.id=".$db->quote($blog_id);;
			  $db->setQuery($Query);
			  $Blog = $db->loadObjectList();
				
				if(isset($Blog[0]))
				{
					$Query="SELECT * FROM #__comment WHERE type='Blog' AND type_id=".$db->quote($blog_id);
					$db->setQuery($Query);
			  		$comment = $db->loadObjectList();
					$blogDetails["comments"]=$comment;
					$blogDetails["blog"]=$Blog[0];
				}
				
				return $blogDetails;
				
		   }
		 function WorkingonDB()
		   {
		      global $db; 
			  $Query = "select p.post_title, pm1.meta_value as keyword, pm2.meta_value as description, pm3.meta_value as title 
			            from #__posts as p 
			            left join #__postmeta as pm1 on p.ID = pm1.post_id 
			            left join #__postmeta as pm2 on p.ID = pm2.post_id 
			            left join #__postmeta as pm3 on p.ID = pm3.post_id 
						where p.post_type = 'page' AND p.post_status = 'publish' AND pm1.meta_key = '_aioseop_keywords' AND pm2.meta_key = '_aioseop_description' AND pm3.meta_key = '_aioseop_title'
						order by p.post_date";
			  $db->setQuery($Query);
			  $Blogs = $db->loadObjectList();
/*			  print_r($Blogs);
			  exit;*/
			  
			 // $Query = "Delete from #__404 WHERE type='page'";
			 // $db->setQuery($Query);
			  foreach($Blogs as $Blog)
			    {
				
						$query = "update #__page set `metakeyword` = ".$db->quote($Blog->keyword).', `metatitle`='.$db->quote($Blog->title).', `metadescription`='.$db->quote($Blog->description).' Where `title`='.$db->quote($Blog->post_title);
						$db->setQuery($query);
						//print_r($db); exit;
                      //  $ 				
				
/*				   $post = array (
				                     'title'=>$Blog->post_title,
									 'content'=>addslashes($Blog->post_content),    
									 'metadescription'=>$Blog->post_title,    
									 'metatitle'=>$Blog->post_title,    
									 'metakeyword'=>'',    
									 'status'=>1, 
									 'category'=>2,   
									 'created'=>$Blog->post_date,    
									 'modified'=>$Blog->post_modified,    
									 'author'=>$Blog->post_author,    
				                  );  
				  
			    $this->post = $post;
				parent::bind('page');
				parent::save();
				//print_r($db); exit;
				$id = $db->insertid();
			    $post = array (
								 'original'=>'page.php?id='.$id,
								 'seo'=>$Blog->post_name,
								 'type'=>'page',
								 'type_id'=>$id    
							  );  
				  
			    $this->post = $post;
				parent::bind('404');
				parent::save();*/
				}
		 echo "done";   
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
		  function createComment()
		  {
			global $db,$Config,$mainframe;
			$post=IRequest::get("POST"); 			
				if($post["captcha_code"]!=$_SESSION["captcha_code"])
				{
					exit;
				}
				
			$userWhere=array();
			if($post["email"]!="")
			$userWhere[]="email LIKE ".$db->quote(trim($post["email"]));
			
			if($post["phone"]!="")
			$userWhere[]="phone LIKE '%".trim($post["phone"])."%'";
			
			$where=" WHERE ".implode(" OR ",$userWhere);
			
			$Query="SELECT count(*) FROM #__users".$where;
			$db->setQuery($Query);
			$userCount = $db->getOne();
			if((int)$userCount > 1){ exit; }
			
			if((int)$userCount == 1)
			{
				$Query="SELECT uid FROM #__users".$where;
				$db->setQuery($Query);
				$userID = $db->getOne();
			}
			else
			{
					$postArray = array (
														 'name'=>$post["name"],
														 'email'=>$post["email"],
														 'phone'=>$post["phone"],
														 'password'=> 'itcslive',
														 'status' => 1,
														 'sendmail' =>1,
														 'usertype' => 'registered',
														 'register_date' =>date('Y-m-d h:i')
													  );  
				  
			    $this->post = $postArray;
				parent::bind('users');
				parent::save();	
				$userID= $db->insertid();
			}
			
			//Insert comment....
			unset($post["task"]); unset($post["view"]); unset($post["captcha_code"]);
			$post["user_id"]=$userID;
			$post["created"]=date('Y-m-d H:i');
			$post["modified"]=date('Y-m-d H:i');
			$post["status"]=1;
			
			 	$this->post = $post;
				parent::bind('comment');
				parent::save();	
			
			/*if($post["email"]!="")
			$this->SendRegistrationEmail($post);	*/
				
			$mainframe->redirect($_SERVER["SCRIPT_URI"]);		
		  }   
		  function SendRegistrationEmail($post)
		  {
		  		
		  
		  }  	
  }
?>