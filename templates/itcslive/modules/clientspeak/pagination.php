
<ul>
<li><a href="javascript:void(0);" onclick="Clientspeak.searchThread(1);">First</a></li>
<li>
<a href="javascript:void(0);" onclick="<?php if($page > 1): ?>Clientspeak.searchThread(<?php echo $page-1; ?>); <?php endif; ?>">&lt;&lt; Prev</a>
</li>
<?php for($i=1; $i<=$lastPage; $i++): ?>
<?php if($i==$page): ?>
<li class="active"><a href="javascript:void(0);" onclick="Clientspeak.searchThread(<?php echo $i; ?>);"><?php echo $i; ?></a></li>
<?php elseif($i >($page + 2) || ($i+1) < $page): continue; ?>
<?php else:?>
<li><a href="javascript:void(0);" onclick="Clientspeak.searchThread(<?php echo $i; ?>);"><?php echo $i; ?></a></li>
<?php endif; ?>
<?php endfor; ?>

<li><a href="javascript:void(0);" onclick="<?php if($page < $lastPage): ?>Clientspeak.searchThread(<?php echo $page+1; ?>);<?php endif; ?>">Next &gt;&gt;</a></li>
<li><a href="javascript:void(0);" onclick="Clientspeak.searchThread(<?php echo $lastPage; ?>);">Last</a></li>
</ul>
