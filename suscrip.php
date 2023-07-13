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
    $mail->addReplyTo($eMail);
    //debuguear($mail);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Nuevo suscriptor a noticias";
    $mail->Body    = "El suario del correo: ".$eMail." "."<br/>"."Desea conocer mas sobre la empresa, envia la carta de presentación"."<br/>"."MashaCorp Asistente";
    //debuguear("hola...");

    $mail->CharSet ='UTF-8';

    $mail->send();
    
    header('location: index.php?v=1');
        exit;
} catch (Exception $e) {
    header('location: index.php?v=2');
        exit;
};