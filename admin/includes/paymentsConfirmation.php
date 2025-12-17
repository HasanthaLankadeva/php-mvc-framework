<?php
	require_once('db_connection/db_connection.php');
	require_once("includes/class.phpmailer.php");
	
	$emailAddress = 'hasantha88@gmail.com';
	$email = $fields[5];
	$name = $fields[6];
	$course_type = $fields[4];
	$course_name = $fields[3];
	
	if($course_type == 'video_course'){
		$packageItems = $fields[7];
		$days = (int)$period * (int)$packageItems;
		
		$content = '<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Thank you for purchasing the course - '.$course_name.'</p><p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Now you can watch the purchased course unlimited times until the date of expiry (within '.$days.' days from the  date of confirmed purhase)</p><p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Log in to your account and go to <b>My Library</b> section to view all your purchased courses.</p><p style="margin:0;padding-bottom:1em;">Have a nice and a happy time learning!</p>';
	}
	
	if($course_type == 'online_course'){
		$classDate = $fields[7];
		$classTime = $fields[8];
		$zoomLink = $fields[9];
		
		$content = '<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Thank You for payment for the Live Zoom Class - '.$course_name.'</p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Details of the Zoom Class</p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Date: '.$classDate.'</p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Time: '.$classTime.'</p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Use the link below to participate in the Live Zoom course</p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;"><a style="text-decoration: none;" href="'.$zoomLink.'" target="_blank">'.$zoomLink.'</a></p>
		<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Let’s meet at the Live session.</p>';
	}
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();

	// Set PHPMailer to use the sendmail transport
	$mail->IsMail();

	//Set who the message is to be sent from
	$mail->SetFrom($emailAddress, 'Investor Think');

	//Set an alternative reply-to address
	//$mail2->addReplyTo($email, $name);

	//Set who the message is to be sent to
	$mail->AddAddress($email);

	//Set the subject line
	$mail->Subject = 'Thank You for Your Purchase at Investor Think';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->MsgHTML('<!DOCTYPE html>
	<html>
	<head>
		<title>Email</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body style="width:100% !important;margin:0;padding:0;background-color:#eee;">
		<table border="0" style="width:100% !important;margin:0;padding:0;background-color:#eee;" width="100%">
			<tbody>
				<tr>
					<td>
						<table border="0" style="background-color: #ffffff;margin: 50px auto;width: 600px; border: 2px solid #dadada" align="center">
							<tbody style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#875f34;font-family:\'Helvetica Neue\', Arial;font-size:14px;line-height:130%;text-align:left;padding-top:9px;padding-bottom:9px;padding-left:18px;padding-right:18px;">
								<tr>
									<td style="padding-bottom: 0;padding-left: 20px;padding-right: 20px;padding-top: 20px; text-align: center;">
										<a href="https://investorthinkonline.com/" target="_blank" style="word-wrap:break-word;color:#15C;font-weight:normal;text-decoration:underline"><img align="center" alt="logo" src="https://investorthinkonline.com//images/logo.png" width="153" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;padding-bottom:0;display:inline;vertical-align:bottom;margin-right:0;max-width:90px;float: none;" /></a>
									</td>
								</tr>
								<tr>
									<td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 30px;color: #111111">
										<div class="kmParagraph" style="padding-bottom:9px;">
											<p style="color:#1b2952;font-size:18px;line-height:30px;">Dear '.$name.',</p>'.$content.'<p style="padding-bottom:1em;">Thank you.<br/>Yours Sincerely,<br/>Investor Think Team<br/><br/><br/><i>-This is an auto-generated email. Please do not reply to this email.- </i></p>
	                                    </div>
									</td>
								</tr>
								<tr>
									<td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 20px;text-align: center; color:#ffffff;background-color: #1e2434;">
										<div class="kmParagraph" style="padding-bottom:9px;padding-top: 9px;">
											<b><span style="font-size: 22px;">Investor<span style="color: #14bdee;">Think</span></span></b><br /><br /><a href="tel:+94713285402" title="Call us" style="text-decoration: none; color:#ffffff;">+94 713 285 402</a>
											<br /><a href="mailto:investor.think.web@gmail.com" title="Send E-mail" style="color:#ffffff;">investor.think.web@gmail.com</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	</html>');

	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	$mail->Send();
?>