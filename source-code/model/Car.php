<?php

require_once 'Database.php';
require_once 'Databeheer.php';

class Car extends Databeheer
{
    private $model;
    private $type;

    public function __construct($model, $type)
    {
        parent::__construct();
        $this->model = $model;
        $this->type = $type;
    }

    

    public function register()
    {
        $this->registerCar($this->model, $this->type);
    }

    public function exists()
    {
        return $this->fetchCar($this->model, $this->type);
    }

    public static function getAllCars()
    {
        $db = new Database();
        $query = "SELECT * FROM cars";
        $result = $db->getDb()->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCar($carId) {
        $query = "DELETE FROM cars WHERE car_id = :car_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':car_id', $carId);
        return $stmt->execute();
    }
}



?>