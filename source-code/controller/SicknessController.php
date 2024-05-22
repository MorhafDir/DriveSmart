<?php

require_once '../model/SicknessReport.php';
require_once 'auth-controllers/SessionController.php';

if (!isset($_SESSION['name'])) {
    header("Location: ../view/ScheduleView.php");
    exit();
}

$sicknessController = new SicknessReport();

$sicknessReports = $sicknessController->getAllSicknessReports();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'submitSicknessReport') {
        if (!empty($_POST['reason'])) {
            $reason = $_POST['reason'];
            $userId = $_SESSION['user_id']; 

            if (isset($_POST['selectedUserId']) && !empty($_POST['selectedUserId'])) {
                $userId = $_POST['selectedUserId'];
            }

            if ($sicknessController->addSicknessReport($userId, $reason)) {
                echo "<script>alert('Ziekterapport succesvol ingediend.'); window.location.href='../view/ScheduleView.php';</script>";
                exit();
            } else {
                echo "Er is een fout opgetreden bij het indienen van het ziekterapport.";
            }
        } else {
            echo "Vul alstublieft een reden in.";
        }
    } elseif ($_POST['action'] == 'cancelSicknessReport') {
        if (isset($_POST['sicknessReportId'])) {
            $sicknessReportId = $_POST['sicknessReportId'];
            if ($sicknessController->cancelSicknessReport($sicknessReportId)) {
                echo "<script>alert('Ziektemelding succesvol geannuleerd.'); window.location.href='../view/ScheduleView.php';</script>";
                exit();
            } else {
                echo "Er is een fout opgetreden bij het annuleren van de ziekmelding.";
            }
        } else {
            echo "Geen ziekmelding geselecteerd om te annuleren.";
        }
    }
}

?>
