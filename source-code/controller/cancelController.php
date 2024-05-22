<?php
require_once '../model/Car.php';
require_once 'auth-controllers/SessionController.php';
require_once 'auth-controllers/CheckInlogController.php';
require_once 'auth-controllers/LogoutController.php';
require_once 'auth-controllers/RedirectController.php';


if (isset($_POST['car_id']) && isset($_POST['delete'])) {
    $carId = $_POST['car_id'];

    $car = new Car($model, $type);

    $result = $car->deleteCar($carId);

    if ($result) {
        echo "<script>alert('Auto succesvol verwijderd!'); window.location.href='../view/CarsView.php';</script>";
        exit();
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de auto.";
    }
} else {
    echo "Auto ID ontbreekt of delete-knop is niet ingedrukt.";
}



?>