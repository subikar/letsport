<nav id="page-leftbar" role="navigation">
    <div>
      <ul style="top: 40px;" class="ng-scope" ng-controller="NavigationController" id="sidebar" sticky-scroll="40">
        <li id="search" ng-class="{'keep-open':style_showSearchCollapsed}"> <a href="" ng-class="{blockImportant:style_leftbarCollapsed &amp;&amp; !style_showSearchCollapsed}" ng-click="showSearchBar($event)"><i class="fa fa-search opacity-control"></i></a>
          <form class="ng-pristine ng-valid" ng-show="!style_leftbarCollapsed || style_showSearchCollapsed" ng-style="{display: style_showSearchCollapsed? 'block':''}" ng-click="$event.stopPropagation()" ng-submit="goToSearch()">
            <input ng-model="searchQuery" class="search-query ng-pristine ng-valid" placeholder="Search..." ng-style="{width: style_showSearchCollapsed? 'auto':''}" type="text">
            <button type="submit" ng-click="goToSearch()"><i class="fa fa-search"></i></button>
          </form>
        </li>
        <li class="ng-scope active" ng-repeat="item in menu" ng-class="{ hasChild: (item.children!==undefined),
                                    active: item.selected,
                                      open: (item.children!==undefined) &amp;&amp; item.open }" ng-include="'templates/nav_renderer.html'"><a href="#/" class="ng-scope" ng-click="select(item)" ng-href="#/">
          <i ng-if="item.iconClasses" class="fa fa-home"></i>
          <span class="ng-binding">Dashboard</span> <span class="ng-binding" ng-bind-html="item.html"></span> </a>
        </li>
        <li class="ng-scope" ng-repeat="item in menu" ng-class="{ hasChild: (item.children!==undefined),
                                    active: item.selected,
                                      open: (item.children!==undefined) &amp;&amp; item.open }" ng-include="'templates/nav_renderer.html'"><a href="index.php?view=users" class="ng-scope" ng-click="select(item)" ng-href="#/">
          <i ng-if="item.iconClasses" class="fa fa-user"></i>
          <span class="ng-binding">Users</span> <span class="ng-binding" ng-bind-html="item.html"></span> </a>
        </li>
		<li class="ng-scope"><a href="index.php?view=params" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Params</span></a>
        </li>
		<li class="ng-scope" ng-repeat="item in menu" ng-class="{ hasChild: (item.children!==undefined),
                                    active: item.selected,
                                      open: (item.children!==undefined) &amp;&amp; item.open }" ng-include="'templates/nav_renderer.html'"><a href="index.php?view=page" class="ng-scope" ng-click="select(item)" ng-href="#/">
          <i ng-if="item.iconClasses" class="fa fa-user"></i>
          <span class="ng-binding">Pages</span> <span class="ng-binding" ng-bind-html="item.html"></span> </a>
        </li>
        <li class="ng-scope"><a href="index.php?view=ourworks" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Truck Availability</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=blog" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Blog</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=testimonial" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Testimonial</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=category" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Category</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=menu" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Menu</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=comment" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Comment</span></a>
        </li>
		
        <li class="ng-scope"><a href="index.php?view=enquiry" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Truck Add Enquiry</span></a>
        </li>
		

        <li class="ng-scope"><a href="index.php?view=cache" class="ng-scope">
          <i ng-if="item.iconClasses" class="fa fa-blog"></i>
          <span class="ng-binding">Clean Cache</span></a>
        </li>
		
      </ul>
    </div>
    <!-- END SIDEBAR MENU -->
  </nav>