<?php
error_reporting(0);
defined ('ITCS') or die ("Go away.");
global $my,$Config;
$Threads=$this->TicketDetails; //print_r($Config);exit;
?>
<link href="<?php echo $Config->site?>templates/itcslive/js/ajaxupload/assets/css/style.css" rel="stylesheet" />
<form id="upload" method="post" enctype="multipart/form-data">
			<div id="drop">
				Drop Here

				<a>Browse</a>
				<input type="file" name="upl" multiple />
			</div>
				  <input type="hidden" name="view" value="myticket" />
                  <input type="hidden" name="task" value="ajaxUpload" />
                  <input type="hidden" name="ticket_id" value="<?php echo JRequest::getInt('id'); ?>" />
			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<!--<script src="<?php //echo $Config->site?>templates/itcslive/js/ajaxupload/assets/js/jquery.knob.js"></script>-->

		<!-- jQuery File Upload Dependencies -->
		<!--<script src="<?php //echo $Config->site?>templates/itcslive/js/ajaxupload/assets/js/jquery.ui.widget.js"></script>
		<script src="<?php //echo $Config->site?>templates/itcslive/js/ajaxupload/assets/js/jquery.iframe-transport.js"></script>-->
		<script src="<?php echo $Config->site?>templates/itcslive/js/ajaxupload/assets/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
		<script src="<?php echo $Config->site?>templates/itcslive/js/ajaxupload/assets/js/script.js"></script>


		<!-- Only used for the demos. Please ignore and remove. --> 
        <script src="http://cdn.tutorialzine.com/misc/enhance/v1.js" async></script>