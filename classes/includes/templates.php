<?php
defined ('ITCS') or die ("Go away.");
  Class TemplateEngine extends Master {
         
		 var $TemplatePath = NULL;
		 var $Js = array();
		 var $css = array();
		 var $MinifyJS = array();
		 var $priority = 0;
		 var $csspriority = 0;
		 var $cache = 0;
		 var $compress = 0;
		 var $customjs = NULL;
		 function __construct()
		   {
		      global $Config;
		      $this->TemplatePath = $Config->templatepath;
		   }
		 function includejs($jspath,$priority = '',$minify=0)
		   {
		      $this->priority = ($priority != '' && $this->priority < $priority)?$priority:$this->priority; 
		      $this->Js[] = array(
			                      'text'=>'<script src="'.$jspath.'"></script>
								  ',
					              'priority'=>$priority,
								  'url'=>$jspath,
								  'minify'=>$minify
					             );
								 
			 	
		   }  
		 function includecss($csspath,$priority = '',$minify=0)
		   {
		      $this->css[] = array(
			                      'text'=>'<link rel="stylesheet" href="'.$csspath.'" type="text/css" />
								  ',
					              'priority'=>$priority,
								  'url'=>$csspath,
								  'minify'=>$minify
					             );
		   } 
		 function HeadCss ()
		   {
		      global $Config;
		     //print_r($this->css); exit;
		     foreach($this->css as $key => $css)
			   {
			     if($this->css[$key]['priority'] == '')
				   {
				     $this->priority = $this->priority + 1;
				     $this->css[$key]['priority'] = $this->priority; 
				   } 	 
			   }
			 $Newcss = $this->sksort($this->css,'priority',SORT_DESC); 
			//print_r($Config); exit; 
             if($Config->EnableCssCompression == true)
			   {  
					 
					 $CacheCssFile = 'cache/css'.DS.md5(json_encode($Newcss)).'.css';
					 if(!is_dir(IPATH_ROOT.DS.'cache/css'))
					   mkdir(IPATH_ROOT.DS.'cache/css');
					   
					 if(!file_exists(IPATH_ROOT.DS.$CacheCssFile))
					   {
							 $content = '';
							 $fp = fopen(IPATH_ROOT.DS.$CacheCssFile, 'w') or die("Unable to open file!");
							 foreach($Newcss as $css)
							   {
								    $handle = fopen(IPATH_ROOT.DS.$css['url'],'r'); 
									$content = fread($handle, filesize(IPATH_ROOT.DS.$css['url']));
									$content = str_replace('../../images',$Config->siteTemplate.'images',$content);
									$content = str_replace('../images',$Config->siteTemplate.'images',$content);
									$content = str_replace('fonts',$Config->siteTemplate.'css/fonts/',$content);
									//$content = str_replace(' ','',$content);
									//$content = str_replace('../images',$config->siteTemplate.'images/',$content);
									fclose($handle);
									fwrite($fp, PHP_EOL);
									fwrite($fp, $content);
							   }
							  fclose($fp);	 
							 //print(IPATH_ROOT.DS.$CacheJSFile);   
							 //fwrite(IPATH_ROOT.DS.$CacheJSFile, $content,'W');  
						 }	
						echo '<link rel="stylesheet" href="'.$Config->site.$CacheCssFile.'" type="text/css" />';	    
				}
			else
			  {
			              //print_r($Newcss); exit;
							 foreach($Newcss as $css)
								echo $css['text'];
			  }			
		   }
		 function CreateCustomeJS()
		   {
		   
		     if($this->customjs != NULL)
			   {
					 $server = IRequest::get('SERVER');
					 $ScriptUri = $server['REQUEST_URI'];
					 $CacheJSFile = 'cache/js'.DS.md5($ScriptUri).'.js';
					 if(!is_dir(IPATH_ROOT.DS.'cache/js'))
					   mkdir(IPATH_ROOT.DS.'cache/js');
					   
					 if(!file_exists(IPATH_ROOT.DS.$CacheJSFile))
					   {
							 $fp = fopen(IPATH_ROOT.DS.$CacheJSFile, 'w') or die("Unable to open JS file!");
							 fwrite($fp, $this->customjs);
							 fclose($fp);
							 
		               } 
					 $this->includejs($CacheJSFile);	   
			   }
		   }  
		 function HeadJs ()
		   {
		      global $Config;
		      //print($this->priority); exit;
			 $this->CreateCustomeJS(); 
		     foreach($this->Js as $key => $js)
			   {
			     if($this->Js[$key]['priority'] == '')
				   {
				     $this->priority = $this->priority + 1;
				     $this->Js[$key]['priority'] = $this->priority; 
				   } 	 
			   }
			   
			 $NewJs = $this->sksort($this->Js,'priority',SORT_DESC);  
             if($Config->EnableJsCompression == true)
			   {  
					 
					 $CacheJSFile = 'cache/js'.DS.md5(json_encode($NewJs)).'.js';
					 if(!is_dir(IPATH_ROOT.DS.'cache/js'))
					   mkdir(IPATH_ROOT.DS.'cache/js');
					   
					 if(!file_exists(IPATH_ROOT.DS.$CacheJSFile))
					   {
							 $content = '';
							 $fp = fopen(IPATH_ROOT.DS.$CacheJSFile, 'w') or die("Unable to open file!");
							 foreach($NewJs as $js)
							   {
								    $handle = fopen(IPATH_ROOT.DS.$js['url'],'r'); 
									$content = fread($handle, filesize(IPATH_ROOT.DS.$js['url']));
									fclose($handle);
									fwrite($fp, PHP_EOL);
									fwrite($fp, $content);
							   }
							  fclose($fp);	 
							 //print(IPATH_ROOT.DS.$CacheJSFile);   
							 //fwrite(IPATH_ROOT.DS.$CacheJSFile, $content,'W');  
						 }	
						echo '<script src="'.$Config->site.$CacheJSFile.'"></script>';	    
				}
			else
			  {
							 foreach($NewJs as $js)
								echo $js['text'];
			  }			
		   }

			function sksort($array, $subkey="id", $sort_ascending=false) {
			
				if (count($array))
					$temp_array[key($array)] = array_shift($array);
			
				foreach($array as $key => $val){
					$offset = 0;
					$found = false;
					foreach($temp_array as $tmp_key => $tmp_val)
					{
						if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
						{
							$temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
														array($key => $val),
														array_slice($temp_array,$offset)
													  );
							$found = true;
						}
						$offset++;
					}
					if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
				}
			
				if ($sort_ascending) $array = array_reverse($temp_array);
			
				else $array = $temp_array;
				return  $array;
			}
		      
		 function assignRef($key,$value)
		   {
			  if(is_string($key) && substr($key, 0, 1) != '_')
				{
					$this->$key = $value;
					return true;
				}
		      return false;		      
           }
		 function CheckCache()
		   {
/*		     if($config->CacheEnable == false)
			   {
			      return 'no';
			   }*/
                          return 'no';
			 $post = IRequest::get('POST');
			 if(count($post) > 1)
			   {
			     return 'no';
			   }  
		     $server = IRequest::get('SERVER');
			 $ScriptUri = $server['REQUEST_URI'];
			 $filename = IPATH_ROOT.DS.'cache/html/'.md5($ScriptUri).'.ini';
             if(file_exists($filename))
			   {
					$handle = fopen($filename,'r'); 
					$content = fread($handle, filesize($filename));
					fclose($handle);
					echo $content;
					return 'cache';			     
			   }
			 else    
		       return 'no';
		   }  
		 function SetCache($content,$cache=1)
		   {
             global $config, $my; 
			 //print_r($config); exit; 
		     if($this->cache == 1 && $my->uid <= 0)
			   {
				 if(!is_dir(IPATH_ROOT.DS.'cache/html'))
				   mkdir(IPATH_ROOT.DS.'cache/html');			   
				 $server = IRequest::get('SERVER');
				 $ScriptUri = $server['REQUEST_URI'];
				 $filename = IPATH_ROOT.DS.'cache/html/'.md5($ScriptUri).'.ini';
				 $fp = fopen($filename, 'a') or die("Unable to open file!");
				// $content = fread($fp, filesize($filename)).$content;
				 fwrite($fp, $content);
				 fclose($fp);
			   }

			   
			 echo $content;
		   }  
		 function display($file,$cache=1)
		   {
		       global $my;  
			   ob_start(); 
		       include($this->TemplatePath.$file.'.php');
			   $content = ob_get_contents();
			   //$content = $this->sanitize_output($content);
			   ob_end_clean();
			   if($cache == 0)
			     echo $content;
			   else 	 
			     $this->SetCache($content);
			   
		   }
			function sanitize_output($buffer) {
			
			if($this->compress == 1)
			  {
				$search = array(
					'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
					'/[^\S ]+\</s',  // strip whitespaces before tags, except space
					'/(\s)+/s'       // shorten multiple whitespace sequences
				);
			
				$replace = array(
					'>',
					'<',
					'\\1'
				);
			
				$buffer = preg_replace($search, $replace, $buffer);
			  }
				return $buffer;
			}
		   
		  function menu($menualias)
		   {
		     global $db,$template;
			 $Query = "select * from #__menu WHERE parent =( select id from #__menu WHERE alias = ".$db->quote($menualias)." ) AND status = 1 order by ordering asc";
			 $db->setQuery($Query);
			 $MenuInArray = $db->loadObjectList();
			// print_r($MenuInArray); exit;
			 if($menualias=="top-menu"):
				 foreach($MenuInArray as $values):
					$Query="SELECT * FROM #__menu WHERE parent=".$db->quote($values->id)." AND status = 1";
					$db->setQuery($Query);
					$subMenuInArray = $db->loadObjectList();
					$values->submenu=$subMenuInArray;
				 endforeach;
			 endif;
			 $this->assignRef('MenuInArray',$MenuInArray);
			 $this->assignRef('MenuID',$menualias);
			 $this->display('menu',0);
		   }
		  function SetPagination($count,$template = 'pagination/index')
		   {
		      global $Config;
			   $view = IRequest::getString('view');
			   $view = ($view != '')?'view='.$view:'';
			   $task = IRequest::getString('task'); 
			   $task = ($task != '')?'task='.$task:'';
			   $Uri = 'index.php?'.$view.$task;
			  
			   $Pagination = '';
			   
			   if($count > $Config->limit)
			     {
					   $limit = $Config->limit;
					   $NumberOfPage = (floor($count/$limit) == ($count/$limit)) ? ($count/$limit) : (floor($count/$limit)) +1;
					
					   $currentPage = IRequest::getInt('start',1);
					   $pageInArray = array();
					
					   $k=0;
					   $pageInArray[$k]['title'] = 'First';
					   $pageInArray[$k]['link']=$Uri;
					   $pageInArray[$k]['enable']=1;
					   $pageInArray[$k]['active']=0;
					   $k++;
					   
					    $pageInArray[$k]['title'] = '&lt;&lt; Prev';
					   if($currentPage >1):
					   $pageInArray[$k]['link']=$Uri."&start=".($currentPage-1);
					   $pageInArray[$k]['enable']=1;
					   else:
					    $pageInArray[$k]['link']=$Uri;
					   $pageInArray[$k]['enable']=0;
					   endif;
					   $pageInArray[$k]['active']=0;
					   $k++; 
					   
					   for($i=1; $i<=$NumberOfPage;$i++)
						{
							if($i >($currentPage + 2) || ($i+2) < $currentPage){
							continue;
							}
						
						 	$pageInArray[$k]['title'] = $i;
							$pageInArray[$k]['enable']=1;
						     if($i == 1):
							   $pageInArray[$k]['link'] = $Uri;
							 else:
							  $pageInArray[$k]['link'] = $Uri."&start=".$i;
							 endif; 
							 $pageInArray[$k]['active']=(($currentPage == $i) ? 1 : 0);
							 $k++;
						 }
					
						$pageInArray[$k]['title'] = 'Next &gt;&gt;';
					   if($currentPage < $NumberOfPage):
						   $pageInArray[$k]['link']=$Uri."&start=".($currentPage+1);
						   $pageInArray[$k]['enable']=1;
					   else:
							$pageInArray[$k]['link']=$Uri;
							$pageInArray[$k]['enable']=0;
					   endif;	
					   $pageInArray[$k]['active']=0;
					   $k++;
					   
					   $pageInArray[$k]['title'] = 'Last';
					   $pageInArray[$k]['link']=$Uri."&start=".$NumberOfPage;
					   $pageInArray[$k]['enable']=1;
					   $pageInArray[$k]['active']=0;	
					   
					   $this->assignRef('page',$pageInArray); 	  
					   ob_start();
					   $this->display($template);
					   $Pagination = ob_get_contents();
					   ob_end_clean();
			     }
			   $this->assignRef('Pagination',$Pagination); 	  
		   }      
		  function SetPaginationFront($count,$template = 'pagination/index')
		   {
		        global $Config,$ScriptUri;
				$ScriptParts = explode(DIRECTORY_SEPARATOR, $ScriptUri);
				if(count($ScriptParts) > 1)
				  {
				     array_pop($ScriptParts);
					 $ScriptUri = implode(DIRECTORY_SEPARATOR, $ScriptParts);
				  }
			   
			   //print_r($ScriptUri); exit;
			   $Pagination = '';
			   
			   if($count > $Config->limit)
			     {
					   $limit = $Config->limit;
					   $NumberOfPage = (floor($count/$limit) == ($count/$limit)) ? ($count/$limit) : (floor($count/$limit)) +1;
					
					   $currentPage = IRequest::getInt('start',1);
					   $pageInArray = array();
					
					   $k=0;
					   $pageInArray[$k]['title'] = 'First';
					   $pageInArray[$k]['link']=$ScriptUri;
					   $pageInArray[$k]['enable']=1;
					   $pageInArray[$k]['active']=0;
					   $k++;
					   
					    $pageInArray[$k]['title'] = '&lt;&lt; Prev';
					   if($currentPage >1):
					   $pageInArray[$k]['link']=$ScriptUri."?start=".($currentPage-1);
					   $pageInArray[$k]['enable']=1;
					   else:
					    $pageInArray[$k]['link']=$ScriptUri;
					   $pageInArray[$k]['enable']=0;
					   endif;
					   $pageInArray[$k]['active']=0;
					   $k++; 
					   
					   for($i=1; $i<=$NumberOfPage;$i++)
						{
							if($i >($currentPage + 2) || ($i+2) < $currentPage){
							continue;
							}
						
						 	$pageInArray[$k]['title'] = $i;
							$pageInArray[$k]['enable']=1;
						     if($i == 1):
							   $pageInArray[$k]['link'] = $ScriptUri;
							 else:
							  $pageInArray[$k]['link'] = $ScriptUri."?start=".$i;
							 endif; 
							 $pageInArray[$k]['active']=(($currentPage == $i) ? 1 : 0);
							 $k++;
						 }
					
						$pageInArray[$k]['title'] = 'Next &gt;&gt;';
					   if($currentPage < $NumberOfPage):
						   $pageInArray[$k]['link']=$ScriptUri."?start=".($currentPage+1);
						   $pageInArray[$k]['enable']=1;
					   else:
							$pageInArray[$k]['link']=$ScriptUri;
							$pageInArray[$k]['enable']=0;
					   endif;	
					   $pageInArray[$k]['active']=0;
					   $k++;
					   
					   $pageInArray[$k]['title'] = 'Last';
					   $pageInArray[$k]['link']=$ScriptUri."?start=".$NumberOfPage;
					   $pageInArray[$k]['enable']=1;
					   $pageInArray[$k]['active']=0;	
					    
					   $this->assignRef('page',$pageInArray); 	  
					   ob_start();
					   $this->display($template);
					   $Pagination = ob_get_contents();
					   ob_end_clean();
			     }
			   $this->assignRef('Pagination',$Pagination); 	  
		   }     
		function  savePagination($pageInArray)
		  {
			  global $db;
			  $FileName = md5(implode('-',$pageInArray));
			  $cache = IPATH_ROOT.DS.'cache'.DS.$FileName.'.es';
			  if(!file_exists($cache))
			    {
				   $query = "delete from #__404 WHERE type = 'pagination'";
				   $db->setQuery($query);
				   $page = basename($pageInArray[1]);
				   $Query = "select original from #__404 WHERE seo = ".$db->quote($page);
				   $db->setQuery($Query);
				   $original = $db->getOne();
				   foreach($pageInArray as $key => $value)
				     {
					        if($key != 1)
							  {
									$post = array (
													 'original'=>$original.'?start='.($key - 1),
													 'seo'=>$value,
													 'type'=>'pagination',
													 'type_id'=>$key,    
												  );  
									  
									$this->post = $post;
									parent::bind('404');
									parent::save();
							}
					 }
						//print_r($post); exit;	
				   $current = 'done';
				   file_put_contents($cache, $current);	 
				}
		  }	
		  function curPageURL() 
		  {
				 $pageURL = 'http';
				 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				 $pageURL .= "://";
				 if ($_SERVER["SERVER_PORT"] != "80") {
				  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				 } else {
				  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				 }
				 return $pageURL;
		 }	  
	function VehcleType()
	 {
	 	 
	 	global $db,$my,$template; 
			
		$Query="SELECT * FROM #__vehicletype";
		$db->setQuery($Query);
		$VehcleType = $db->LoadObjectList();
		$vtype = array();
		foreach($VehcleType as $Vehcle)
		  {
		    $vtype[$Vehcle->vehicle_type] = $Vehcle->vehicle_type; 
		  }
		$template->assignRef('VehcleType',$vtype); 
	 	
	 } 

		   
     }

  global $template;
  $template = new TemplateEngine($template);
?>
