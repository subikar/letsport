<?php
defined ('ITCS') or die ("Go away.");
$id=IRequest::getVar(id);
global $my,$mainframe;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	 <form action="" id="win_bid" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<div style="display: none;">
		  
		  
		  
		</div>
		
		
<div class="row">
		<div class="container">	
				
				
				<div class="col-md-2">
						<label>Start Date Time </label>						
				</div>	
				
				<div class="col-md-4">
						<label>Location </label>
					</div>
					<div class="col-md-2">
							<label>Vehicle Type </label>
					
					</div>
					<div class="col-md-2">
							<label>Material Type</label>
					
					</div>	
					
					<div class="col-md-2">
						<label>Consignment Weight</label>
					
					</div>								
			</div>										
								
</div>
		
		
						 
			 <div class="row">
			 	<div class="container">
			 <?php foreach($this->TrucksAvailable as $Available):?>
			 	
			<div class="col-md-2"><?php echo date('d M Y',strtotime($Available->avaliable_date))?> <?php echo $Available->reporting_time; ?></div>
			 <div class="col-md-4"><?php echo $Available->start_location?> <?php echo $Available->end_location; ?></div>
			 <div class="col-md-2"><?php echo $Available->vehicle_type; ?></div>
			 <div class="col-md-2"><?php echo $Available->material_type; ?></div>
			 <div class="col-md-2"><?php echo $Available->consignment_weight; ?></div>
			 <?php endforeach; ?>
				</div>
			</div>
		
		
		
		
		
		
		
		
		<br/><br/><br/>
		
		
		<div class="row">
			<div class="container">	
 
						<div class="col-md-3"><label>Name</label></div>
						<div class="col-md-3"><label>Material Type</label></div>
                        <div class="col-md-3"><label>Amount</label></div>
                        <div class="col-md-3"><label>Action</label></div>					 
 			</div>
 		</div>
                    	<?php //print_r($this->TruckBids); ?>
					   <?php  foreach($this->TruckBids as $bids): ?>   
					  
		<div class="row">
			<div class="container">	
						
                        <div class="col-md-3"><?php echo $bids->name; ?></div>
						<div class="col-md-3"><?php echo $bids->bid_text->material_type; ?></div>
						<div class="col-md-3"><?php echo $bids->bid_text->price; ?></div>
						 
                        <div class="col-md-3">	
                        <input type="hidden" name="bid_id" value="<?php  echo $bids->bid_id;  ?>" />
                    	<input name="view" value="contact" type="hidden" />
						<input name="task" value="winbidtruck" type="hidden" />
                        <input value="WIN BID" name="win_bid" type="button" id="btn_next" class="btn btn-primary" onclick="win_bid_truck.SubmitForm('win_bid');"/>
						</div>
                      
                      <?php  endforeach; ?> 
	    </div>
			</div>	
                            <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
                          
                     
            
		</div>
		
	 </form>
		    
		 </div>
	  </div>
   </div>
</div>



