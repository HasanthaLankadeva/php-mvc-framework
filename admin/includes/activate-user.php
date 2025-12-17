<?php
require_once("../admin/includes/class.phpmailer.php");

$emailAddress = 'admin@investorthinkonline.com';
$email = $fields[2];
$name = $fields[1];

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
$mail->Subject = 'Welcome to Investor Think';

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
									<a href="https://investorthinkonline.com/" target="_blank" style="word-wrap:break-word;color:#15C;font-weight:normal;text-decoration:underline"><img align="center" alt="logo" src="https://investorthinkonline.com/images/logo.png" width="153" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;padding-bottom:0;display:inline;vertical-align:bottom;margin-right:0;max-width:90px;float: none;" /></a>
								</td>
							</tr>
							<tr>
								<td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 30px;color: #111111">
									<div class="kmParagraph" style="padding-bottom:9px;">										
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Dear '.$name.'</p>
                                        <p style="margin:0;padding-bottom:1em;">Welcome!</p>
										<p style="margin:0;padding-bottom:1em;">Thank You for registering with Investor Think.</p>
										<p style="margin:0;padding-bottom:1em;">Now you can access all your learning content via your Android/iOS device or PC.</p>
										<p style="margin:0;padding-bottom:3em;">Here are your Login details:<br/><br/><br/><b>Web Address:</b> <a href="www.investorthinkonline.com/login.html" target="_blank" style="text-decoration:none;">www.investorthinkonline.com</a><br/><b>Username:</b> '.$email.'</p>
										<p style="margin:0;padding-bottom:1em;">Write to us  : <a href="mailto:investor.think.web@gmail.com" style="text-decoration:none;">investor.think.web@gmail.com</a> for any doubts and use the Contact us section to seek any support.</p>
										<p style="margin:0;padding-bottom:2em;">Have a nice and a happy time learning!</p>
										<p style="margin:0;padding-bottom:1em;">Yours Sincerely,<br/>Investor Think Team</p>
                                        <p style="padding-bottom:1em;margin-bottom: 1em;"><i>-This is an auto-generated email. Please do not reply to this email.- </i></p>
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

//send the message, check for errors
!$mail->Send()

?>