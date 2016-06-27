<?php defined ('ITCS') or die ("Go away.");
global $Config;
?>
<ul boundary-links="false" total-items="userAccounts.length-6" ng-model="currentPage" items-per-page="itemsPerPage" class="mb0 pagination-sm pagination ng-isolate-scope ng-pristine ng-valid">
<?php foreach($this->page as $key=>$value):?>
<?php $listyle=($value['enable'] == 0)? 'display:none;' : ''; ?>
 	<li class="ng-scope <?php echo ($value['active']==1)? 'active':''?>" style=" <?php echo $listyle; ?>" >
	 <a class="ng-binding" href="<?php echo $Config->site.'admin/'.$value['link']; ?>"><?php echo $value['title']; ?></a>
	</li>
   <?php endforeach; ?>
</ul>