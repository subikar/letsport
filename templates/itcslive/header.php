<?php defined ('ITCS') or die ("Go away.");
global $Config,$my,$template;
$template->includecss("templates/itcslive/js/colorbox/colorbox.css",6,0);
$template->includecss("templates/itcslive/css/style.css",7,0);
$template->includecss("templates/itcslive/css/jPushMenu.css",8,0);
$template->includecss("templates/itcslive/css/Responsive.css",9,0);
$template->includecss("templates/itcslive/css/font-awesome.css",10,0);
$template->includecss("templates/itcslive/css/content_style.css",11,0);
$template->includecss("templates/itcslive/css/bootstrap.css",12,0);
$template->includecss("templates/itcslive/css/superfish.css",13,0);

$template->includejs("//code.jquery.com/jquery-1.11.1.min.js",1,1);
$template->includejs("//cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.js",2,1);
$template->includejs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js",3,1);
$template->includejs("//cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js",4,1);
$template->includejs("//maps.googleapis.com/maps/api/js?sensor=true&libraries=places",4,1);
$template->includejs("//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js",5,1);
$template->includejs("templates/itcslive/js/templatejs/script.js",6,0);
$template->includejs("templates/itcslive/js/google/jquery.placepicker.js",7,0);
$template->includejs("templates/itcslive/js/jPushMenu.js",7,0);
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
<meta name="Description" content="<?php echo isset($this->Description)?$this->Description:''; ?>">
<meta name="Keywords" content="<?php echo isset($this->Keyword)?$this->Keyword:''; ?>">
<link rel="shortcut icon" href="<?php echo $this->site; ?>templates/itcslive/images/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<script language="javascript" type="text/javascript">
 var configurl = '<?php echo $this->site; ?>';
</script>
<?php  if($this->is_home): ?>
<?php endif; ?>
<?php if($my->uid > 0):?>
<link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/dashboard.css">
<?php endif; ?>
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