<?php

require_once 'Database.php';
require_once 'Databeheer.php';

class Package extends Databeheer
{
    private $name;
    private $price;
    private $description;
    private $available;

    public function __construct($name, $price, $description, $available)
    {
        parent::__construct();
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->available = $available;
    }

    public function create()
    {
        $this->createPackage($this->name, $this->price, $this->description, $this->available);
    }

    public function pair($name)
    {
        $this->pairLessonsToPackage($this->name, $this->price);
    }

    public function fetchAvailable()
    {
        return $this->fetchAvailablePackages();
    }
    
}