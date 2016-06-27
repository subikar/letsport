<ul>
<a style=" float:right;" href="javascript:void(0);" onclick='jQuery("#content_search_result").hide();' >Close</a>
<?php if((int)$resultCount > 0): ?>
<li><?php echo $resultCount; ?> results are found.</li>
<?php foreach($Contents as $each): ?>
   <li>
   <span><img style="width:30px; height:30px;" src="<?php echo $each->gallery; ?>" /></span>
   <span>
   <strong><a href="<?php echo $Config->site.$each->seo; ?>"><?php echo $each->title; ?></a></strong><br />
   <span><?php echo $each->content; ?></span>
   </span>
   </li>
  <?php endforeach; ?>
   <?php if((int)$resultCount > $limit): ?>
  <li>
	  <a href="javascript:void(0);" onclick="Content.prevPage();">Prev</a>
	  <?php if(($limit * $page) < $resultCount): ?>
	  <a href="javascript:void(0);" onclick="Content.nextPage();">Next</a>
	  <?php endif; ?>
  </li>
  <?php endif; ?>
  <?php else: ?>
  <li>No Result Found!</li>
  <?php endif; ?>
</ul>
