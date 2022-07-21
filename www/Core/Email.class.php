<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Model\Settings as SettingsModel;

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
    $settings = new SettingsModel();

    //Enable SMTP debugging.
    $mail->SMTPDebug = isset($this->debug) && $this->debug ? 3 : false;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = $settings->getSetting('smtp_url');
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = $settings->getSetting('smtp_username');
    $mail->Password =  $settings->getSetting('smtp_password');
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = $settings->getSetting('smtp_port');

    $mail->From = $settings->getSetting('smtp_email');
    $mail->FromName = $settings->getSetting('title');
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->addAddress($this->to, $this->name);

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
