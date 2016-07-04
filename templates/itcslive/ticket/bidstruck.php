<?php
defined ('ITCS') or die ("Go away.");

global $my,$mainframe;
?>
<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body"> 
	  <div class="wpcf7" id="wpcf7-f1533-p61-o1" dir="ltr">
	 <form action="" id="addContactForm" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<div style="display: none;">
		   <input type="hidden" name="view" value="dashboard" />
		   <input type="hidden" name="task" value="savedriver" />
		   <input type="hidden" name="driver_owner" value="<?php  echo $my->uid;  ?>" />
		   <input type="hidden" name="driver_id" value="<?php  echo $Driver->driver_id;  ?>" />
		</div>
		
		
		
		
		
			<table>			 
			 <tr>
				 <th style="width: 20%" >Start Date Time</th>
				 <th style="width: 30%">Location</th>
				 <th style="width: 15%">Vehicle Type</th>
				 <th style="width: 20%">Material Type</th>
				 <th style="width: 15%">Consignment Weight</th>
				<!-- <th>Bids Recieved</th>-->
			 </tr>
			 <?php foreach($this->TrucksAvailable as $Available):?>
			 <tr>
			 <td style="text-align: center"><?php echo date('d M Y',strtotime($Available->avaliable_date))?> <?php echo $Available->reporting_time; ?></td>
			 <td style="text-align: center"><?php echo $Available->start_location?> <?php echo $Available->end_location; ?></td>
			 <td style="text-align: center"><?php echo $Available->vehicle_type; ?></td>
			 <td style="text-align: center"><?php echo $Available->material_type; ?></td>
			 <td style="text-align: center"><?php echo $Available->consignment_weight; ?></td>
			 </tr> 	
			 <?php endforeach; ?>
			
		</table>
		
		
		
		
		
		
		
		
		<br/><br/><br/>
		
		
		<div class="table_edituser">
 <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
						<th>Name</th>
						<th>Material Type</th>
                        <th>Amount</th>
                        <th>Action</th>					 
                      </tr>
                    </thead>
                    <tbody class="selects">
                    	<?php //print_r($this->TruckBids); ?>
					   <?php  foreach($this->TruckBids as $bids): ?>   
					  
					  	<tr>
                        <td style="text-align: center"><?php echo $bids[0]->name; ?></td>
						<td style="text-align: center"><?php echo $bids[1]->material_type; ?></td>
						<td style="text-align: center"><?php echo $bids[1]->price; ?></td>
                        <td> <input type="submit" value="win Bid" id="win_bid" /></td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() --> 
                      <?php  endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;"><div class="clearfix">
                            <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
                          </div></td>
                      </tr>
                    </tfoot>  
                  </table>
            
		</div>
		
	 </form>
		    
		 </div>
	  </div>
   </div>
</div>



