<?php 
error_reporting(0);
  class Ongoingwork{
        function __construct()
		  {
		      $this->getOngoingWork();
		  }
		  
		  function getOngoingWork()
		  {
			   global $template,$db;
				$Query="SELECT w.*,g.data FROM #__ourworks as w LEFT JOIN #__gallery as g ON w.gallery_id=g.gallery_id WHERE status=1 order by w.id desc";
				$db->setQuery($Query,0,12);
				$worksInArray= $db->loadObjectList();
				
				include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
				$Imageparams = array('width' =>283);	
				 foreach($worksInArray as $work)
				 {
				 	if($work->data!=="" || $work->data!==NULL)
					{
						$galleryInArray=array_values(unserialize($work->data));
						//print_r($galleryInArray); exit;
						$file_path="images/gallery/".$galleryInArray[0];
						if(file_exists(IPATH_ROOT."/".$file_path))
						{
							$work->gallery = Resizer::img_resize($file_path,$Imageparams,"cache/ongoingwork");
						}
					}	
				 }
				 
			  $template->assignRef('worksInArray',$worksInArray);
			 $template->display('modules/ongoingwork/index',0);
		  }
  }
?>