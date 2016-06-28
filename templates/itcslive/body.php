    <div class="wrapper grid_12">
       <div class="div-main ">  
		<?php  if($this->is_home): ?>
          <?php $this->display("homecontentslide",0); ?>
		<?php else: ?> 
          <?php echo $this->Content->content; ?>
		<?php endif; ?>
		</div>
	</div>		
