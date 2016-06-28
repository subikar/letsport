<?php defined ('ITCS') or die ("Go away.");
global $Config;
?>
<ul>
<?php foreach($this->page as $key=>$value):?>
<?php $listyle=($value['enable'] == 0)? 'display:none;' : ''; ?>
 	<li class="ng-scope <?php echo ($value['active']==1)? 'active':''?>" style=" <?php echo $listyle; ?>" >
	 <a class="ng-binding" href="<?php echo $Config->site.$value['link']; ?>"><?php echo $value['title']; ?></a>
	</li>
   <?php endforeach; ?>
</ul>