<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    //

    public function sendMail($to,$subject,$msg){
        $mail = new PHPMailer(true);
        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'kalpavrikshacoir.industries'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'no-reply@kalpavrikshacoir.industries';                     // SMTP username
            $mail->Password   = 'Money@2k21';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('no-reply@kalpavrikshacoir.industries', 'Money App');
            $mail->addAddress($to, substr($to,0,5));     // Add a recipient
            $mail->addReplyTo($to, substr($to,0,5));
            //$mail->addCC('madhumankatha@gmail.com');
            //$mail->addBCC('madhumankatha@gmail.com');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $msg;
            $mail->AltBody = $msg;

            if( !$mail->send() ) {
                echo "FAILED";
                return "FAILED";
            }

            return "successEmail has been sent.";
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            echo $e->errorMessage();
            return "error Message could not be sent.";
        }
    }
}

