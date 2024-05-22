<?php

require_once '../model/Package.php';
require_once '../model/Lesson.php';
require_once 'auth-controllers/SessionController.php';

function handleCreatePackage($name, $price, $description, $available)
{
    try {
        $package = new Package($name, $price, $description, $available);
        $package->create();
        echo "<script>alert('Pakket succesvol toegevoegd.'); window.location.href='PackagesView.php';</script>";
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Er is iets misgegaan bij het toevoegen van het pakket.'); window.location.href='PackagesView.php';</script>";
    }
}
