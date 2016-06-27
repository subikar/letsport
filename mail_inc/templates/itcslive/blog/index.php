<?php
  defined ('ITCS') or die ("Go away.");
  global $Config;
?>  
<div class="wrapper">
   <div class="grid_8">
      <h3 class="bot-1">Services Offering</h3>
      <?php foreach($this->Content as $Blog):?>
      <div class="wrapper-extra bot-4">
	  <?php $imageLink=(isset($Blog->gallery) && $Blog->gallery!="") ? $Blog->gallery : "templates/itcslive/images/portfolio/hire-php-programmer.jpg";  ?>
	   <img class="fleft right-1" src="<?php echo $Config->site.$imageLink; ?>" alt="alt" width="200" height="172" />
         <div class="extra-wrap"><span class="font-18 dis-block"><a class="col-1 hov" href="<?php echo $Config->site.$Blog->seo; ?>" title="Permalink to <?php echo $Blog->title; ?>" rel="bookmark"><?php echo $Blog->title; ?></a></span>
            
            <div class="entry-content">
               <?php 
							    $content = strip_tags($Blog->content);
							  echo substr($content,0,200); ?>
               ...
               <div class="entry-meta"> 
					<strong>Posted on</strong> <?php echo date('M d, Y',strtotime($Blog->created)); ?> <strong>by</strong>  
					<span class="author vcard"><?php echo $Blog->name;  ?></span> 
				</div>
			   <div class="entry-meta">
			   <span class="cat-links"> Category: <?php echo $Blog->category_name; ?></span> <span class="sep"> | </span> <span class="comments-link"><a href="<?php echo $Config->site.$Blog->seo; ?>#comments" title="Comment on <?php echo $Blog->title; ?>.."><b>1</b> Reply</a>
			    </div>
				<div class="entry-meta">
				<a class="button-1" href="<?php echo $Config->site.$Blog->seo; ?>">More</a>
				</div> 
            </div>
         </div>
      </div>
      <?php endforeach; ?>
	 <div id="pagination"> 
      <?php echo $this->Pagination; ?> 
	 </div>
   </div>
   <div class="grid_4">
      <div><?php includemodule("contact"); ?></div>
      <div><?php includemodule("latestblog"); ?></div>
      <div><?php includemodule("comments"); ?></div>
   </div>
</div>