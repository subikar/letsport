<?php 
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	class Ourworks extends Master 
	{
        function __construct()
		{
			parent::__construct();
		}
		function display()
		{
			global $template,$Config;	
			//print("subikar"); exit;
			$start = IRequest::getInt('start',1);
			$Config->limit = 12;
			$Limit = ($Config->limit)?$Config->limit:20; 
			$Start = ($start-1) * $Limit;
			$workCount=$this->getWorkCount();
			$template->SetPaginationFront($workCount);
			$workList=$this->getAllWorks($Start,$Limit);
			$template->assignRef('workList',$workList);
		}

        function search()
		 {

		 }


	function openpopup() 
		{
			global $template;
			$workID = IRequest::getInt('workID');
			$workDetails=$this->getWorkById($workID);
			$template->assignRef('workDetails',$workDetails);
		}
		function description($workID)
		{
			global $template;
			$workID = IRequest::getInt('workID');
			$workDetails=$this->getWorkById($workID);
			if($workDetails->data!=="" || $workDetails->data!==NULL)
			{
				include_once(IPATH_ROOT."/classes/external/priyaTools/resizer.php");
				$Imageparams = array('width' =>430);	
				$galleryInArray=array_values(unserialize($workDetails->data.json_encode($Imageparams)));
				$file_path="images/gallery/".$galleryInArray[0];
				if(file_exists(IPATH_ROOT."/".$file_path))
				{
					$workDetails->gallery = Resizer::img_resize($file_path,$Imageparams,"cache/ongoingworkbig");
				}
			}	
			$template->assignRef('workDetails',$workDetails);
		}
		function getWorkById($workID)
		{
			global $db;
			$sql = "SELECT w.*,g.data FROM #__ourworks as w LEFT JOIN #__gallery as g ON w.gallery_id=g.gallery_id WHERE w.id=".$db->quote($workID);
			$db->setQuery($sql);
			$ProjectDetails = $db->loadObjectList();
			$singleWork = $ProjectDetails[0];
			return $singleWork;
		}
		function getAllWorks($Start=0, $Limit=12)
		{
			global $db,$template,$my;
			
			/* to check if bids enough to submit quote*/
			$where=' WHERE s.subscription_id IS NOT NULL AND s.owner='.$my->uid;
			$Query="SELECT s.*, sp.* FROM #__subscription_plan as sp LEFT JOIN #__subscriber as s ON s.subscription_id=sp.subscription_id ".$where." ORDER BY s.subscription_id DESC";
			$db->setQuery($Query);
			$Subscriber = $db->LoadObjectList();			
			$template->assignRef('Subscriber',$Subscriber);
			/* to check if bids enough to submit quote*/
			
			
			
			
			$post = IRequest::get('POST');
			//print_r($post);//exit;
			$type = IRequest::getVar('type','truck');
			//print_r($type);exit;
			$template->assignRef('type',$type);
			
			$Where = array();
			
			$Where[] = 'w.status=1';
            if($post['start_location'] != '')
			  {
			     $Where[] = 'w.start_location LIKE '.$db->quote('%'.$post['start_location'].'%');
			  }			
				 
			if($post['end_location'] != '')
			  {
			     $Where[] = 'w.end_location LIKE '.$db->quote('%'.$post['end_location'].'%');
			  }			
			
			if($post['consignment_weight'] != '')
			  {
			     $Where[] = 'w.consignment_weight LIKE '.$db->quote('%'.$post['consignment_weight'].'%');
			  }

				if($post['avaliable_date'] != '')
			  {
			     $Where[] = 'w.avaliable_date LIKE '.$db->quote('%'.$post['avaliable_date'].'%');
			  }
				
			if($type != '')
			  {
			     $Where[] = 'w.operation_type LIKE '.$db->quote($type);
			  }
			$Where = ' WHERE '.implode(' AND ',$Where);
			$Query="SELECT w.*,u.* FROM #__ourworks as w LEFT JOIN #__users as u ON w.owner_id = u.uid $Where order by w.id ".$post[order];
			//echo $Query; exit;
			$db->setQuery($Query,$Start,$Limit);
			$worksInArray= $db->loadObjectList();
		    return $worksInArray;
			
			
			
		}
		function getWorkCount()
		{
			global $db;	
			$Query = "SELECT count(*) FROM #__ourworks WHERE status=1";
			$db->setQuery($Query);
			$Count = $db->getOne();
			return $Count;
		}
		
	}		
?>