<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>

<form id="leaderboard" method="POST" accept-charset="utf-8" action="leaderboard">
	<div class="input-group col-sm-4 inline">
		<span class="input-group-addon" id="basic-addon1" style="border-radius:5px 0 0 5px !important;"><i class="fa fa-map-marker"></i></span>																								
		<input type="text" name="start_location"  placeholder="From Location " />
	</div>
	   
	   <div class="input-group col-sm-4 inline" >
			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>													
			<input type="text" name="end_location" placeholder="To Location "/>
		</div>
			
			<div class="input-group col-sm-4 inline" >
					<span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>													
					<input type="date" name="avaliable_date" placeholder="Date" />		
					<span class="input-group-addon right-btn-load" style="min-width:65px;padding: 0px;background:#f78320;">
					<input type="submit" name="submit" value="Search" />					      	
					</span>				      	
			</div>
												
	   
	   
	   
 </form>
 <div class="clear"></div>
 <div id="content_search_result" class="content_search_result" style="display:none;">
 </div>

