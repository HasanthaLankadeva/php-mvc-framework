<?php
require(ADMIN_URL."includes/phpmailer.php");

$emailAddress = 'info@ceylonobs.com';
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

//Create a new PHPMailer instance
$mail = new PHPMailer();

// Set PHPMailer to use the sendmail transport
$mail->isSendmail();

//Set who the message is to be sent from
$mail->setFrom($email, $name);

//Set an alternative reply-to address
$mail->addReplyTo($email, $name);

//Set who the message is to be sent to
$mail->addAddress($emailAddress, 'COBS - Enquiry');

//Set the subject line
$mail->Subject = 'COBS - Enquiry';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('<!DOCTYPE html>
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
                        <tbody style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#875f34;font-family:'Helvetica Neue', Arial;font-size:14px;line-height:130%;text-align:left;padding-top:9px;padding-bottom:9px;padding-left:18px;padding-right:18px;">
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 20px; text-align: center;">
                                    <a href="https://ceylonobs.com" target="_blank" style="word-wrap:break-word;color:#15C;font-weight:normal;text-decoration:underline"><img align="center" alt="logo" src="https://ceylonobs.com/images/logo.png" width="153" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;padding-bottom:0;display:inline;vertical-align:bottom;margin-right:0;max-width:232px;float: none;" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 30px;color: #111111">
                                    <div class="kmParagraph" style="padding-bottom:9px">
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">
                                            Dear Admin,
                                        </p>
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">
                                            Below customer has submitted a new inquiry.
                                        </p>
                                        <table border="0" style="color: #111111;margin:0;width: 100%;font-family:'Helvetica Neue', Arial;font-size:14px;line-height:130%;text-align:left;">
                                            <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Name: '.$name.'</p>
											<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Email: '.$email.'</p>
											<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Phone: '.$phone.'</p>
											<p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Inquiry: '.$message.'</p>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 20px;text-align: center; color:#ffffff;background-color: #045371;">
                                    <div class="kmParagraph" style="padding-bottom:9px;padding-top: 9px;">
                                        <b>Ceylon Online Business School</b><br />No: 120, Kaluaggala<br />Hanwella<br />Sri Lanka<br /><a href="tel:+94765710930" title="Call us" style="text-decoration: none; color:#ffffff;">+94 76 571 0930</a>
                                        <br /><a href="mailto:info@ceylonobs.com" title="Send E-mail" style="color:#ffffff;">info@ceylonobs.com</a>
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

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

/*********************************************************************************************************/

//Create a new PHPMailer instance
$mail2 = new PHPMailer();

// Set PHPMailer to use the sendmail transport
$mail2->isSendmail();

//Set who the message is to be sent from
$mail2->setFrom($emailAddress, 'COBS - Enquiry');

//Set an alternative reply-to address
//$mail2->addReplyTo($email, $name);

//Set who the message is to be sent to
$mail2->addAddress($email, 'COBS - Enquiry');

//Set the subject line
$mail2->Subject = 'COBS - Enquiry';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail2->msgHTML('<!DOCTYPE html>
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
                        <tbody style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#875f34;font-family:'Helvetica Neue', Arial;font-size:14px;line-height:130%;text-align:left;padding-top:9px;padding-bottom:9px;padding-left:18px;padding-right:18px;">
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 20px; text-align: center;">
                                    <a href="https://ceylonobs.com" target="_blank" style="word-wrap:break-word;color:#15C;font-weight:normal;text-decoration:underline"><img align="center" alt="logo" src="https://ceylonobs.com/images/logo.png" width="153" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;padding-bottom:0;display:inline;vertical-align:bottom;margin-right:0;max-width:232px;float: none;" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 30px;color: #111111">
                                    <div class="kmParagraph" style="padding-bottom:9px">
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Dear '.$name.',</p>
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Thank you for contacting us.</p>
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">We have received your enquiry and will get back to you in due course.</p>
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;">Thank you.</p>
                                        <p style="margin:0;padding-bottom:1em;margin-bottom: 1em;"><i>-This is an auto-generated email. Please do not reply to this email.- </i></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 20px;padding-right: 20px;padding-top: 20px;text-align: center; color:#ffffff;background-color: #045371;">
                                    <div class="kmParagraph" style="padding-bottom:9px;padding-top: 9px;">
                                        <b>Ceylon Online Business School</b><br />No: 120, Kaluaggala<br />Hanwella<br />Sri Lanka<br /><a href="tel:+94765710930" title="Call us" style="text-decoration: none; color:#ffffff;">+94 76 571 0930</a>
                                        <br /><a href="mailto:info@ceylonobs.com" title="Send E-mail" style="color:#ffffff;">info@ceylonobs.com</a>
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
$mail2->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send() || !$mail2->send()) {
    $data = "false";
} else {
    $data = "success";
}

echo json_encode($data);
?>