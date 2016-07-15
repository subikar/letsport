<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>
<ul class="quick-contact">
	<li class="top_help_button search_truck tab selected"><i class="fa fa-car" aria-hidden="true"></i>Search Truck</li>
	<li class="top_coll_button search_load tab ta2"><i class="fa fa-tasks" aria-hidden="true"></i>Search Load</li>
</ul>
<div class="form-group">
	
<form id="truck" method="POST" accept-charset="utf-8" action="search-truck">
	<div class="input-group col-sm-2 inline">
		<span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>																								
		<input type="text" name="start_location" id="start_location"  placeholder="From Location " autocomplete="off" class="placepicker form-control" />
	</div>
	   
	   <div class="input-group col-sm-2 inline" >
			<span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>													
			<input type="text" name="end_location" placeholder="To Location" class="placepicker form-control"/>
		</div>
		<div class="input-group col-sm-2 inline" >
			<span class="input-group-addon" ><i class="fa fa-truck"></i></span>													
			<select id="vehicle_type_id" name="vehicle_type_id">
										<option value="1">Truck type</option>
										<option value="2">Trailer</option>
										<option value="2">Tipper</option>
										<option value="3">Container</option>
										<option value="4">Tractor</option>
										<option value="5">Pick-up</option>
										<option value="6">Tempo</option>
										<option value="7">Refrigerated</option>
										<option value="8">Tanker</option>
										<option value="9">Flatbed</option>
										<option value="10">6 Wheel Truck</option>
										<option value="11">10 Wheel Truck</option>
										<option value="12">12 Wheel Truck</option>
										<option value="13">20 Ft Container Truck</option>
										<option value="14">24 Ft Single-Axle Container Truck</option>
										<option value="15">24 Ft Multi-Axle Container Truck</option>
										<option value="16">32 Ft Single-Axle Container Truck</option>
										<option value="17">32 Ft Multi-Axle Container Truck</option>
										<option value="18">Other Container Truck</option>
										<option value="19">14 Wheel Truck</option>
										<option value="20">19 Ft Open Body Truck</option>
				</select>
		</div>
		<div class="input-group col-sm-2 inline" >
			<span class="input-group-addon" ><i class="fa fa-automobile"></i></span>													
			<input type="text" name="consignment_weight" placeholder=" Load "/>
		</div>
		
			<div class="input-group col-sm-2 inline " >
					<span class="input-group-addon" ><i class="fa fa-calendar"></i></span>													
					<input type="date" name="avaliable_date" placeholder="Date" />		
					<span class="input-group-addon right-btn-load " style="min-width:65px;padding: 0px;background:#5f615f;">
					<input type="hidden" name="order" value="desc"/>
					<input type="submit" name="submit" value="Search" />					      	
					</span>				      	
			</div>
		
	   
	   
 </form>
 
<form id="load" method="POST" accept-charset="utf-8" action="search-load" style="display:none;">
	<div class="input-group col-sm-1 inline sour">
		<span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>																								
		<input type="text" name="start_location"  placeholder="From Location" class="placepicker form-control" />
	</div>
	<div class="input-group col-sm-1 inline sour">
		<span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>																								
		<input type="text" name="end_location"  placeholder="To Location" class="placepicker form-control" />
	</div>
	   
	   <div class="input-group col-sm-1 inline sour" >
			<span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>													
			<input type="text" name="end_location" placeholder="Material  "/>
		</div>
		<div class="input-group col-sm-2 inline" >
			<span class="input-group-addon" ><i class="fa fa-truck"></i></span>													
			<select id="vehicle_type_id" name="vehicle_type_id">
										<option value="1">Truck type</option>
										<option value="21">Trailer</option>
										<option value="2">Tipper</option>
										<option value="3">Container</option>
										<option value="4">Tractor</option>
										<option value="5">Pick-up</option>
										<option value="6">Tempo</option>
										<option value="7">Refrigerated</option>
										<option value="8">Tanker</option>
										<option value="9">Flatbed</option>
										<option value="10">6 Wheel Truck</option>
										<option value="11">10 Wheel Truck</option>
										<option value="12">12 Wheel Truck</option>
										<option value="13">20 Ft Container Truck</option>
										<option value="14">24 Ft Single-Axle Container Truck</option>
										<option value="15">24 Ft Multi-Axle Container Truck</option>
										<option value="16">32 Ft Single-Axle Container Truck</option>
										<option value="17">32 Ft Multi-Axle Container Truck</option>
										<option value="18">Other Container Truck</option>
										<option value="19">14 Wheel Truck</option>
										<option value="20">19 Ft Open Body Truck</option>
				
				
				
				</select>


	
		</div>
		<div class="input-group col-sm-1 inline sour" >
		
		
			<span class="input-group-addon" ><i class="fa fa-automobile"></i></span>													
			
			
			<input type="text" name="consignment_weight" placeholder="Load "/>
		
		
		</div>
			
			<div class="input-group col-sm-2 inline sear" >
					<span class="input-group-addon" ><i class="fa fa-calendar"></i></span>													
					<input type="date" name="avaliable_date" placeholder="Date" />		
					<span class="input-group-addon right-btn-load serspan">
					<input type="hidden" name="order" value="desc"/>			
					<input type="submit" name="submit" value="Search" />					      	
					</span>				      	
			</div>
												
	   
	   
	   
 </form>
 <div class="clear"></div>
 </div>