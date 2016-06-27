<?php global $Config; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>iTCSLive Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Forza">
  <meta name="author" content="Ndevr Studios & The Red Team">

  <link rel="icon" type="image/png" href="/favicon.png">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,700' rel='stylesheet' type='text/css'>
  <link href='templates/itcslive/css/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 
        

    <!-- The following CSS are included as plugins and can be removed if unused-->
    <link rel="stylesheet" href="templates/itcslive/css/a7e52953.main.css"/>
	<link rel=stylesheet type="text/css" href="<?php echo $Config->site; ?>templates/itcslive/js/colorbox/colorbox.css"/>
	<link rel=stylesheet type="text/css" href="<?php echo $Config->site; ?>templates/itcslive/js/auto_jqueryui/kendo.common.min.css"/>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $Config->site; ?>templates/itcslive/js/colorbox/jquery.colorbox.js"></script>
	 <script src="<?php echo $Config->site; ?>templates/itcslive/js/auto_jqueryui/kendo.all.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<?php echo $this->Js; ?>
</head>

<body class="popup-header ng-scope">
<div id="popup-page-container" class="clearfix">