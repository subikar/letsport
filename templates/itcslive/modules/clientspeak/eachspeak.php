<?php
$i=0;
 foreach($ClientsSpeakInArray as $speak): if($i==0){ $imgClass="fleft"; $i=1; } else { $imgClass="fright"; $i=0; } ?>
<div class="wrapper-extra bot-4"><img class="<?php echo $imgClass; ?> right-1" src="<?php echo $speak->gallery; ?>" alt="alt" style="width:236; height:172;" />
<div class="extra-wrap">
<div class="block-2"><?php echo $speak->testimonial_content; ?></div>
<div class="block-3"><?php echo $speak->client_name; ?></div>
</div>
</div>
<?php endforeach; ?>