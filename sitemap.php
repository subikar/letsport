<?php 
  defined ('ITCS') or die ("Go away.");
  global $template; 
  $Model = includeclass('sitemap');
  $GetSiteMapData = $Model->GetSitemap();
 // print_r($GetSiteMapData); exit;
  $template->assignRef('sitemap',$GetSiteMapData);
  $template->display('sitemap/index');
?>