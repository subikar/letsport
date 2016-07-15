<?php $PackageName=$this->PackageName; 
$name=IRequest::getVar("Name");
//print_r($name);exit;
?>
<form action="" method="post" class="form-horizontal getofferForm" name="GetFreeQuote" id="GetFreeQuote" target="_parent">
<div class="container popupform">

			<div class="grid_4">
					
			</div>

			Thank you for subscribing to <?php echo $name ?>...<br/>
			Please wait for some time we will activate your subscription. 

			

				 		
		 </div>   
							<input type="hidden" name="view" value="contact" />
							<input type="hidden" name="task" value="createticket" />
							<input type="hidden" name="form" value="GetFreeQuote" />
							<input type="hidden" name="category" value="15" />
							<script type="text/javascript">
							  jQuery(document).ready(function(){
							    getfreequote.addKey('GetFreeQuote');
                                })
							</script>
							<div class="clear"></div>
							<label class="message">
	
							</label>			

		<div class="clear"></div>
		<p>
	
        </div>
</form> 