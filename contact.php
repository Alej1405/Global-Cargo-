<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'includes/app.php';
require 'vendor/autoload.php';

$eMail = $_POST['email'];
$lead = $_POST['name'];
$subject = $_POST['subject'];
$mensaje = $_POST['message'];
//debuguear($_POST);

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.mashacorp.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'francisco@mashacorp.com';                     //SMTP username
    $mail->Password   = 'francisco2023';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('francisco@mashacorp.com', 'Global Cargo desde Web');
    $mail->addAddress('francisco@globalcargoecuador.com', 'Francisco');     //Add a recipient
    $mail->addAddress('lineas1405@gmail.com', 'Verificacion');               //Name is optional
    $mail->addReplyTo($eMail, $lead);
    //debuguear($mail);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $mensaje."<br/>"."Este mensaje fue enviado por: ".$lead."<br/>"."Desde el correo".$eMail;

    $mail->send();
    $validacion = $mail->ErrorInfo;

    if(empty($validacion)){
        header('location: index.php?v=1');
        exit;
    }
    debuguear($mail->ErrorInfo);


    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
};