<?php

require_once '../model/Lesson.php';
require_once 'auth-controllers/SessionController.php';

$lessonController = new Lesson();

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$lessons = $lessonController->getLessonsByDate($date);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'addLesson':
                try {
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $userId = $_POST['userId'];
                    $carId = $_POST['carId'];
                    $startKilometers = $_POST['start_kilometer'];
                    $endKilometers = $_POST['end_kilometer'];

                    echo "Date: $date, Time: $time, User ID: $userId, Car ID: $carId, Start Kilometers: $startKilometers, End Kilometers: $endKilometers";

                    $result = $lessonController->addLesson($date, $time, $userId, $carId, $startKilometers, $endKilometers);
                    if ($result) {
                        echo "<script>alert('Les succesvol toegevoegd.'); window.location.href='../view/ScheduleView.php';</script>";
                        exit();
                    } else {
                        echo "Er is een fout opgetreden bij het toevoegen van de les.";
                    }
                } catch (Exception $e) {
                    echo "Exception: " . $e->getMessage();
                }
                break;

            case 'updateLessonDetails':
                try {
                    $lessonId = $_POST['lessonId'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $userId = $_POST['userId'];
                    $carId = $_POST['carId']; 
                    if (!$lessonController->isCarIdValid($carId)) {
                        throw new Exception("Ongeldige car_id: $carId");
                    }

                    $result = $lessonController->updateLesson($lessonId, $date, $time, $userId, $carId);
                    if ($result) {
                        echo "<script>alert('Les succesvol bijgewerkt.'); window.location.href='../view/ScheduleView.php';</script>";
                        exit();
                    } else {
                        echo "Er is een fout opgetreden bij het bijwerken van de les.";
                    }
                } catch (Exception $e) {
                    echo "Exception: " . $e->getMessage();
                }
                break;


            case 'deleteLesson':
                if (isset($_POST['lessonId'])) {
                    $lessonId = $_POST['lessonId'];
                    $result = $lessonController->deleteLesson($lessonId);
                    if ($result) {
                        echo "<script>alert('Les succesvol geannuleerd.'); window.location.href='../view/ScheduleView.php';</script>";
                        exit(); 
                    } else {
                        echo "Er is een fout opgetreden bij het verwijderen van de les.";
                    }
                } else {
                    echo "Lesson ID ontbreekt.";
                }
                break;

            default:
                echo "Ongeldige actie.";
        }
    } else {
        echo "Actie ontbreekt.";
    }
}
