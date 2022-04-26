<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email implements EmailBuilder
{
  /**
   * @param string $to
   * @param string $subject
   * @param string $body
   * @param string $alt_body
   * @return EmailBuilder
   */

  public function send(): EmailBuilder
  {
    $mail = new PHPMailer(true);

    //Enable SMTP debugging.
    $mail->SMTPDebug = $this->debug ? 3 : false;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = $_ENV['SMTP_HOST'];
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = $_ENV['SMTP_USERNAME'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = $_ENV['SMTP_PORT'];

    $mail->From = "no-reply@alexandre.business";
    $mail->FromName = "CMS";

    $mail->addAddress($this->to, "Alexandre BETTAN");

    $mail->isHTML(true);

    $mail->Subject = $this->subject;
    $mail->Body = $this->body;
    $mail->AltBody = $this->alt_body ?? "";

    try {
      $mail->send();
    } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }

    return $this;
  }
}
