<!-- For Mobile Header View -->

<header class="desktop-none">
  <div class="grid_12">
    <div class="grid_2 mobile-nav-list">
      <button class="toggle-menu menu-left push-body jPushMenuBtn"> 
	  	<span class="tgl_menu toggle-open cross_1" alt="">menu</span>
      	<span class="tgl_menu toggle-open cross_2" alt="">menu</span>
      	<span class="tgl_menu toggle-open cross_3" alt="">menu</span>
      </button>
    </div>
    <div class="grid_2 mobile-logo-outer">
      <h1><a href="<?php echo $this->site; ?>"><img src="<?php echo $this->site; ?>templates/itcslive/images/logo1.png" alt=""></a></h1>
    </div>
    <div class="grid_8 mobile-menu-links">
      <ul class="links">
        <li class="last"><a href="#"><i class="fa fa-fw fa-envelope"></i></a></li>
        <li><a href="#"><i class="fa fa-fw fa-skype"></i></a></li>
        <li><a href="#"><i class="fa fa-fw fa-user"></i></a></li>
        <li class="first phone"><a href="tel:+919836892283"><i class="fa fa-fw fa-phone"></i></a></li>
      </ul>
    </div>
	
	<div class="clear"></div>
	<div class="mobile-hedr-tagline">Information Technology Consultant Services</div>
	
	
  </div>
</header>
<!-- //For Mobile Header View -->


<div class="clear"></div>


<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" style="overflow-y: scroll; overflow-x: hidden; height:500px;">
  <div class="container_12">
    <div class="wrapper">
      <div class="grid_12 grid_mob">
        <h2 class="bot-6">Main Menu</h2>
        <div class="block main-menu">
          <?php $this->menu('footer-menu-1'); ?>
        </div>
      </div>
      <div class="grid_12 grid_mob">
        <div class="block">
          <h2 class="bot-6">Our Services</h2>
          <?php $this->menu('our-services'); ?>
        </div>
      </div>
      <div class="grid_12 grid_mob">
        <div class="block">
          <h2 class="bot-6">Apllication Services</h2>
          <?php $this->menu('footer-menu-2'); ?>
        </div>
      </div>
      <div class="grid_12 grid_mob">
        <div class="block">
          <h2 class="bot-6">Other Services</h2>
          <?php $this->menu('other-service'); ?>
        </div>
      </div>
      <div class="grid_12 grid_mob">
        <div class="block">
          <h2 class="bot-6">Articles</h2>
          <?php $this->menu('footer-menu-4'); ?>
        </div>
      </div>
	  
	  <div class="grid_12 lft-toggle-quick-links">
	  	<ul class="foot-quicklinks">
			<li><a href="tel:+919836892283"><i class="fa fa-fw fa-phone"></i></a></li>
			<li><a href="#"><i class="fa fa-fw fa-user"></i></a></li> 
			<li><a href="#"><i class="fa fa-fw fa-skype"></i></a></li>
			<li><a href="#"><i class="fa fa-fw fa-envelope"></i></a></li>
		</ul>		
	  </div>
	  
    </div>
  </div>
</nav>
