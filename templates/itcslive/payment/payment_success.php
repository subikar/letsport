<?php 
//error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config;

$post=IRequest::get("POST");
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="padDiv row10">
            <?php  if($post["payment_status"]=="Completed" || (isset($this->payment_status) && (int)$this->payment_status==1) || $post["status"]=="success"): ?>
            <p>Thank You Your Payment is successful!</p>
			<p>Go to <a href="<?php echo $Config->site."dashboard"; ?>">Dashboard</a></p>
            <?php else: ?>
            <p>Sorry!! Your Payment Is not successfull! </p>
			<p>Go to <a href="<?php echo $Config->site."dashboard"; ?>">Dashboard</a> And Pay Again.</p>
            <?php endif; ?>
         </div>
		 <div class="clear"></div>	 
      </div>
   </div>
</div>
