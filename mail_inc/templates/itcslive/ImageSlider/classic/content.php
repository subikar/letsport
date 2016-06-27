<div id="pagination">
<ul>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(1);">First</a></li>-->
<li>
<a href="javascript:void(0);" onclick="<?php if($page > 1): ?>ContentGallery.getGallery(<?php echo $page-1; ?>); <?php endif; ?>">&lt;&lt; Prev</a>
</li>
<?php for($i=1; $i<=$lastPage; $i++): ?>
<?php if($i==$page): ?>
<!--<li class="active"><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $i; ?>);"><?php echo $i; ?></a></li>-->
<?php elseif($i >($page + 2) || ($i+1) < $page): continue; ?>
<?php else:?>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $i; ?>);"><?php echo $i; ?></a></li>
--><?php endif; ?>
<?php endfor; ?>
<li><a href="javascript:void(0);" onclick="<?php if($page < $lastPage): ?>ContentGallery.getGallery(<?php echo $page+1; ?>);<?php endif; ?>">Next &gt;&gt;</a></li>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $lastPage; ?>);">Last</a></li>-->
</ul>
</div>
<div class="clear"></div>
<?php 
foreach($fullGallery as $Gallery): ?>
<a href="<?php echo $Gallery["org"]; ?>" class="gallery">
	<img src="<?php echo $Gallery["thumb"]; ?>" class="gallery_image">
</a>
<?php endforeach; ?>
<div class="clear"></div>
<div id="pagination">
<ul>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(1);">First</a></li>-->
<li>
<a href="javascript:void(0);" onclick="<?php if($page > 1): ?>ContentGallery.getGallery(<?php echo $page-1; ?>); <?php endif; ?>">&lt;&lt; Prev</a>
</li>
<?php for($i=1; $i<=$lastPage; $i++): ?>
<?php if($i==$page): ?>
<!--<li class="active"><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $i; ?>);"><?php echo $i; ?></a></li>-->
<?php elseif($i >($page + 2) || ($i+1) < $page): continue; ?>
<?php else:?>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $i; ?>);"><?php echo $i; ?></a></li>-->
<?php endif; ?>
<?php endfor; ?>
<li><a href="javascript:void(0);" onclick="<?php if($page < $lastPage): ?>ContentGallery.getGallery(<?php echo $page+1; ?>);<?php endif; ?>">Next &gt;&gt;</a></li>
<!--<li><a href="javascript:void(0);" onclick="ContentGallery.getGallery(<?php echo $lastPage; ?>);">Last</a></li>-->
</ul>
</div>