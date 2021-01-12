<?php

require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    private $Mailer;
    private $smtpDebug;
    private $host;
    private $port;
    private $smtpSecure;
    private $smtpAuth;
    private $user;
    private $pass;
    private $UserObj;
    private $AdminObj;
    private $Logger;

    public function __construct($User, $Admin, $mailerConfig)
    {   
        $this->Logger = Logger::getInstance();

        $this->setMailer(new PHPMailer(true));
        $this->setHost($mailerConfig['host']);
        $this->setPort($mailerConfig['port']);
        $this->setUser($mailerConfig['user']);
        $this->setPass($mailerConfig['pass']);
        $this->setSMTPSecure($mailerConfig['smtpSecure']);
        $this->setSMTPAuth($mailerConfig['smtpAuth']);
        $this->setSMTPDebug($mailerConfig['smtpDebug']);

        $this->setUserObj($User);
        $this->setAdminObj($Admin);


    }

    public function sendUserEmail($textbody, $subject, $altbody)
    {
        try{
            $this->setEmailData($this->getUserObj(), $this->getAdminObj());
            $this->setEmail($textbody, $subject, $altbody);
            $this->Mailer->send();
            return TRUE;
        }catch(Exception $e){
            // echo $e->getMessage();
            // TODO: Log This Error.
            $this->$Logger->write('Error Sending Admin Email on Form-Action.php -> '.$e, 'ERROR');
            return FALSE;
        }
    }
    
    public function sendAdminEmail($textbody, $subject, $altbody)
    {
        try{
            $this->setEmailData($this->getAdminObj(), $this->getAdminObj());
            $this->setEmail($textbody, $subject, $altbody);
            $this->Mailer->send();
            return TRUE;
        }catch( Exception $e){
            // echo $e->getMessage();
            // TODO: Log This Error.
            return FALSE;
        }
    }

    public function setEmailData($UserObj, $AdminObj){
        $this->Mailer->setFrom($AdminObj->getEmail(), $AdminObj->getName());
        $this->Mailer->addAddress($UserObj->getEmail());
        $this->Mailer->addReplyTo($AdminObj->getReplyEmail(), $AdminObj->getReplyTo());
    }

    private function setEmail($textbody, $subject, $altbody)
    {
        $this->Mailer->Body = $textbody;
        $this->Mailer->Subject = $subject;
        $this->Mailer->AltBody = $textbody;
    }



    #### Getters & Setters: 

    public function setMailer($mailer)
    {
        $this->Mailer = $mailer;
    }
    public function setHost($host)
    {   
        $this->Mailer->Host = $host;
        $this->host = $host;
    }
    public function setPort($port)
    {   
        $this->Mailer->Port = $port;
        $this->port = $port;
    }
    public function setSMTPSecure($smtpSecure)
    {   
        $this->Mailer->SMTPSecure = $smtpSecure;
        $this->smtpSecure = $smtpSecure;
    }
    public function setSMTPAuth($smtpAuth)
    {
        $this->Mailer->SMTPAuth = $smtpAuth;
        $this->smtpAuth = $smtpAuth;
    }
    public function setSMTPDebug($smtpDebug)
    {
        $this->Mailer->SMTPDebug = $smtpDebug;
        $this->smtpDebug = $smtpDebug;
    }
    public function setUser($user)
    {
        $this->Mailer->Username = $user;
        $this->user = $user;
    }
    public function setPass($pass)
    {
        $this->Mailer->Password = $pass;
        $this->pass = $pass;
    }
    public function setUserObj($User)
    {
        $this->UserObj = $User;
    }
    public function setAdminObj($Admin)
    {
        $this->AdminObj = $Admin;
    }
    public function getMailer()
    {
        return $this->mailer;
    }
    public function getHost()
    {
        return $this->host;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getSMTPSecure()
    {
        return $this->smtpSecure;
    }
    public function getSMTPAuth()
    {
        return $this->smtpAuth;
    }
    public function getSMTPDebug()
    {
        return $this->smtpDebug;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getUserObj()
    {
        return $this->UserObj;
    }
    public function getAdminObj()
    {
        return $this->AdminObj;
    }
}