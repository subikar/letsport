<?php defined ('ITCS') or die ("Go away.");







global $Config,$my,$template;







/*$template->includejs($this->site."templates/itcslive/js/templatejs/jquery-migrate-1.1.1.js",1,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/script.js",2,1);







$template->includejs($this->site."templates/itcslive/js/templatejs/superfish.js",3,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/jquery.ui.totop.js",4,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/jquery.equalheights.js",5,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/jquery.mobilemenu.js",6,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/jquery.easing.1.3.js",7,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/jquery.mobile.customized.min.js",8,0);







$template->includejs($this->site."templates/itcslive/js/colorbox/jquery.colorbox.js",9,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/kendo.all.min.js",10,0);







$template->includejs($this->site."templates/itcslive/js/templatejs/tinymce.min.js",11,0);*/















?>







<!DOCTYPE html>







<html>







<head>







<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">







<meta name="google-site-verification" content="GDb4S15UpTrnLAeNr_7IJy3w7Ah5PLhMc1zzJzg6m8Q" />







<meta name='verify-v1' content='dbf4e7b7ebca3ecc5f01a3cdf36e2de2'/>







<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />







<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>







 <meta name = "format-detection" content = "telephone=no" />







 <title><?php echo isset($this->Title)?$this->Title.' | iTCSLive':'iTCSLive'; ?></title>







 <meta property="og:image" content="<?php echo $this->site; ?>templates/itcslive/css/images/logo.png" />







 <meta property="og:title" content="<?php echo isset($this->Title)?$this->Title:''; ?>" />







 <meta property="og:type" content="article"/>







 <meta property="og:url" content="<?php echo $this->SCRIPT_URI; ?>" />







 <meta property="og:description"  content="<?php echo isset($this->Description)?$this->Description:''; ?>" />







 <meta property="og:site_name" content="iTCSLive" />







 <meta property="fb:admins" content="722407295"/>







 <meta name="Description" content="<?php echo isset($this->Description)?$this->Description:''; ?>">







 <meta name="Keywords" content="<?php echo isset($this->Keyword)?$this->Keyword:''; ?>"> 







 <link rel="icon" href="images/favicon.ico">







 <link rel="shortcut icon" href="<?php echo $this->site; ?>templates/itcslive/images/favicon.ico" />







 <link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/style.css">







 <link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/light-blue.css">



 <link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/jPushMenu.css">







<link rel="profile" href="http://gmpg.org/xfn/11" />







<link rel=stylesheet type="text/css" media=all href="<?php echo $this->site; ?>templates/itcslive/js/colorbox/colorbox.css"/>







<link rel=stylesheet type="text/css" media=all href="<?php echo $this->site; ?>templates/itcslive/js/auto_jqueryui/kendo.common.min.css"/>







<!-- Go to www.addthis.com/dashboard to customize your tools -->







<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-524982e11e01596a" async="async"></script>







<?php echo $template->css; ?>







 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery-migrate-1.1.1.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/script.js"></script> 







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/superfish.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery.ui.totop.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery.equalheights.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery.mobilemenu.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery.easing.1.3.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/jquery.mobile.customized.min.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/colorbox/jquery.colorbox.js"></script>







 <script src="<?php echo $this->site; ?>templates/itcslive/js/auto_jqueryui/kendo.all.min.js"></script>



 <script src="<?php echo $this->site; ?>templates/itcslive/js/jPushMenu.js"></script>







 <script src="<?php echo $this->site; ?>classes/external/editor/tinymce.min.js"></script>







<?php echo $template->HeadJs(); ?>



<script language="javascript" type="text/javascript">



 var configurl = '<?php echo $this->site; ?>';



</script>



</head>







<body id="page-1">







<div class="main">







<div class="head">      







     <div class="container_12">







       <div class="grid_12">




<!-- For Desktop Header View -->

<header class="mobile-none">


               <div class="extra-wrap">



			     <div class="grid_12">



				 <div class="grid_4">


                 <h1><a href="<?php echo $this->site; ?>"><img src="<?php echo $this->site; ?>templates/itcslive/images/logo.png" alt=""></a></h1>


				 </div>


				 <div class="grid_8">







                 <div class="login">Need help? Call Us <i class="fa fa-fw fa-phone"></i> 033-68888449 &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fa fa-fw fa-skype"></i> itcslive &nbsp;&nbsp;| &nbsp;&nbsp; <i class="fa fa-fw fa-user"></i> 



				 <?php if(isset($my->uid)): ?>


				  <a class="logout" href="<?php echo $Config->site.'logout'; ?>" title="Client Logout">Logout</a>



				  <?php else:?>

				  <a class="clientlogin" href="<?php echo $Config->site.'login'; ?>" title="Client Login">User Login</a>



				  <?php endif; ?>


				 </div>



				  <div class="clearfix"></div>



           		  <a href="http://www.joomspot.com" target="_blank" class="bnrsp top-domain-bnr"><img src="images/itcs_banner-1.jpg" title="Buy Domain, Hosting, Email and More at www.Joomspot.com" alt="Buy Domain, Hosting, Email and More at www.Joomspot.com"/></a>



				 </div>



               </div>



			   </div>

 </header>

<!-- //For Desktop Header View -->





<!-- For Mobile Header View -->

<header class="desktop-none">



<div class="grid_12">



                 <div class="grid_2 mobile-nav-list">



				  <button class="toggle-menu menu-left push-body jPushMenuBtn">



				 <span class="tgl_menu toggle-open cross_1" alt="">menu</span>



<!--				 <span class="tgl_menu toggle-open cross_2" alt="">menu</span>



				 <span class="tgl_menu toggle-open cross_3" alt="">menu</span>-->



				 </button>



				 </div>



				 <div class="grid_2 mobile-logo-outer ">



                 <h1><a href="<?php echo $this->site; ?>"><img src="<?php echo $this->site; ?>templates/itcslive/images/logo1.png" alt=""></a></h1>




				 </div>



				 <div class="grid_8 mobile-menu-links">


				 </div>



               </div>		 



		 </header>
<!-- //For Mobile Header View -->		 
		 



		 </div>







     </div>







<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" style="overflow-y: scroll; overflow-x: hidden; height:500px;">



  <?php $this->display('mobilemenu',0); ?>



</nav>



      <div class="main-width"><div class="container_12">







       <div class="grid_12">







          <div class="nav-search">







            <nav> 







			 <?php if(isset($my->uid) && $my->uid > 0): ?>







		      <?php $this->menu('user-menu'); ?>







		  <?php else:?>







		      <?php  $this->menu('top-menu'); ?>







		  <?php endif; ?>







            </nav>







            <div class="div-search">







               <?php includemodule('contentsearch'); ?>   







            </div>







            <div class="clear"></div></div>







     </div>







         </div>







       </div>







   <?php  if($this->is_home): ?>   







      <div id="slide">







	  <?php $this->display('slideshow',0); ?>







    </div>







  <?php endif; ?>    







   </div>







<?php  if($this->is_home): ?>







<aside>







   <div class="main-aside">







       <div class="inner">







        <div class="container_12">







          <div class="wrapper">







              <div class="grid_4">







                 <?php includemodule('welcome'); ?>  







              </div>







              <div class="grid_4">







                 <?php includemodule('development'); ?>  







              </div>







              <div class="grid_4">







                <?php includemodule('success'); ?>







              </div>







          </div>







        </div>







       </div>







   </div>







</aside>







<?php endif; ?>







<section id="content" class="<?php echo $this->sectionclass; ?>"> 







<div class="container_12">







