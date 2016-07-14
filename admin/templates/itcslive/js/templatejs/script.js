jQuery.noConflict();
jQuery(document).ready(function(){
 jQuery(".placepicker").placepicker();								
 var screenwidth = jQuery(document).width();
 if(screenwidth <= 600)
  {
	 jQuery(".clientlogin").colorbox({iframe:true, width:"90%", height:"75%"});	 
	 jQuery(".truckavailibilty").colorbox({iframe:true, width:"90%", height:"75%"});	 
  }
 else
  { 
	 jQuery(".clientlogin").colorbox({iframe:true, width:"40%", height:"60%"});	 
	 jQuery(".truckavailibilty").colorbox({iframe:true, width:"40%", height:"80%"});	 
  }
 
 
 
 jQuery('.toggle-menu').jPushMenu();
 jQuery(".jPushMenuBtn").click(function(){
					clicks = clicks+1;
					if(clicks%2==0)
				 	 jQuery('.toggle-menu').removeClass('tgclose');
					else
				 	 jQuery('.toggle-menu').addClass('tgclose');
				}); 
jQuery('.search_truck').click(function(){
	jQuery("#truck").slideDown();
	jQuery("#load").slideUp();
	jQuery('.tab').removeClass('selected');
	jQuery('.search_truck').addClass('selected');
	
	//alert("subikar")
});

jQuery('.search_load').click(function(){
 //  alert("burman")
	jQuery("#truck").slideUp();
	jQuery("#load").slideDown();
	jQuery('.tab').removeClass('selected');
	jQuery('.search_load').addClass('selected');

});

 }); 
