<?php 

class Signup extends Master {
	
    function display()
	  {
		global $db;
	  	$post=IRequest::get("GET");		  		  
		  $SetCondition = array();
			foreach($post as $key => $value)
			  {
			    $SetCondition[] = $key .'= "'.$value.'"';
			  }
			  
		$SetCondition = 'SET '.implode(', ',$SetCondition);
		$sql = 'INSERT INTO #__users '.$SetCondition;
		print_r($sql);exit;
		$db->SetQuery($sql); 
		$id = $db->loadObjectList();	
		print_r($id);exit;
		
		
	  }
	  
}
?>