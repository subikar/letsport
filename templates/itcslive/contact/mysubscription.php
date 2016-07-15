<?php 
$Mysubscription = $this->Mysubscription; 
//print_r($Mysubscription);

?>
<div class="container">
		<div class="col-lg-12">
			<h2 class="section-heading">
				<span>Subscriptions</span>
			</h2>
			<div class="line"></div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-yellow">
					<!-- Begening of yellow panel -->
					
					<form action="" method="post" id="Subscribe" name="Subscribe" enctype="multipart/form-data" novalidate="novalidate" class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
						<div id="form1">
							<!-- Begening of form 1 -->
							
							<div class="panel-body pan">
								<!--<div class="alert alert-success"><strong><?php //echo $this->RegistrationError; ?> </strong></div>-->
					<div class="form-body pal">


								
						<div class="row">
							<div class="container">
								<div class="col-md-9">
								<?php foreach ($Mysubscription as $subscription): ?>
								
									
										<div class="col-md-3">
											<div class="form-group" id="error-first_name">
												

												<?php if($subscription->data[0]): ?>

													 <img src="images/gallery/<?php echo $subscription->data[0] ?>" />
													 <?php endif; ?>	
													Subscription Name:<?php echo $subscription->subscription_name;?>
													Amount:<?php echo $subscription->amount;?><br/>
													No of Bids:<?php echo $subscription->bids_number;?><br/>
											<a  class="truckavailibilty" href="<?php echo $Config->site."confirmsubscribe?id=".$subscription->subscription_id ?>">Subscribe</a>			

											</div>													
										</div>															
								<?php endforeach ?>
									</div>
								<div class="col-md-3" >
									<h4>My Subscriptions</h4>
									<?php //print_r($this->Subscriber[0]); exit;?>
									<?php foreach ($this->Subscriber as $subscription): ?>
											<div class="col-md-12">
											<div class="form-group" id="error-first_name">
													<b>Subscription Name:&nbsp;&nbsp;</b><?php echo $subscription->subscription_name;?><br/>
													<b>Bids Left:</b>&nbsp;&nbsp;<?php echo $subscription->lead_count;?><br/>																
											</div>													
										</div>		
													
													
									<?php endforeach ?>
									
									
								</div>
								</div>
									
							</div>	
										
						</div>
								
									
									
									<div class="form-group">
								        <div class="col-md-10 col-md-offset-2">
								            <div id="messages"></div>
								        </div>
								    </div>
									
								</div><!-- End Form Body Panel -->
							</div>
						</div>
						<!-- end of form1 -->
					</form>
				</div><!-- End Yellow Panel -->
			</div><!-- End Column -->
		</div><!-- End Row -->			
											<!--		<div class="form-actions text-right pal">
										<input value="SUBSCRIBE" name="SUBSCRIBE" type="button" id="btn_next" class="btn btn-primary" onclick="Ticket.SubmitForm('subscribe');"/>
										<input name="view" value="contact" type="hidden" />
										<input name="task" value="SaveRegister" type="hidden" />
										<input name="usertype" value="customer" type="hidden" />-->
	</div>