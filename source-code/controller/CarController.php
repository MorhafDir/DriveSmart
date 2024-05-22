<?php

require_once '../model/Car.php';
require_once 'auth-controllers/SessionController.php';
require_once 'auth-controllers/CheckInlogController.php';
require_once 'auth-controllers/LogoutController.php';

if (isset($_POST['model']) && isset($_POST['type']) && isset($_POST['register'])) {
    $car = new Car($_POST['model'], $_POST['type']);

    if ($car->exists()) {
        echo "<script>alert('Deze auto bestaat al!'); window.location.href='ProfileView.php';</script>";
        exit();
    }

    $car->register();
    echo "<script>alert('Auto succesvol toegevoegd!'); window.location.href='ProfileView.php';</script>";
    exit();
}

$cars = Car::getAllCars();