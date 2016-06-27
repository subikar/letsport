<?php
	defined ('ITCS') or die ("Go away.");
	$link_Id = IRequest::getVar('linkId');
	$Link=explode("_",$link_Id);
	$type=$Link[0];
	$typeID=$Link[1];
	global $my,$Config;
if($type!=NULL && (int)$typeID > 0):	
?>
<div class="file_select_box">
<div id="tabs">
	<div class="attach_menu">
		<ul>
			<li id="li_mycomputer" class="activ">
				<a onclick="Attach.attachTab('mycomputer');" href="javascript:void(0);">My Computer</a>
			</li> 				
			<li id="li_googledrive">
				<a onclick="Attach.attachTab('googledrive');" href="javascript:void(0);">Google Drive</a>
			</li>						
		</ul>
			  
	</div>
	<div id="div_mycomputer">
		<form id="fileupload" method="post" enctype="multipart/form-data">
			<span id="imgMessage"></span>
			<div class="file_upload"><input id="file_input" type="file" name="files" onchange="Attach.uploadimg(this)" />
			<span><img id="img_progress" src="<?php echo $Config->site; ?>images/photo_loader.gif" style="width:200px; height:20px; display:none;"/></span>
			<span class="sp_image_upload" id="uploadedImage"></span>
			<span id="msg"></span>
			</div>
			<br />
			<input type="hidden" name="view" value="attach" />
			<input type="hidden" name="task" value="ajaxUpload" />
			<input type="hidden" name="type" value="<?php echo $type; ?>" />
			<input type="hidden" id="getlinkId" name="link_id" value="<?php echo $typeID; ?>" />
			<input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo $Config->site; ?>" />
		</form>
		<div class="login_btns" style="text-align:center;">
			<input type="submit" value="Attach" class="login btn_1" onclick="Attach.submitform('fileupload');"  />
		</div>
		
		<?php else: ?>
			<p>SORRY!! You are not Authorized to attach File!</p>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
	<div id="div_googledrive" style="display:none;">
<?php
		
	require 'config.php';
	require_once 'google-api-php-client/src/io/Google_HttpRequest.php';
	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
	if(count($this->google_token) != 0)
	{
		$token_key = $this->google_token->token_key;
		$client = new Google_Client();
		$client->setClientId($oauth_client_id);
		$client->setClientSecret($oauth_secret);
		$client->setRedirectUri($oauth_redirect);
		$client->setScopes(array('https://www.googleapis.com/auth/userinfo.profile',
									 'https://www.googleapis.com/auth/userinfo.email',
									 'https://www.googleapis.com/auth/drive',
									 'https://www.googleapis.com/auth/calendar',
									 'https://www.googleapis.com/auth/drive.apps.readonly'));
		
		$service = new Google_DriveService($client);
		$client->setAccessToken($token_key);
		$file = new Google_DriveFile();
		$listAllFiles = $service->files->listFiles($token_key);
		$i = 0;
		foreach($listAllFiles['items'] as $value):?>
		<form id="googlefileupload" method="post" enctype="multipart/form-data">
		<?php   $id = "file".$i;
			if($value['webContentLink'] != ''): 
				$drivefileDetails = implode(",",array("title"=>$value['title'],"webContentLink"=>$value['webContentLink'],"iconLink"=>$value['iconLink']));
		?>
				<input type="radio" name="googlefile" id="<?php echo $id;?>" value="<?php echo $drivefileDetails; ?>" /><img src="<?php echo $value['iconLink']; ?>" /><?php echo " ".$value['title']; ?>
				<br />
			<?php else: ?>
				<input type="radio" name="googlefile"  id="<?php echo $id;?>" value="<?php echo $value['title']; ?>" onclick="alert('Please at first share your document with ITCSLIVE.');document.getElementById('<?php echo $id; ?>').checked = false;" /><img src="<?php echo $value['iconLink']; ?>" /><?php echo " ".$value['title']; ?><br />
	<?php		endif;  $i++;	endforeach; ?>
			<div class="login_btns" style="text-align:center;">
				<input type="hidden" name="view" value="attach" />
				<input type="hidden" name="task" value="googleupload" />
				<input type="submit" value="Attach" class="login btn_1" />
			</div>
		</form>
	<?php }
	else
	{
		echo "<a target='_parent' href='".$Config->site."dashboard'>Link Google Account</a>";
	}
?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function()
{
	parent.jQuery.colorbox.resize({width:"50%", height:"70%"});
});
</script>

