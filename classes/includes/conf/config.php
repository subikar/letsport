<?php 
defined ('ITCS') or die ("Go away.");
ini_set("display_error",1);
class iTCSConfig {
       var $dbname   = 'dbletsport';
	   var $user = 'subikar';
	   var $pass = 'itcslive';
	   var $host = 'localhost'; 
	   var $site = 'http://192.168.9.100/custom/letsport/'; 
	   var $siteTemplate = 'http://192.168.9.100/custom/letsport/templates/itcslive/'; 
	   var $templatepath = '/home/subikar/html/custom/letsport/templates/itcslive/';
	   var $table = 'axe_';
	   var $limit = 10;
	   var $EnableJsCompression = false;
	   var $EnableCssCompression = false;
	   var $CacheEnable = false;
}
?>
