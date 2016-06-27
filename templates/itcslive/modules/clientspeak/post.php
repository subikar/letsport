<?php defined ('ITCS') or die ("Go away.");
$i=0;
?>
<h3 class="bot-1">Clients Speaks(<?php echo $this->ClientsSpeakCount; ?> Results)</h3>
<div id="clientspeak_area">
<img src="<?php echo $Config->site; ?>templates/itcslive/images/search_content-loader.gif" />
</div>
<div id="pagination"></div>
<script type="text/javascript">
 $(document).ready(function(){
	Clientspeak.searchThread(1);
  }); 
  
var Clientspeak=new function()
{
	this.searchThread=function(page)
	{
		  jQuery.post("contact", {view:"contact",task:"clientSPeak",page_count:page},
			function(data)
			{
				var result=JSON.parse(data,true);
				jQuery("#clientspeak_area").html(result["result_html"]);
				jQuery("#pagination").html(result["pagination"]);
			});
	}
}
</script>