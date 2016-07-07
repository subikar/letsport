<?php defined ('ITCS') or die ("Go away.");
global $Config,$my,$template;
$template->includecss("templates/itcslive/css/reset.css",1,0);
$template->includecss("templates/itcslive/css/skeleton.css",2,0);
$template->includecss("templates/itcslive/css/style-min.css",3,0);
$template->includecss("templates/itcslive/css/form.css",4,0);
$template->includecss("templates/itcslive/css/bootstrap.css",12,0);

$template->includejs("//code.jquery.com/jquery-1.11.1.min.js",1,1);
$template->includejs("//maps.googleapis.com/maps/api/js?sensor=true&libraries=places",4,1);
$template->includejs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js",3,1);
$template->includejs("templates/itcslive/js/templatejs/script.js",6,0);
$template->includejs("templates/itcslive/js/google/jquery.placepicker.js",7,0);
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo isset($this->Title)?$this->Title:''; ?></title>
<?php $template->HeadCss(); ?>
<?php $template->HeadJs(); ?>
</head>
<body>
