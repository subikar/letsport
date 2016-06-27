<?php
  defined ('ITCS') or die ("Go away.");
  global $Config;
?>  
		<div id="primary"> 
           <div id="sidebar-lt"><?php $this->display('left'); ?></div>
			<div role="main" id="content">
					<div class="article-body">
						
					<?php foreach($this->Content as $Blog):?>	
												
						<article id="post-<?php echo $Blog->id; ?>" class="post-<?php echo $Blog->id; ?> post type-post status-publish format-standard hentry category-<?php echo $Blog->category_name; ?>">
						
							<header class="entry-header">
											<h1 class="entry-title"><a href="<?php echo $Config->site.$Blog->seo; ?>" title="Permalink to <?php echo $Blog->title; ?>" rel="bookmark"><?php echo $Blog->title; ?></a></h1>
					
											<div class="entry-meta">
											  <span class="sep">Posted on </span>
											  <!--<a href="" title="" rel="bookmark">-->
											  <time class="entry-date" datetime="<?php echo date('h:i',strtotime($Blog->created)); ?>" pubdate=""><?php echo date('M d, Y',strtotime($Blog->created)); ?></time> <!--</a>-->
											  <span class="by-author"> <span class="sep"> by </span> <span class="author vcard">
											  <!--<a class="url fn n" href="http://www.itcslive.com/author/<?php echo $Blog->name; ?>" title="View all posts by <?php echo $Blog->name; ?>" rel="author">--> <?php echo $Blog->name; ?> <!--</a>--> </span>
											  </span>			
											</div><!-- .entry-meta -->
										<!--<div class="comments-link">
										  <a href="<?php //echo $Config->site.$Blog->seo; ?>" title="Comment on <?php //echo $Blog->title; ?>">1</a>			
										</div>-->
						   </header><!-- .entry-header -->
						   <div class="entry-content">
							  <?php 
							    $content = strip_tags($Blog->content);
							  echo substr($content,0,200); ?>...  
							
							<footer class="entry-meta">
									<span class="cat-links">
									<span class="entry-utility-prep entry-utility-prep-cat-links">Posted in</span> <!--<a href="http://www.itcslive.com/category/<?php echo $Blog->category_name; ?>" title="View all posts in <?php echo $Blog->category_name; ?>" rel="category tag">--> <?php echo $Blog->category_name; ?> <!--</a>-->			
									</span>
									<span class="sep"> | </span>
									<span class="comments-link"><a href="<?php echo $Config->site.$Blog->seo; ?>#comments" title="Comment on <?php echo $Blog->title; ?>.."><b>1</b> Reply</a>
									</span>
							</footer><!-- #entry-meta -->
						</div>		
					   </article><!-- #post-1957 -->
						<?php endforeach; ?>
			<?php echo $this->Pagination; ?>			
			</div>
			</div><!-- #content -->
           <div id="sidebar-rt"><?php $this->display('right'); ?></div>
		   <div class="clear"></div>
		   <?php 
		   if($this->is_home)
		      $this->display('homeslide' );
		   ?>
		   
		</div><!-- #primary -->
