<?php 
class Param {
	   var $params = array();
	   function __construct($option)
	     {
		 	
		 }	
		function getParams($option)
		 {
				global $db;
				 if(!isset($this->params[$option])):
				$Query = "select data from #__params WHERE param_name LIKE ".$db->quote($option);
				$db->setQuery($Query);
				$paramvalue = $db->getOne();
				$this->params[$option]=($paramvalue!=NULL) ? json_decode($paramvalue,TRUE): array();
				endif;
				return $this->params[$option];
		  }       	 
}		 