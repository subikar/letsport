<?php defined ('ITCS') or die ("Go away.");
?>
		<div id="primary"> 
           <div id="sidebar-lt"><?php $this->display('left'); ?></div>
			<div role="main" id="content">
			 <?php  if($this->is_home): ?>
             <div class="midbanner">
               <img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/img2.png" class="easingsliderlite-image" alt="" title="" /> 
             </div>
			 <?php endif; ?>

      <div class="article-body">
   		<h1><?php echo $this->Content->title; ?></h1>
		<?php  if($this->is_home): ?>
		<div class="home">
          <?php echo $this->Content->content; ?>
         </div>	
		<?php else: ?> 
          <?php echo $this->Content->content; ?>
		<?php endif; ?>
       </div>
            

				
				

			</div><!-- #content -->
           <div id="sidebar-rt"><?php $this->display('right'); ?></div>
		   <div class="clear"></div>
		   <?php 
		   if($this->is_home)
		      $this->display('homeslide' );
		   ?>
		   
		</div><!-- #primary -->
