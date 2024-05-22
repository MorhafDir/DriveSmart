<?php
require_once '../model/Mededeling.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST["titel"];
    $bericht = $_POST["bericht"];
    $ontvangerType = $_POST["ontvanger_type"];
    $datum = $_POST["datum"];

    $mededeling = new Mededeling();

    $mededeling->addMededeling($titel, $bericht, $ontvangerType, $datum);

    echo "<script>alert('Mededeling succesvol toegevoegd.'); window.location.href='../view/addMededeling.php';</script>";
    exit();
}
?>