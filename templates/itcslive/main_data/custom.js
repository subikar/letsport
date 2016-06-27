jQuery(document).ready(function() {
 
	function megaHoverOver(){
		jQuery(this).find(".sub").stop().fadeTo('fast', 1).show();
			
		//Calculate width of all ul's
		(function(jQuery) { 
			jQuery.fn.calcSubWidth = function() {
				rowWidth = 0;
				//Calculate row
				jQuery(this).find("ul").each(function() {					
					rowWidth += jQuery(this).width(); 
				});	
			};
		})(jQuery); 
		
		if ( jQuery(this).find(".row").length > 0 ) { //If row exists...
			var biggestRow = 80;	
			//Calculate each row
			jQuery(this).find(".row").each(function() {							   
				jQuery(this).calcSubWidth();
				//Find biggest row
				if(rowWidth > biggestRow) {
					biggestRow += rowWidth;
				}
			});
			//Set width
			//jQuery(this).find(".sub").css({'width' :biggestRow});
			jQuery(this).find(".row:last").css({'margin':'0'});
			
		} else { //If row does not exist...
			
			jQuery(this).calcSubWidth();
			//Set Width
			//jQuery(this).find(".sub").css({'width' : rowWidth});
			
		}
	}
	
	function megaHoverOut(){ 
	  jQuery(this).find(".sub").stop().fadeTo('fast', 0, function() {
		  jQuery(this).hide(); 
	  });
	}
 
	var config = {    
		 sensitivity: 1, // number = sensitivity threshold (must be 1 or higher)    
		 interval: 1, // number = milliseconds for onMouseOver polling interval    
		 over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
		 timeout: 1, // number = milliseconds delay before onMouseOut    
		 out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
	};
 
	jQuery("ul#topnav li .sub").css({'opacity':'0'});
	jQuery("ul#topnav li").hoverIntent(config);
 
});  


jQuery(function() {
		jQuery('ul#basic_config').carouFredSel();
		jQuery('#vn').carouFredSel({
			auto: false,
			items: 'variable',
			next: '#next',
			prev: '#prev'
		});
});
				<!--Our Customer-->
jQuery(function() {
		jQuery('ul#basic_config').carouFredSel();
		jQuery('#vnoviwvw').carouFredSel({
			auto: false,
			items: 'variable',
			next: '#next2',
			prev: '#prev2'
		});
});
			
jQuery(function() {
		jQuery('ul#basic_config').carouFredSel();
		jQuery('#small').carouFredSel({
			auto: false,
			items: 'variable',
			next: '#next3',
			prev: '#prev3'
		});
});
			
jQuery(function() {
		jQuery('ul#basic_config').carouFredSel();
		jQuery('#news').carouFredSel({
			auto: true,
			items: 'variable',
			next: '#next4',
			prev: '#prev4'
		});
});
	

jQuery(function() {
		jQuery('#cs-info').carouFredSel({
			auto: false,
			items: 'variable',
			next: '#next5',
			prev: '#prev5'
		});
});

$(function() {
		jQuery('ul#basic_config').carouFredSel();
		jQuery('#latest').carouFredSel({
			auto: true,
			items: 'variable',
			next: '#next6',
			prev: '#prev6'
		});
});




jQuery(document).ready(function() {	
	var total_tabs = 9;
	var content_height = 300;
	jQuery("#htabs .htabs-content-wrap").scrollTop(0);
	jQuery("#htabs .tabs li").hover(function(){
			if(jQuery(this).hasClass('active') == false)
		{
			jQuery("#htabs .tabs li").removeClass('active');
			jQuery(this).addClass('active');
			for(i = 1; i <= total_tabs; i++)
				if(jQuery(this).hasClass('tab'+i) == true)
				{
					jQuery("#htabs .htabs-content-wrap").stop().animate({scrollTop: content_height * (i - 1)}, 500);
					
				}
		}
	});	
});


