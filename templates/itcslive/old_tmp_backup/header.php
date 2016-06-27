<?php defined ('ITCS') or die ("Go away.");
global $Config,$my;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="google-site-verification" content="GDb4S15UpTrnLAeNr_7IJy3w7Ah5PLhMc1zzJzg6m8Q" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,700' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="<?php echo $this->site; ?>templates/itcslive/js/colorbox/jquery.colorbox.js"></script>
  <script src="<?php echo $this->site; ?>templates/itcslive/js/auto_jqueryui/kendo.all.min.js"></script>
   <script src="<?php echo $this->site; ?>classes/external/editor/tinymce.min.js"></script>
<script>
			$(document).ready(function(){
                   $(".clientlogin").colorbox({iframe:true, width:"40%", height:"50%"});	
			});
</script>			
<title><?php echo isset($this->Title)?$this->Title.' | iTCSLive':'iTCSLive'; ?></title>

 <meta property="og:image" content="<?php echo $this->site; ?>templates/itcslive/css/images/itcs-logo.png" />
 <meta property="og:title" content="<?php echo isset($this->Title)?$this->Title:''; ?>" />
 <meta property="og:type" content="article"/>
 <meta property="og:url" content="<?php echo $this->SCRIPT_URI; ?>" />
 <meta property="og:description"  content="<?php echo isset($this->Description)?$this->Description:''; ?>" />
 <meta property="og:site_name" content="iTCSLive" />
 <meta property="fb:admins" content="722407295"/>
<meta name="Description" content="<?php echo isset($this->Description)?$this->Description:''; ?>">
<meta name="Keywords" content="<?php echo isset($this->Keyword)?$this->Keyword:''; ?>"> 

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel=stylesheet type="text/css" media=all href="<?php echo $this->site; ?>templates/itcslive/css/style.css"/>
<link rel=stylesheet type="text/css" media=all href="<?php echo $this->site; ?>templates/itcslive/js/colorbox/colorbox.css"/>
<link rel=stylesheet type="text/css" media=all href="<?php echo $this->site; ?>templates/itcslive/js/auto_jqueryui/kendo.common.min.css"/>
<?php echo $this->css; ?>
<?php echo $this->Js; ?>

</head>
<body>
<div class="mainbody">
<div class="top_area">
  <div class="nav_inner">
    <div class="topmenu">
	      <?php if(isset($my->uid) && $my->uid > 0): ?>
			<a href="<?php echo $this->site; ?>">
			  <div class="logo_min"></div>
			</a>		       
		      <?php echo $this->menu('user-menu'); ?>
			   <?php //echo $this->menu('top-menu'); ?>
		  <?php else:?>
		      <?php echo $this->menu('top-menu'); ?>
		  <?php endif; ?>	  
    </div>
    <div class="right_header">
      <div class="textwidget"><i class="fa fa-fw fa-user"></i> 
	  <?php if(isset($my->uid)): ?>
	  <a class="logout" href="<?php echo $Config->site.'logout'; ?>" title="Client Logout">Logout</a>
	  <?php else:?>
	  <a class="clientlogin" href="<?php echo $Config->site.'login'; ?>" title="Client Login">Login</a>
	  <?php endif; ?>
	  <span class="phone"><i class="fa fa-fw fa-phone"></i>+91 033-6541-7672</span><span class="skype"><i class="fa fa-fw fa-skype"></i>itcslive</span></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php if(isset($my->uid) && $my->uid > 0): ?>
  <br clear="all" />
<?php endif;  ?>
<div class="mainstruct">
 <?php if(!isset($my->uid) && $my->uid == 0): ?>
<div class="header"> <a href="<?php echo $this->site; ?>">
  <div class="logo"></div>
  </a>
  <div class="logobannerright"> <?php $this->display('slideshow'); ?> </div>
  <div  class="girl"></div>
</div>
<?php endif; ?>
<div class="clear"></div>
