<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>
<div class="block">
   <h2 class="bot"><a href="we-speak">We Speak</a></h2>
   <ul class="list">
      <?php foreach($this->LatestBlogPost as $post):?>
      <li> <a href="<?php echo $Config->site.$post->seo; ?>"><?php echo $post->title; ?></a> </li>
      <?php endforeach; ?>
   </ul>
</div>
