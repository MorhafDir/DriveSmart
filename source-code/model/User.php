<?php

require_once 'Database.php';
require_once 'Databeheer.php';

class User extends Databeheer
{
    private $name;
    private $address;
    private $city;
    private $email;
    private $phone;
    private $password;

    public function __construct($name, $address, $city, $email, $phone, $password)
    {
        // parent wordt gebruikt om de constructor van de parent class, Databeheer, aan te roepen
        parent::__construct();
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->email = strtolower($email);
        $this->phone = $phone;
        $this->password = $password;
    }

    public function register()
    {
        // registerUser is een functie die in de Databeheer class staat en wordt aangeroepen
        $this->registerUser($this->name, $this->address, $this->city, $this->email, $this->phone, $this->password);
    }

    public function login()
    {
        // loginUser is een functie die in de Databeheer class staat en wordt aangeroepen
        return $this->loginUser($this->email, $this->password);
    }

    public function fetchAllData()
    {
        // fetchAllUserData is een functie die in de Databeheer class staat en wordt aangeroepen
        return $this->fetchAllUserData($this->email);
    }

    public function update($id, $new_name, $new_address, $new_city, $new_email, $new_phone, $new_password, $new_disabilitydetails)
    {
        // updateUser is een functie die in de Databeheer class staat en wordt aangeroepen
        return $this->updateUser($id, $new_name, $new_address, $new_city, $new_email, $new_phone, $new_password, $new_disabilitydetails);
    }
}