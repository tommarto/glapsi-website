<?php

class Admin {

    private $name;
    private $email;
    private $replyEmail;
    private $replyTo;

    public function __construct($name, $email, $replyEmail, $replyTo)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setReplyEmail($replyEmail);
        $this->setReplyTo($replyTo);
    }


    #### Getters & Setters:
    public function setName($data)
    {
        $this->name = $data;
    } 
    public function setEmail($data)
    {
        $this->email = $data;
    } 
    public function setReplyEmail($data)
    {
        $this->replyEmail = $data;
    } 
    public function setReplyTo($data)
    {
        $this->replyTo = $data;
    } 
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getReplyEmail()
    {
        return $this->replyEmail;
    }
    public function getReplyTo()
    {
        return $this->replyTo;
    }


}