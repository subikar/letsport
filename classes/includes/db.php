<?php 
  require_once('conf/config.php');
  class iFactory {
       var $resultset = NULL; 
	   var $sql = NULL;
	   var $error = NULL;
	   function __construct()
	     {
		     global $Config;  
		     $Config = new iTCSConfig();
			 //print($Config->hos)
			 mysql_connect($Config->host, $Config->user, $Config->pass) or die ('Error connecting to mysql');
			 mysql_select_db($Config->dbname);
			 
		 }
	   function setQuery($sql,$start = '',$end = '')
	     {
		    $this->sql =  $sql;
			if($end != '')
			  {
			       $this->sql = $this->sql . ' LIMIT '.$start.', '.$end;
			  }
			
		    $this->ConfigureTable(); 
		    $this->resultset = mysql_query($this->sql);
			$this->error = mysql_error();
			//print_r("ssss"); exit;

		 }
		function insertid()
		 {
		   $id = mysql_insert_id();
		   return $id;
		 }   
		function ConfigureTable()
		  {
		     global $Config;
			 
		     $this->sql = str_replace('#__',$Config->table,$this->sql);
			 //print($this->sql); exit;
		  } 
		function loadObjectList()
		 {
			  $data = array();	 
			 // print($this->resultset); exit;
			  while($row = mysql_fetch_object($this->resultset)):
			    $data[] = $row; 
			  endwhile;
		      return $data; 
		 }
		function getOne()
		  {
			  $row = mysql_result($this->resultset,0);
		      return $row; 
		  }  
		function quote($text, $escape = true)
		 {
		     return '\'' . ($escape ? $this->escape($text) : $text) . '\'';
		 }  
	   function escape($text, $extra = false)
	   {
	     return mysql_real_escape_string($text);
	   }  
  }
?>