<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>

<form id="leaderboard" method="POST" accept-charset="utf-8" action="leaderboard">
	   <input type="text" name="start_location"  placeholder="From Location " />
	   <input type="text" name="end_location" placeholder="To Location "/>
	   <input type="date" name="avaliable_date" placeholder="Date" />
	   <input type="submit" name="submit" value="Search" />
 </form>
 <div class="clear"></div>
 <div id="content_search_result" class="content_search_result" style="display:none;">
 </div>

