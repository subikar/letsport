<?php
	error_reporting(0);
	defined ('ITCS') or die ("Go away.");
	global $Config;
?>

<div id="primary" class="pop_background" >
   <div role="main" id="contactus">
      <div class="article-body">
         <div class="wpcf7">
		 
		 <div class="popup_heading"><?php echo $this->workDetails->title; ?></div>
		
		<div class="our_work"> 
		 <div class="description"><?php echo $this->workDetails->project_description; ?>
		 </div>
		 </div>
		 </div>
      </div>
   </div>
</div>

<script>
     function hidePopup(){
	var someIframe = window.parent.document.getElementById('pop-up-frame');
	someIframe.remove();
}                                                                           
</script>


<!--sujay-->
<style>
#pop-up-frame,#pop-up-Iframe{ border-radius:12px;}
.popup_heading{ color:#FFFFFF; text-align:center; font-size:36px; padding:10px; border-radius:12px 12px 0 0; background:#1B6488; 
}
.our_work{ background:#000000; opacity:0.8; border-radius:0 0 12px 12px; height: 430px; 
}
.description{ padding:20px 30px;color:#FFFFFF; opacity:1; overflow:auto; height:390px;
}
 .close_pop {float:right; font-size:22px; margin:6px; 
 }
 .close_pop a{ padding:0 5px;background:#ffffff; border-radius:50%;
 } 
 .close_pop a:hover{
 background:#33CCFF;
 }
</style>