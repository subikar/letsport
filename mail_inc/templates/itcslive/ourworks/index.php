<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $Config;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10"> 
				<div class="boiteHeader">
				<h5><span class="fa fa-tasks"></span>LoadBorad</h5> 
				</div>	
                <table width="100%" cellpadding="3" cellspacing="3">
    			<?php foreach($this->workList as $work): ?>
				<tr>
				<td><label>From</label></td><td>To</td><td>Available For</td><td>Reporting Time</td></tr>
				<tr><td><b><?php echo $work->start_location?></b></td><td><b><?php echo $work->end_location?></b></td><td><b><?php echo $work->avaliable_date?></b></td><td><b><?php echo $work->reporting_time?></b></td></td>
				<tr><td><label>Vehicle Type</label></td><td><label>Material Type</label></td><td><label>Consignment Weight(MT)</label></td><td><label>Post ID</label></td></tr>
				<tr><td><b><?php echo $work->vehicle_type?></b></td><td><b><?php echo $work->material_type?></b></td><td><b><?php echo $work->consignment_weight?></b></td><td><b>PL<?php echo $work->id?></b></td></tr>
				<?php endforeach; ?>
				</table>
		 </div>
      </div>
   </div>
   <div id="pagination">
   <?php echo $this->Pagination; ?>
   </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
 jQuery(".openDescription").colorbox({iframe:true, width:"60%", height:"80%", fixed: true});	 
 });
</script>