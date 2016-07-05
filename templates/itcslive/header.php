<?php defined ('ITCS') or die ("Go away.");
global $Config,$my,$template;

//$template->includecss("templates/itcslive/css/light-blue.css",1,0);
//$template->includecss("templates/itcslive/css/reset.css",2,0);
//$template->includecss("templates/itcslive/css/skeleton.css",3,0);
$template->includecss("templates/itcslive/css/superfish.css",4,0);
//$template->includecss("templates/itcslive/css/form.css",5,0);
$template->includecss("templates/itcslive/js/colorbox/colorbox.css",6,0);
$template->includecss("templates/itcslive/css/style.css",7,0);
$template->includecss("templates/itcslive/css/jPushMenu.css",8,0);
$template->includecss("templates/itcslive/css/Responsive.css",9,0);
$template->includecss("templates/itcslive/css/font-awesome.css",10,0);
$template->includecss("templates/itcslive/css/content_style.css",11,0);
$template->includecss("templates/itcslive/css/bootstrap.css",12,0);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="google-site-verification" content="GDb4S15UpTrnLAeNr_7IJy3w7Ah5PLhMc1zzJzg6m8Q" />
<meta name='verify-v1' content='dbf4e7b7ebca3ecc5f01a3cdf36e2de2'/>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title><?php echo isset($this->Title)?$this->Title.' | Lets Port':'Lets Port'; ?></title>
<meta property="og:image" content="<?php echo $this->site; ?>templates/itcslive/css/images/logo.png" />
<meta property="og:title" content="<?php echo isset($this->Title)?$this->Title:''; ?>" />
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo $this->SCRIPT_URI; ?>" />
<meta property="og:description"  content="<?php echo isset($this->Description)?$this->Description:''; ?>" />
<meta property="og:site_name" content="iTCSLive" />
<meta property="fb:admins" content="722407295"/>
<meta name="Description" content="<?php echo isset($this->Description)?$this->Description:''; ?>">
<meta name="Keywords" content="<?php echo isset($this->Keyword)?$this->Keyword:''; ?>">
<link rel="shortcut icon" href="<?php echo $this->site; ?>templates/itcslive/images/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php  if(isset($this->Content->isfullpage) && $this->Content->isfullpage == 1): ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-524982e11e01596a" async="async"></script>
<?php endif; ?>
<?php //echo $template->css; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/js/superfish.min.js"></script>
<script language="javascript" type="text/javascript">
 jQuery.noConflict();
 var configurl = '<?php echo $this->site; ?>';
</script>

<?php  if($this->is_home): ?>
<?php endif; ?>
<!-- For Mobile start -->
<script src="<?php echo $this->site; ?>templates/itcslive/js/jPushMenu.js"></script>
<!-- For Mobile End -->
<?php if($my->uid > 0):?>
<link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/dashboard.css">
<?php endif; ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js"></script>
<script src="<?php echo $this->site; ?>templates/itcslive/js/templatejs/script.js" ></script>
<?php $template->HeadCss(); ?>
<?php $template->HeadJs(); ?>
</head>
<body id="page-1">
<div class="main">
<div class="head">
  <div class="container_12">
    <div class="grid_12">
      <!-- For Desktop Header View -->
     <div class="container-fluid">
     	<div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 logo-sp-outer">
			
		</div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 topbar">
			<ul class="quick-contact topmidilbar respontop">
				<li><a class="truckavailibilty" href="<?php echo $Config->site.'submit-load'; ?>" title="Submit Load For Free">Submit Load</a></li>
				<li><a class="truckavailibilty" href="<?php echo $Config->site.'add-truck-available'; ?>" title="Submit Truck Availability For Free">Submit Truck</a></li>
				<li><a href="<?php echo $Config->site.'customer-signup'; ?>" title="Customer Signup For Free">Customer Signup</a></li>
				<li><a href="<?php echo $Config->site.'transporter-signup'; ?>" title="Transporter Signup For Free">Transporter Signup</a></li>
			</ul>
		</div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 topfix">
			<ul class="quick-contact respontop2">
				<li class="top_login_button dropdown">
                <?php if(isset($my->uid)): ?>
                <a href="#"><img src="images/user.png"></a>
                <div>
                	<ul class="dropdown-content">
   				 	<li><a href="<?php echo $Config->site.'dashboard'; ?>">Dashboard</a></li>
    				<li><a class="truckavailibilty" href="<?php echo $Config->site.'addtruck'; ?>">Add Truck</a></li>
  					<li><a class="truckavailibilty" href="<?php echo $Config->site.'adddriver'; ?>">Add Driver</a></li>
  					<li><a href="<?php echo $Config->site.'myload'; ?>">My Load</a></li>
  					<li><a href="<?php echo $Config->site.'mytruck'; ?>">My Truck</a></li>
  					<li><a href="<?php echo $Config->site.'mysubscription'; ?>">My Subcription</a></li>
  					<!--<li><a href="<?php echo $Config->site.'myinvoice'; ?>">Invoice History</a></li>-->
  					<li><a href="<?php echo $Config->site.'logout'; ?>">Logout</a></li>
  					</ul>
  				</div>
                <?php else:?>
                <a class="clientlogin" href="<?php echo $Config->site.'login'; ?>" title="Client Login"><div class="dropbtn"><img src="images/user.png"></div></a>
                <?php endif; ?>
            </li>
				<li class="top_help_button"><i class="fa fa-question-circle-o" aria-hidden="true"></i><a href="<?php echo $this->site; ?>help">Help</a></li>
				<li class="top_coll_button"><i class="fa fa-phone"></i>8500-65-333</li>
			</ul>
		</div>
		</div>
              <div class="clearfix"></div>
      </div>
      <!-- //For Desktop Header View -->
    </div>
  </div>
    <?php $this->display('mobilemenu',0); ?>
</div>
<?php  //if($this->is_home): ?>

</aside>
	<!-- Navbar -->
<div class="header__container">
<div class="container">
<header class="header" role="banner">
<div class="cruv"></div>
<div class="header__logo">
<a href="<?php echo $this->site; ?>">
<img src="images/logo.png" alt="CargoPress" srcset="images/logo.png" class="img-responsive">
</a>
<!-- 
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cargopress-navbar-collapse">
<span class="navbar-toggle__text">MENU</span>
<span class="navbar-toggle__icon-bar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</span>
</button>
 -->
</div>





<div class="main-width">
    <div class="container_12">
      <div class="grid_12">
        <div class="nav-search">
          <nav>
           <?php  $this->menu('top-menu'); ?>
          </nav>
           
          <div class="clear"></div>
        </div>
      </div>

    </div>
  </div>

<div class="header__navigation-widgets">
<div class="widget  widget-social-icons">
<a class="social-icons__link" href="https://www.facebook.com/itcslive" target="_blank"><i class="fa  fa-facebook"></i></a>
<a class="social-icons__link" href="https://twitter.com/outsourcing_web" target="_blank"><i class="fa  fa-twitter"></i></a>
<a class="social-icons__link" href="https://www.googlie.com/itcslive" target="_blank"><i class="fa  fa-google-plus"></i></a>
<a class="social-icons__link" href="https://www.linkedin.com/itcslive" target="_blank"><i class="fa  fa-linkedin"></i></a>
</div> </div>
</header>
</div>
</div>
<?php //endif; ?>
<?php  if(isset($this->Content->isfullpage) && $this->Content->isfullpage == 1): ?>
<!-- No Div for Full Page -->
<?php else: ?>
<section id="content">
<div class="container_12">
<?php endif; ?>