<?php 
error_reporting(0);
  class Testimonials{
        function __construct()
		  {
		   	$this->getTestimonials();
			//$this->PopulateTestimonials();
		  }
		  function getTestimonials()
		  {
		      global $db,$template;
			 $Query="SELECT t.client_name,t.client_address,t.testimonial_content,t.website,g.data FROM `#__testimonial` as t LEFT JOIN #__gallery as g ON t.gallery_id=g.gallery_id ORDER BY t.id DESC LIMIT 0,4";
			  $db->setQuery($Query);
			  $testimonialsInArray = $db->loadObjectList();
			  
			  include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
			  $Imageparams = array('width' =>98, 'height' =>95);	
			  foreach($testimonialsInArray as $value):
			  if($value->data!="" || $value->data!=NULL):
					$galleryInArray=array_values(unserialize($value->data));
					$file_path="images/gallery/".$galleryInArray[0];
						if(file_exists(IPATH_ROOT."/".$file_path))
						{
							$value->gallery = Resizer::img_resize($file_path,$Imageparams,"cache/testimonial");
						}
				 endif;
			  endforeach;
			 
			  $template->assignRef('testimonialsInArray',$testimonialsInArray);
			  $template->display('modules/testimonials/index',0);
		  }
		  
		 /*  function PopulateTestimonials()
		  {
		  	global $db;
			 $Query="SELECT * FROM `#__posts` WHERE post_type LIKE 'testimonials-widget'";
			  $db->setQuery($Query);
			  $testimonialsInArray = $db->loadObjectList();
			  foreach($testimonialsInArray as $key=>$value):
			  $this->post = array("client_name"=>$value->post_title,"testimonial_content"=>$value->post_content,"created"=>$value->post_date,"modified"=>$value->post_modified,"status"=>1);
				parent::bind('testimonial');
				parent::save();
				
			  endforeach;
		  
		  	print_r($key); exit;
		  
		  }*/
		 
		  
  }
?>