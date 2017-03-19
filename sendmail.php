<?php
$data = file_get_contents('php://input');
$parsed = simplexml_load_string($data);
$name = $parsed[0]->to['name'][0];
/**
 * Sends email via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

$path = $_SERVER['DOCUMENT_ROOT'];
require_once("$path/PHPMailer/PHPMailerAutoload.php");

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "vbalasu@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "N1th1n222";

//Set who the message is to be sent from
$mail->setFrom('support@cloudmatica.com', 'Cloudmatica Support');

//Set an alternative reply-to address
$mail->addReplyTo('support@cloudmatica.com', 'Cloudmatica Support');

//Set who the message is to be sent to
$mail->addAddress($parsed[0]->to, $name);

//Set the subject line
$mail->Subject = $parsed[0]->subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($parsed[0]->body);
//$mail->msgHTML("This is a test");

//Replace the plain text body with one created manually
$mail->AltBody = $parsed[0]->body;

//Attach an image file
//$mail->addAttachment('attachment.txt');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}