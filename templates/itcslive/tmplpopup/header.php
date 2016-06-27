<?php defined ('ITCS') or die ("Go away.");
global $Config,$my,$template;
$template->includecss("templates/itcslive/css/reset.css",1,0);
$template->includecss("templates/itcslive/css/skeleton.css",2,0);
$template->includecss("templates/itcslive/css/style-min.css",3,0);
$template->includecss("templates/itcslive/css/form.css",4,0);
$template->includejs("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js",1,0);
if($my->uid >0)
 {
	$template->includecss("templates/itcslive/js/colorbox/colorbox.css",3,0);
	$template->includecss("templates/itcslive/js/auto_jqueryui/kendo.common.min.css");
	$template->includejs($this->site."templates/itcslive/js/colorbox/jquery.colorbox.js",2,0);
	$template->includejs($this->site."templates/itcslive/js/auto_jqueryui/kendo.all.min.js",3,0);
	$template->includejs($this->site."classes/external/editor/tinymce.min.js",4,0);
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo isset($this->Title)?$this->Title:''; ?></title>
<?php $template->HeadCss(); ?>
<?php $template->HeadJs(); ?>
</head>
<body>
