<?php 
  class Master {
     var $Fields = NULL;
	 var $table  = NULL;
	 var $post   = NULL;
	 var $Where  = NULL;
     function __construct()
	   {
	      $task = IRequest::getString('task','display');
	      $this->$task();
	   } 
	 function bind($table)
	   {
	     global $db;
		 $this->table = '#__'.$table;
		 $this->post = IRequest::get("POST");
		 $post = $this->post;
		// print_r($_POST); exit;
		 $Query = "SHOW COLUMNS FROM ".$this->table;
		 $db->setQuery($Query);
		 $Fields = $db->loadObjectList();
		 //print_r($Fields); exit;
		 $data = array();
		 foreach($Fields as $Field)
		   {
		       if(isset($post[$Field->Field])) 
		         $data[$Field->Field] = $post[$Field->Field];
		   }
		 $this->Fields = $data;  
	   }
	 function save()
	   {
	       global $db;
	       $SetQuery = array(); 
	       foreach($this->Fields as $key=>$value)
		     {
			    $SetQuery[] = '`'.$key.'`='.$db->quote($value); 
			 } 
	      $SetQuery = ' SET '.implode(',',$SetQuery);   
		  $Query  = 'INSERT into '.$this->table.$SetQuery;
		 // echo $Query;exit;
		  $db->setQuery($Query);
	   }  
	 function update()
	   {
	       global $db;
	       $SetQuery = array(); 
	       foreach($this->Fields as $key=>$value)
		     {
			    $SetQuery[] = '`'.$key.'`='.$db->quote($value); 
			 } 
	      $SetQuery = ' SET '.implode(',',$SetQuery);   
		  $Query  = 'UPDATE '.$this->table.$SetQuery.' WHERE '.$this->Where;
		  //print_r($Query); exit;
		  $db->setQuery($Query);
	   }  

	  function logout()
	   {
		  global $db,$mainframe,$Config;
		   $session_id = md5(session_id()); 
		   $Query = "update #__session SET user_id= 0 WHERE session_id =".$db->quote($session_id);
		   $db->setQuery($Query);
		   $mainframe->redirect($Config->site);
			   
	   }
	  function Pagination()
	   {
	       global $Config;
	   }
	
  }
?>