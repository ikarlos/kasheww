<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/autoload.php";

class Mail
{
    protected $pass = "wini qhxk oyxy ngks";
    protected $sender_email = "ff084130@gmail.com";
    protected $mailer;

    function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    function send($receiver_email, $subject, $message)
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->Port = 587;
            $this->mailer->SMTPSecure = "TLS";
            $this->mailer->SMTPAuth = true;

            $this->mailer->Username   = $this->sender_email;
            $this->mailer->Password   = $this->pass;

            $this->mailer->setFrom($this->sender_email, 'Kasheww Store');
            $this->mailer->addAddress($receiver_email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
} 