<?php
include_once "../model/User.php";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        // Get form data
        $name = $_POST["name"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Create UserController object
        $userController = new User();

        // Call addUser method
        $userController->addUser($name, $address, $city, $phoneNumber, $email, $password);
    } elseif (isset($_POST["login"])) {
        // Get form data
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Create UserController object
        $userController = new User();

        // Call loginUser method
        $userController->loginUser($email, $password);
    }
}
?>
