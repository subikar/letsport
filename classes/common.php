<?php
   session_start();
   date_default_timezone_set("Asia/Kolkata");
   define('ITCS',1);
   include_once('includes/db.php');
   include_once('includes/request.php');
   include_once('includes/mainframe.php');
   include_once('includes/mail.php');
   //include_once('external/jsmin/jsmin.php');
   global $db,$my,$mainframe,$params;
   $db = new iFactory;
   $mainframe = new MainFrame();
   include_once('master.php');
   include_once('includes/templates.php');
   include_once('includes/param.php');
   $params= new Param();
   
   function includeclass($class)
     {
	     require_once('internal/'.$class.'.php');
		 $ClassName = ucfirst($class);
		 $obj = new $ClassName();
		 return $obj;
	 }
   function includemodule($modulename)
     {
	     require_once(IPATH_ROOT.DS.'classes/internal/modules/'.$modulename.'.php');
		 $ModuleName = ucfirst($modulename);
		 $obj = new $ModuleName();
		 return $obj;
	 }	 
   function SetSession()
    { 
	      global $db, $my; 
		  $Session   = session_id(); 
		  $IsSessionInCookie = IRequest::get('COOKIE');
		  //print_r($IsSessionInCookie); exit;
		  $Sessioncode = md5($Session); 
		  //$Sessioncode = 'country';
		  //print_r($IsSessionInCookie[$Sessioncode]); //exit;
		  if(!isset($IsSessionInCookie[$Sessioncode]))
		    {
			   //IRequest::setVar($Sessioncode,'1','COOKIE');
			   setcookie($Sessioncode,'1',time() + (86400 * 7));
			   $Query = "Insert into #__session SET session_id =".$db->quote($Sessioncode).', entered_on= NOW()';
			   $db->setQuery($Query);
			}
		  else
		    {
			    $Query = "select u.* from #__session as s left join #__users as u on s.user_id = u.uid WHERE s.session_id = ".$db->quote($Sessioncode);
			    $db->setQuery($Query);
				$my = $db->loadObjectList();
				$my = isset($my[0])?$my[0]:NULL;
			}
		    	
	}	  
 	 
   function Get404Original()
    {
	  global $Config,$db,$template,$ScriptUri,$my;
	  $server = IRequest::get('SERVER');
	  if(isset($server['SCRIPT_URI'])){
	   $ScriptUri = $server['SCRIPT_URI'];
	   }
	  else
	   { 
	      $ScriptUri = $server['REQUEST_URI'];
		  $ScriptUri = explode('/',$ScriptUri);
		  $ScriptUri = $ScriptUri[(count($ScriptUri) -1)];
		  $ScriptUri = $Config->site.$ScriptUri;
		  if(strpos($ScriptUri, "?"))
		    $ScriptUri = substr($ScriptUri, 0, strpos($ScriptUri, "?"));
		 
	   } 
	   //print_r($ScriptUri); exit;
	 // $ScriptUri = (isset($server['SCRIPT_URI']))?$server['SCRIPT_URI']:$server['REQUEST_URI'];
	 /// print_r($server); exit;
	  $template->assignRef('SCRIPT_URI',$ScriptUri); 				  
	  $view = IRequest::getVar('view','');
	  SetSession();
	 
	  if($view == '')
	    {
			  $ScriptUri = str_replace($Config->site,'',$ScriptUri);
			  $is_frontslash = substr($ScriptUri,-1);
			  if($is_frontslash == '/') {
			     $ScriptUri = rtrim($ScriptUri, "/");
			  }			  
			  $ScriptUri = ($ScriptUri == '' || $ScriptUri == 'index.php')?'home':$ScriptUri;
			 // print($ScriptUri); exit;
			/*  if($ScriptUri == 'home')
			    {
				  $template->TemplatePath = '/home/pritam/public_html/custom/itcslive/templates/itcslivenew/';
				}*/
		      //print_r($Config); exit; 
			  $query = "select * from `#__404` WHERE `seo` =".$db->quote($ScriptUri);
			 // print($query); exit;
			  $db->setQuery($query);
			  $UrlData =  $db->loadObjectList();
			  $UrlData =  isset($UrlData[0])?$UrlData[0]:'nopage';
			// print_r($UrlData); exit;
			  if($UrlData == 'nopage')
			    {
				  $ScriptUri = 'nopage';
				  $query = "select * from `#__404` WHERE `seo` =".$db->quote($ScriptUri);
				 // print($query); exit;
				  $db->setQuery($query);
				  $UrlData =  $db->loadObjectList();
				  $UrlData =  $UrlData[0];
				}
			 // print_r($UrlData); exit;
			  $Original = $UrlData->original;
			  $Original =  explode('?',$Original);
			  $File = $Original[0];
			  $Arguments = (isset($Original[1]))?explode('&',$Original[1]):array();
			  $template->assignRef('site',$Config->site);
			  if(count($Arguments) > 0)
				{
				  foreach($Arguments as $Argument)
					  {
						 $keyValue = explode('=',$Argument);
						 IRequest::setVar($keyValue[0],$keyValue[1],'POST');
						 //print_r($keyValue); exit;
					  }
				}  
			 $is_home = ($ScriptUri == 'home')?1:0; 	  
			 $template->assignRef('is_home',$is_home);
			 $view = IRequest::getVar('view','');
			// print_r($view); exit;
			 if($view != '' && $view == 'login')
			   includeclass($view);
			 else
			  {
				 if($ScriptUri == 'home')	  
					include_once($File);
				 else
					include_once('../'.$File);
			   }	
	  }
	 else
	  {
	      //print("subikar"); exit;
	      includeclass($view);
	  }  	
	   	
	} 	 


?>