<?php
	require_once('config.php');
	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
	
	$client = new Google_Client();
	$client->setClientId($oauth_client_id);
	$client->setClientSecret($oauth_secret);
	$client->setRedirectUri($oauth_redirect);
	$client->setScopes(array('https://www.googleapis.com/auth/userinfo.profile',
							 'https://www.googleapis.com/auth/userinfo.email',
							 'https://www.googleapis.com/auth/drive',
                             'https://www.googleapis.com/auth/calendar',
							 'https://www.googleapis.com/auth/drive.apps.readonly'));
	$client->setUseObjects(true);
	$client->setApplicationName("Itcslive");
	
	$service = new Google_DriveService($client);
	
	$authUrl = $client->createAuthUrl();
	header('Location: ' . $authUrl);
?>
