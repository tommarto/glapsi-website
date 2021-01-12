<?php

class User {
    
    private $id;
    private $name;
    private $phone;
    private $email;
    private $compName;
    private $service;
    private $businessCat;
    private $download;
    private $active;

    public function __construct($id = NULL, $name = NULL, $phone = NULL, $email = NULL, $compName = NULL, $service = NULL, $businessCat = NULL, $download = 0)
    {   
        if( $id === NULL){

            if(!isset($download)){
                $download = 0;
            }

            $lastInsertedId = $this->createUserReg($name, $phone, $email, $compName, $service, $businessCat, $download);

            if ( $lastInsertedId != FALSE){
                $this->setAllData($lastInsertedId, $name, $phone, $email, $compName, $service, $businessCat, $download, $active = 1);
                return $this;
            }else{
                return FALSE;
            }

        }else{
            if($this->getUserFromTable($id) != FALSE){
                return $this;
            }else{
                return FALSE;
            }
        }
    }

    private function createUserReg($name, $phone, $email, $compName, $service, $businessCat, $download)
    {
        $con    =   DBCon::connect();
        $query  =   "INSERT INTO users (name, email, phone, comp_name, service, business_cat, download)
        VALUES ('$name', '$email', '$phone', '$compName', $service, $businessCat, $download)";
        $stmt   =   $con->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $con->lastInsertId();
        }else{
            return FALSE;
        }
    }

    private function getUserFromTable($id)
    {
        $con    =   DBCon::connect();
        $query  =   "SELECT * FROM users WHERE id=$id";
        $stmt   =   $con->prepare($query);

        $stmt->execute();
        if($stmt->rowCount() > 0){
            $data   =   $stmt->fetch(PDO::FETCH_ASSOC);
            $this->setAllData($id, $data['name'], $data['phone'], $data['email'], $data['comp_name'], $data['service'], $data['business_cat'], $data['download'], $data['active']);

            return $this;
        }else{
            return FALSE;
        }
    }

    private function setAllData($id, $name, $phone, $email, $compName, $service, $businessCat, $download, $active)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setCompName($compName);
        $this->setService($service);
        $this->setBusinessCat($businessCat);
        $this->setDownload($download);
        $this->setActive($active);
    }

    public function showAllData(){
        echo '<hr>';
        echo $this->getId();
        echo '<br>';
        echo $this->getName();
        echo '<br>';
        echo $this->getPhone();
        echo '<br>';
        echo $this->getEmail();
        echo '<br>';
        echo $this->getCompName();
        echo '<br>';
        echo $this->getService();
        echo '<br>';
        echo $this->getBusinessCat();
        echo '<br>';
        echo $this->getDownload();
        echo '<br>';
        echo $this->getActive();
        echo '<br>';
    }
    #### Getters & Setters: 
    
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getCompName()
    {
        return $this->compName;
    }
    public function getService()
    {
        return $this->service;
    }
    public function getBusinessCat()
    {
        return $this->businessCat;
    }
    public function getDownload()
    {
        return $this->download;
    }
    public function getActive()
    {
        return $this->active;
    }

    public function setId($data)
    {
        $this->id = $data;
    }
    public function setName($data)
    {
        $this->name = $data;
    }
    public function setPhone($data)
    {
        $this->phone = $data;
    }
    public function setEmail($data)
    {
        $this->email = $data;
    }
    public function setCompName($data)
    {
        $this->compName = $data;
    }
    public function setService($data)
    {
        $this->service = $data;
    }
    public function setBusinessCat($data)
    {
        $this->businessCat = $data;
    }
    public function setDownload($data)
    {
        $this->download = $data;
    }
    public function setActive($data)
    {
        $this->active = $data;
    }
}