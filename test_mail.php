<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Ensure this path is correct

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
    $mail->SMTPAuth = true;
    $mail->Username = 'fyfic18@gmail.com';  // SMTP username
    $mail->Password = 'coswytytefkadcaq';  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('no-reply@yourwebsite.com', 'Mailer');
    $mail->addAddress('nourilsaneh@gmail.com');  // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a <b>test</b> email.';

    // Enable verbose debug output
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
