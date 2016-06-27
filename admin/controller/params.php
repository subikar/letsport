<?php 
class Params extends Master {
		var $paramvalue=NULL;
         function __construct()
		   {
			    parent::__construct();
		   }
		  function display()
		   {
		        global $template; 
				//$template->includejs('templates/itcslive/js/page.js');
				
				$this->getpages();
				$template->display('header');
				$template->display('params/index');
				$template->display('footer');
		   }  
		  function  getpages()
		  {
		  	global $db, $template, $Config;
			$paramIndex=IRequest::getInt("param_index", 0);
			$ConfigMenu=array();
			$configPath=IPATH_ROOT."/admin/config/";
			$files = glob($configPath.'*.xml');
				for($i=0; $i < count($files); $i++):
					$ConfigMenu[$i]["name"] = basename($files[$i], ".xml");
					$ConfigMenu[$i]["filename"] = basename($files[$i]);
					$ConfigMenu[$i]["full_path"] = $files[$i];
					$ConfigMenu[$i]["param_index"] = $i+1;
				endfor;
				
			$currentFile_index=((int)$paramIndex > 0) ? (int)($paramIndex -1) : 0;	
			
			$Query = "select data from #__params WHERE param_name LIKE ".$db->quote(trim($ConfigMenu[$currentFile_index]["name"]));
			$db->setQuery($Query);
			$paramvalue = $db->getOne();
			$this->paramvalue=($paramvalue!=NULL) ? json_decode($paramvalue,TRUE): array();
			
			//print_r($this->paramvalue); exit;
			$Generatedhtml=$this->generateHTML($files[$currentFile_index]);	
			$template->assignRef('Generatedhtml',$Generatedhtml);
			$template->assignRef('ConfigMenu',$ConfigMenu);
			$template->assignRef('filename', $ConfigMenu[$currentFile_index]["name"]);
			}
			
			function generateHTML($xml_file)
			{
				$html_ul_li="";
				$html_div="";
				$xml_file = file_get_contents($xml_file, FILE_TEXT);
				$xml = simplexml_load_string($xml_file);
				$json = json_encode($xml);
				$htmlarray = json_decode($json,TRUE);
				$fieldset=$htmlarray["fieldset"];
				
					$html_ul_li .="<ul>";
						for($i=0; $i<count($fieldset); $i++):
							$liClass=($i==0)? 'class="k-state-active"' : '';
							$html_ul_li .="<li ".$liClass.">".$fieldset[$i]['@attributes']['label']."</li>";
							$html_div .="<div>";

							if(count($fieldset[$i]['field']) > 1): //if there is multiple field in fieldset.
								for($j=0; $j< count($fieldset[$i]['field']); $j++):	
									$each_Input = $this->generateINPUT($fieldset[$i]['field'][$j]);
									$html_div .="<div>".$each_Input."</div>";
								endfor;
							else: //if there is only single field in fieldset.
								$each_Input = $this->generateINPUT($fieldset[$i]['field']);
								$html_div .="<div>".$each_Input."</div>";
							endif;
							$html_div .="</div>";

							
						endfor;
					$html_ul_li .="</ul>";
					
				return $html_ul_li.$html_div;
					
			}
			function generateINPUT($field)
			{
				//print_r($this->paramvalue); exit;
				$inputHtml="";
				$Fieldtype=trim($field["@attributes"]["type"]);
				$inputHtml .='<label for="'.$field["@attributes"]["id"].'">'.$field["@attributes"]["label"].'</label>';
				
				switch($Fieldtype):
					case "text":
						$inputHtml .='<input placeholder="'.$field["@attributes"]["label"].'" type="text" name="'.$field["@attributes"]["name"].'" id="'.$field["@attributes"]["id"].'" class="'.$field["@attributes"]["class"].'" value="'.$this->paramvalue[$field["@attributes"]["name"]].'" />';
					break;
					
					case "list":
						
						$multiple=isset($field["@attributes"]["multiple"]) ? 'multiple="multiple"' : ''; 
						$inputHtml .='<select name="'.$field["@attributes"]["name"].'" id="'.$field["@attributes"]["id"].'" class="'.$field["@attributes"]["class"].'" '.$multiple.'>';
						
						foreach($field["option"] as $key=>$eachoption):
							$eachoption=trim($eachoption);
							$paramvalue = array_filter($this->paramvalue);
							if($multiple!='' && !empty($paramvalue))
							{
								$attrOrgName=str_replace("[]","", $field["@attributes"]["name"]);
								$selected=(in_array($eachoption,$this->paramvalue[$attrOrgName])) ? 'selected="selected"' : '';
							}
							elseif($multiple=='' && !empty($paramvalue))
							{
								$selected=(strcasecmp(trim($this->paramvalue[$field["@attributes"]["name"]]), $eachoption) == 0 ) ? 'selected="selected"' : '';
							}
							else
							{
								$selected=(isset($field["@attributes"]["default"]) && (strcasecmp(trim($field["@attributes"]["default"]), $eachoption) == 0 ) ) ? 'selected="selected"' : '';
							}
							$inputHtml .='<option '.$selected.'>'.$eachoption.'</option>';
						endforeach;
						$inputHtml .='</select>';
					break;
					
					case "textarea":
						$inputHtml .='<textarea name="'.$field["@attributes"]["name"].'" id="'.$field["@attributes"]["id"].'" class="'.$field["@attributes"]["class"].'">'.$this->paramvalue[$field["@attributes"]["name"]].'</textarea>';
					break;
					
					default:
					break;
				endswitch;
				
				return $inputHtml;
			}
			
			function saveConfig()
			{
				global $db, $Config,$mainframe;
				$post=IRequest::get("POST");
				
				unset($post["view"]);unset($post["task"]); //config_name
				$fieldValues=json_encode($post);
				//print_r($fieldValues); exit;
				$Query="SELECT count(*) FROM #__params WHERE param_name LIKE ".$db->quote(trim($post["config_name"]));	
				$db->setQuery($Query);
				$isexist = $db->getOne();
				if($isexist >0)
				{
					$Query="UPDATE #__params SET data=".$db->quote($fieldValues)." WHERE param_name LIKE ".$db->quote(trim($post["config_name"]));	
					$db->setQuery($Query);
				}
				else
				{
					$this->post = array("param_name"=>trim($post["config_name"]),"data"=>$fieldValues);
					 parent::bind('params');
					 parent::save();
				}	
				
				 $mainframe->redirect('index.php?view=params');
			}
}
?>