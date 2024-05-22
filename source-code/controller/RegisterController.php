<?php

require_once '../model/User.php';
require_once 'auth-controllers/SessionController.php';

// dit is een controller voor het registreren van een gebruiker
if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['city']) &&isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['register'])) {
    $user = new User($_POST['name'], $_POST['address'], $_POST['city'], $_POST['email'], $_POST['phone'], $_POST['password']);
    try {
        // dit is een functie die de input van de gebruiker valideert
        validateRegistration($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password']);
        if ($_POST['password'] === $_POST['password_confirm']) {
            // dit roept de register functie aan uit de User class
            $user->register();
            echo "<script>alert('Gebruiker succesvol toegevoegd!'); window.location.href='ProfileView.php';</script>";
            exit();
        } else {
            echo "Wachtwoord is niet hetzelfde";
        }
        // de pdoexception wordt opgevangen en de error wordt weergegeven
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function validateRegistration($name, $email, $phone, $password)
{
    // dit checkt of de email een geldig email adres is
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new PDOException('Ongeldig email');
    }
    // dit checkt of de telefoonnummer 10 cijfers lang is
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        throw new PDOException('Ongeldig phone number');
    }
    // dit checkt of de wachtwoord minimaal 8 tekens lang is
    if (strlen($password) < 8) {
        throw new PDOException('Wachtwoord moet minimaal 8 tekens lang zijn');
    }
}