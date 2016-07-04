<?php 
$Mysubscription = $this->Mysubscription; 
//print_r($Mysubscription);
?>
<div class="container">
		<div class="col-lg-12">
			<h2 class="section-heading">
				<span>My Subscriptions</span>
			</h2>
			<div class="line"></div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-yellow">
					<!-- Begening of yellow panel -->
					
					<form action="" method="post" id="subscribe" name="subscribe" enctype="multipart/form-data" novalidate="novalidate" class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
						<div id="form1">
							<!-- Begening of form 1 -->
							
							<div class="panel-body pan">
								<!--<div class="alert alert-success"><strong><?php //echo $this->RegistrationError; ?> </strong></div>-->
								<div class="form-body pal">


								
									<div class="row">
								<?php foreach ($Mysubscription as $subscription): ?>
										<div class="col-md-3">
											<div class="form-group" id="error-first_name">
												<div>
												
												<?php if($subscription->data[0]): ?>
													 <img src="images/gallery/<?php echo $subscription->data[0] ?>" />
													 <?php endif; ?>	
													Subscription Name:<?php echo $subscription->subscription_name;?><br />
													Amount:<?php echo $subscription->amount;?><br/>
													No of Bids:<?php echo $subscription->bids_number;?><br/>
													<div class="form-actions text-right pal">
										<input value="SUBSCRIBE" name="SUBSCRIBE" type="button" id="btn_next" class="btn btn-primary" onclick="Subscribe.SubmitForm('subscribe');"/>
										<input name="view" value="contact" type="hidden" />
										<input name="task" value="SaveRegister" type="hidden" />
										<input name="usertype" value="customer" type="hidden" />
									</div>
												</div>	
												
											</div>
										</div>	
								<?php endforeach ?>			
									</div>
								
									
									
									<div class="form-group">
								        <div class="col-md-10 col-md-offset-2">
								            <div id="messages"></div>
								        </div>
								    </div>
									<div class="form-actions text-right pal">
										<input value="NEXT" name="NEXT" type="button" id="btn_next" class="btn btn-primary" onclick="SignUp.SubmitForm('signup');"/>
										
										&nbsp;<button type="button" class="btn btn-primary" onclick="window.location = '<?php echo $this->site; ?>';" name="cancel">cancel</button>
										<input name="view" value="contact" type="hidden" />
										<input name="task" value="SaveRegister" type="hidden" />
										<input name="usertype" value="customer" type="hidden" />
									</div>
								</div><!-- End Form Body Panel -->
							</div>
						</div>
						<!-- end of form1 -->
					</form>
				</div><!-- End Yellow Panel -->
			</div><!-- End Column -->
		</div><!-- End Row -->
	</div>