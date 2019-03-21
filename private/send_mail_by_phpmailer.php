<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function send_mail($email, $hash){
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		
		$mail->ClearAllRecipients( );
		
		//Server settings
		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'amdroman50@gmail.com';                 // SMTP username
		$mail->Password = '1pasw22222';                           // SMTP password
		// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		

		//Recipients
		$mail->setFrom('amdroman50@gmail.com', 'Mailer');
		$mail->addAddress($email);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
		
		//Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
		
		//link of domain
		
		$root_of_domain = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
		// $url = $_SERVER['REQUEST_URI']; //returns the current URL
		$url = get_directory(); //returns the current URL
		$root_of_domain = $root_of_domain . $url;
	
		//Content
		
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Verify your account';
		$mail->Body = 'Please click this link to activate your account:<br/>'.
			$root_of_domain.'verify.php?email='.$email.'&hash='.$hash.'';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		
		$mail->send();
		return true;
		// echo 'Message has been sent';
	} catch (Exception $e) {
		return false;
		// echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
}
?>