<?php 
  class IMail {
       var $From=NULL;
	   var $To=NULL;
	   var $Subject=NULL;
	   var $Message=NULL;
	   var $file_to_attach=NULL;
	   function __construct()
	     {
			 
		 }
		function send()
		{
		    global $params;
			$userparam = $params->getParams('user');
			$MailType = $userparam['mail_st'];
			//print($MailType); exit;
			$MailType = 'Falconide';
			if($MailType == 'Server')
			  { 
					include_once('Mail.php');
					require_once('Mail/mime.php');
					$headers=array();
					$headers["MIME-Version"] = "1.0";
					$headers["Content-type"]="text/html;charset=UTF-8";
					$headers["From"]=$this->From;
					$headers["Subject"]=$this->Subject;
					$headers["Reply-To"]="iTCSLive<info@itcslive.com>";
					$headers["Return-Path"]=$this->From;
					
					$mime = new Mail_mime(array('eol' => "\n"));
					$mime->setTXTBody("First Attach Mail");
					$mime->setHTMLBody($this->Message);
					
					if($this->file_to_attach!=NULL && file_exists($this->file_to_attach))
					{
						$file_name=basename($this->file_to_attach);
						$mime->addAttachment($this->file_to_attach, 'text/plain');
					}
					$body = $mime->get();
					$headers = $mime->headers($headers);
					$to=$this->To;
					
					$mail = Mail::factory("mail");
					$mail->send($to, $headers, $body);
			  }
			 elseif($MailType == 'Falconide')
			   {
					$api_key = '586a917fac2c8bdfaaf85d3de6cef14a';
					$subject = $this->Subject;
					$from = $this->From;
					$from_name = $userparam['mail_sender_name'];
					$content = $this->Message;
					$recipients = $this->To;
					
					//$this->To;
					$url = "https://api.falconide.com/falconapi/web.send.rest"; 
					$fields = array(
									'api_key' => $api_key,
									'subject' =>rawurlencode($subject),
									'from' => $from,
									'fromname' => $from_name,
									'replytoid' => $from,
									'content' => rawurlencode($content),
									'recipients' => $recipients
								   );
					//url-ify the data for the POST
					foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
					rtrim($fields_string, '&');
					
					//print_r($fields_string); exit;
					//open connection
					$ch = curl_init();
					
					//set the url, number of POST vars, POST data
					curl_setopt($ch,CURLOPT_URL, $url);
					curl_setopt($ch,CURLOPT_POST, count($fields));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
					//execute post
					$response = curl_exec($ch);
					//print_r($response); exit;
					//close connection
					curl_close($ch);
			
					if(is_string($response) && $response == 'success'){
						return true;
					}else{
						return false;
					}					  

			    
			   } 
		} 
	}	 
?>