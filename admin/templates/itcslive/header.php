<?php global $Config,$template; 

$template->includecss("templates/itcslive/css/default.css",12,0);
$template->includecss("templates/itcslive/css/a7e52953.main.css",12,0);

$template->includecss("templates/itcslive/css/bootstrap.css",12,0);

$template->includejs("//code.jquery.com/jquery-1.11.1.min.js",1,1);
$template->includejs("//maps.googleapis.com/maps/api/js?sensor=true&libraries=places",4,1);
$template->includejs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js",3,1);
$template->includejs("templates/itcslive/js/templatejs/script.js",6,0);
$template->includejs("templates/itcslive/js/google/jquery.placepicker.js",7,0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>iTCSLive Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Forza">
  <meta name="author" content="iTCSLive">

  <link rel="icon" type="image/png" href="/favicon.png">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,700' rel='stylesheet' type='text/css'>
  <?php $template->HeadCss(); ?>  
  <?php echo $template->HeadJs(); ?>
<style type="text/css">
.topNegative1000 {
  top: -1000px !important;
}
.topZero {
  top: 0 !important;
}
  
.mainview-animation {
  position: relative;
}
.mainview-animation.ng-enter {
  -webkit-transition: .3s linear all; /* Safari/Chrome */
  -moz-transition: .3s linear all; /* Firefox */
  -o-transition: .3s linear all; /* Opera */
  transition: .3s linear all; /* IE10+ and Future Browsers */
}

/**
 * Pre animation -> enter
 */
.mainview-animation.ng-enter{
  /* The animation preparation code */
  opacity: 0;
}

/**
 * Post animation -> enter
 */
.mainview-animation.ng-enter.ng-enter-active { 
  /* The animation code itself */
  opacity: 1;
}

.angular-google-map-container { height: 300px; }
.navbar.navbar-default.ng-hide {
  display: none;
}
#page-rightbar .jspHorizontalBar {
  /*display: none !important;*/
}
.fc-grid .fc-day-number {
  padding: 5px 6px;
}
</style>
</head>

<body class="static-header ng-scope" ng-app="themesApp" ng-controller="MainController" ng-class="{
              'static-header': !style_fixedHeader,
              'focusedform': style_fullscreen,
              'layout-horizontal': style_layoutHorizontal,
              'fixed-layout': style_layoutBoxed,
              'collapse-leftbar': style_leftbarCollapsed &amp;&amp; !style_leftbarShown,
              'show-rightbar': style_rightbarCollapsed,
              'show-leftbar': style_leftbarShown
            }" ng-click="hideSearchBar();hideHeaderBar();">
<header class="navbar navbar-inverse navbar-static-top"> 
<a class="ng-scope" id="leftmenu-trigger" tooltip-placement="right" tooltip="Toggle Sidebar" ng-click="toggleLeftBar()"></a> 
<a class="ng-scope" id="rightmenu-trigger" tooltip-placement="left" tooltip="Toggle Infobar" ng-click="toggleRightBar()"></a>
  <div class="navbar-header pull-left"> 
  <a class="navbar-brand" href="index.php">iTCSLive</a> </div>
  <ul class="nav navbar-nav pull-right toolbar">
    <li class="dropdown ng-hide" ng-show="!isLoggedIn"> <a href="index.php?task=logout" style="font-size: 14px"><i class="fa fa-sign-in"></i> Log Out</a> </li>
    <li class="dropdown" ng-show="isLoggedIn"> 
	<a aria-expanded="false" aria-haspopup="true" href="#" class="dropdown-toggle username"><span class="hidden-xs"><?php echo $my->name; ?></span> </a>
      
    </li>
    <li class="dropdown ng-scope" ng-controller="MessagesController" ng-show="isLoggedIn" data-bootstro="" data-bootstro-step="2" data-bootstro-placement="bottom" data-bootstro-content="Click to mark messages as read."> <a aria-expanded="false" aria-haspopup="true" href="#" class="dropdown-toggle"> <i class="fa fa-envelope"></i>
      <!-- ngIf: unseenCount>0 -->
      <span class="badge badge-danger ng-binding ng-scope" ng-if="unseenCount&gt;0" ng-bind="unseenCount">6</span>
      <!-- end ngIf: unseenCount>0 -->
      </a>
    </li>
    <li class="dropdown ng-scope" ng-controller="NotificationsController" ng-show="isLoggedIn" data-bootstro="" data-bootstro-step="1" data-bootstro-placement="bottom" data-bootstro-content="Click here to check out the dynamic notifications section. You can mark items as read and see the changes in real time."> <a aria-expanded="false" aria-haspopup="true" href="#" class="dropdown-toggle"> <i class="fa fa-bell"></i>
      <!-- ngIf: unseenCount>0 -->
      <span class="badge badge-orange ng-binding ng-scope" ng-if="unseenCount&gt;0" ng-bind="unseenCount">5</span>
      <!-- end ngIf: unseenCount>0 -->
      </a>
      
    </li>
  </ul>
</header>
<div id="page-container" class="clearfix">
<?php $this->display('left');  ?>
