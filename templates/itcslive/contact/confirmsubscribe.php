<?php $ConfirmSubscriber=$this->ConfirmSubscriber; 
//print_r($ConfirmSubscriber);exit;
?>
<form action="" method="post" class="form-horizontal getofferForm" name="GetFreeQuote" id="GetFreeQuote" target="_parent">
<div class="container popupform">

			<div class="row">
				<div class="col-md-4">
					<?php if($ConfirmSubscriber[0]->data[0]): ?>

													 <img src="images/gallery/<?php echo $ConfirmSubscriber[0]->data[0] ?>" />
													 <?php endif; ?>	
					Want to register to our subscription pack :<b> <?php print_r ($ConfirmSubscriber[0]->subscription_name);?></b><br/>
					It Costs Only : <b>Rs.<?php print_r ($ConfirmSubscriber[0]->amount);?></b>
					<br/><a  class="truckavailibilty" href="<?php echo $Config->site."subscribe?id=".$ConfirmSubscriber[0]->subscription_id ?>&bids=<?php echo $ConfirmSubscriber[0]->bids_number ?>&Name=<?php echo $ConfirmSubscriber[0]->subscription_name ?>">Confirm Subscribe</a>
					<br/><a  class="truckavailibilty" href="<?php echo $Config->site."mysubscription" ?>">Cancel </a>
				</div>
				
			</div>
			
			

				 		

							</label>			

		<div class="clear"></div>
		<p>
	
        </div>
</form> 