<?php
include_once '../model/usuario_model.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';




$usuario = new Usuario();
if ($_POST['funcion'] == 'verificar') {
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $usuario->verificar($email, $dni);
}

if ($_POST['funcion'] == 'recuperar') {
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $codigo = generar(10);
    //echo $codigo;
    $usuario->reemplazar($codigo, $email, $dni);

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'javier_40_2@hotmail.com';                     //SMTP username
        $mail->Password   = '122688jbr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('javier_40_2@hotmail.com', 'Sistema Administativo');
        $mail->addAddress($email);     //Add a recipient
        ////$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content - Aquí va el mensaje ----
        $mensaje = $codigo;
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reestablecer contraseña';
        $mail->Body    = $mensaje;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPDebug = false;
        $mail->do_debug = false;
        $mail->send();
        echo 'Enviado';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function generar($longitud)
{
    $key = '';
    $patron = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($patron) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $key .= $patron[mt_rand(0, $max)];
    }
    return $key;
}
