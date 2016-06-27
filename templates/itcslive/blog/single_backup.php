<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>
<div id="primary"> 
   <div id="sidebar-lt"><?php $this->display('left'); ?></div>
	<div role="main" id="content">

<div class="article-body">
	<nav id="nav-single">
		<h3 class="assistive-text">Post navigation</h3>
	</nav><!-- #nav-single -->

					
<article id="post-<?php echo $this->Content->id; ?>" class="post-<?php echo $this->Content->id; ?> post type-post status-publish format-standard hentry category-uncategorized">

	<header class="entry-header">
		<h1 class="entry-title"><?php echo $this->Content->title; ?></h1>

				<div class="entry-meta">
			<span class="sep">Posted on </span><a href="<?php echo $Config->site.$this->Content->seo; ?>" title="<?php echo date('h:i',strtotime($this->Content->created)); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo date('c',strtotime($this->Content->created)); ?>" pubdate=""><?php echo date('M d, Y',strtotime($this->Content->created)); ?></time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="" title="View all posts by <?php echo $this->Content->name; ?>" rel="author"><?php echo $this->Content->name; ?></a></span></span>		</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

	<div class="entry-content">
       <?php echo $this->Content->content; ?>
    </div><!-- .entry-content -->

	<footer class="entry-meta">
		This entry was posted in <a href="" title="View all posts in <?php echo $this->Content->category_name; ?>" rel="category tag"><?php echo $this->Content->category_name; ?></a> by <a href="http://www.itcslive.com/author/SubikarBurman">iTCSLive</a>. Bookmark the <a href="<?php echo $Config->site.$this->Content->seo; ?>" title="Permalink to <?php echo $this->Content->title; ?>" rel="bookmark">permalink</a>.		
			</footer><!-- .entry-meta -->
    
</article><!-- #post-1957 -->

						<div id="comments">
	
	
			<h2 id="comments-title">
			One thought on "<span><?php echo $this->Content->title; ?></span>"</h2>
</div>
</div>		
	<!-- #respond -->
			
			</div><!-- #content -->
           <div id="sidebar-rt"><?php $this->display('right'); ?></div>
		   <div class="clear"></div>
		   <?php 
		   if($this->is_home)
		      $this->display('homeslide' );
		   ?>
		   
		</div><!-- #primary -->

