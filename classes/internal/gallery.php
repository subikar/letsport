<?php 
  class Gallery {
     function __construct()
	   {
	     
	   }
	 function GetGalleryFromContent($Content)
	   {
	   $GalleryID=0;
       $Width = 300;
	   $Height = 400;	   
	   	$html='';
		$pattern = '/\[nggallery.*[ ]+id=(?P<id>[0-9]+)[ ]+width=(?P<width>[0-9]+)[ ]+height=(?P<height>[0-9]+)[ ]+limit=(?P<limit>[0-9]+).*\]/u';
		preg_match_all($pattern, $Content, $matches);
		if(!isset($matches[0][0]))
		  {
			$pattern = '/\[nggallery.*[ ]+id=(?P<id>[0-9]+)[ ]+width=(?P<width>[0-9]+)[ ]+height=(?P<height>[0-9]+).*\]/u';
			preg_match_all($pattern, $Content, $matches);
		  }
		if(!isset($matches[0][0]))
		  {
			$pattern = '/\[nggallery.*[ ]+id=(?P<id>[0-9]+).*\]/u';
			preg_match_all($pattern, $Content, $matches);
		  }
		//print_r($matches); exit;
		if(isset($matches["id"][0]))
		{
		   $GalleryID=$matches["id"][0];
		} 
		//if(isset($matches["width"][0]))
		//{
			$pattern = '/\[nggallery.*[ ]+width=(?P<width>[0-9]+).*\]/u';
			preg_match_all($pattern, $Content, $matches);
		   $Width=$matches["width"][0];
		//} 
		// print_r($matches); exit;
		//if(isset($matches["height"][0]))
	//	{
			$pattern = '/\[nggallery.*[ ]+height=(?P<height>[0-9]+).*\]/u';
			preg_match_all($pattern, $Content, $matches);
		   $Height=$matches["height"][0];
		//} 
		//print_r($matches); exit;
		if(!isset($matches["limit"][0]))
		{
			$pattern = '/\[nggallery.*[ ]+limit=(?P<limit>[0-9]+).*\]/u';
			preg_match_all($pattern, $Content, $matches);
		
		   $Limit=$matches["limit"][0];
		} 
	   
		if((int)$GalleryID > 0)
		{
			$html=	$this->GetGalleryHTML($GalleryID,$Width,$Height,$Limit);
			$Content=str_ireplace($matches[0][0], $html, $Content);
		}
		
	     // Do your work and return
		 return $Content; 
	   }
	   function GetGalleryHTML($GalleryID,$Width,$Height,$Limit)
	   {
			global $db,$Config,$template; 
			$html="";
			$SQL="SELECT data FROM #__gallery WHERE gallery_id=".$db->quote($GalleryID);
			$db->setQuery($SQL);
			$Content = $db->getOne();
			if($Content !='')
			{
			    $html = '<div id="gallery_area"><img src="'.$Config->site.'templates/itcslive/images/search_content-loader.gif" /></div>';
				
				ob_start();
					include_once(IPATH_ROOT."/templates/itcslive/ImageSlider/classic/slideshow.php");
				$template->customjs = ob_get_clean();
				
			}	
			return $html;
	   } 
	   function GetModuleFromContent($Content)
	   {
	   global $template;
	   	$html=''; $matches=array(); $matchArray=array();
		$pattern = '/\[module.*[ ]+name="(?P<name>.*)".*\]/u';
		preg_match_all($pattern, $Content, $matches);
		//print_r($matches); exit;
		if(count($matches["name"]) > 0)
		{
			foreach($matches["name"] as $key=>$ModuleName):
			if($ModuleName!="")
			{
			  	ob_start();
			 	 includemodule($ModuleName);
				$html = ob_get_clean();
				$Content=str_replace($matches[0][$key], $html, $Content);
			}
			endforeach;
		} 
		 return $Content; 
	   }
  }

?>