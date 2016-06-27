<?php defined ('ITCS') or die ("Go away."); 
global $Config;
error_reporting(0);
header('Content-type: application/xml');
 //print_r($this->sitemap); exit;
$xmldata = array();
$path = $Config->site.'images/sitemap.xsl'; 
$xmldata[] = "<?xml version='1.0' encoding='UTF-8'?><?xml-stylesheet type='text/xsl' href='".$path."' ?><urlset xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>
"; 

foreach($this->sitemap as $sitemap):
$xmldata[] = '<url>
              <loc>'.$Config->site.$sitemap->seo.'</loc>
			  <lastmod>'.date('c',mktime(str_replace('-','/',$sitemap->modified))).'</lastmod>
			  <changefreq>monthly</changefreq>
			  <priority>0.5</priority>
			  </url>';
endforeach; 
$xmldata[] = '</urlset>';

echo implode('',$xmldata);

?>
