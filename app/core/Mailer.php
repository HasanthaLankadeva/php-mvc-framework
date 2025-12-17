<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function send($to, $subject, $body, $attachments = [])
	{
		$config = require APP_PATH . '/config/mail.php';
		$mail = new PHPMailer(true);

		try {
			$mail->isSMTP();
			$mail->Host = $config['host'];
			$mail->SMTPAuth = true;
			$mail->Username = $config['username'];
			$mail->Password = $config['password'];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = $config['port'];

			$mail->setFrom($config['from'], $config['from_name']);
			$mail->addAddress($to);

			foreach ($attachments as $file) {
				if (file_exists($file)) {
					$mail->addAttachment(PUBLIC_PATH . '/' . $file);
				}
			}
			/*if ($attachment) {
				$mail->addAttachment(PUBLIC_PATH . '/' . $attachment);
			}*/

			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = nl2br($body);

			return $mail->send();
		} catch (Exception $e) {
			return false;
		}
	}
}
?>