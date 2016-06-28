$(document).ready(function(){
 ContentGallery.getGallery(1);
});  
var ContentGallery=new function()
{
	this.getGallery=function(page)
	{
		 jQuery.post("contact", {view:"contact",task:"getGallery",page_count:page,gallery:'<?php echo $Content; ?>',width:'<?php echo $Width?>',height:'<?php echo $Height; ?>',limit:'<?php echo $Limit; ?>' },
		function(data)
		{
			//alert(data);
			var result=JSON.parse(data,true);
			jQuery("#gallery_area").html(result["result_html"]);
			jQuery(".gallery").colorbox({rel:'gallery'});
		});
	
	}
}
