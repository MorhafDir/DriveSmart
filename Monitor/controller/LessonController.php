<?php

require_once __DIR__ . '/../model/Lesson.php';

// Instantieer de controller
$lessonController = new Lesson();

// Controleer of er een POST-verzoek is gedaan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingevuld
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        // Roep de juiste methode aan op basis van de actie
        switch ($action) {
            case 'addLesson':
                if (isset($_POST['date'], $_POST['time'], $_POST['userName'], $_POST['carName'], $_POST['startKilometers'], $_POST['endKilometers'])) {
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $userName = $_POST['userName'];
                    $carName = $_POST['carName'];
                    $startKilometers = $_POST['startKilometers'];
                    $endKilometers = $_POST['endKilometers'];
                    $result = $lessonController->addLesson($date, $time, $userName, $carName, $startKilometers, $endKilometers);
                    if ($result) {
                        // Als het bijwerken succesvol is, doorsturen naar de indexpagina
                        header("Location: ../view/template/lessonPage.php");
                        exit(); // Zorg ervoor dat het script stopt na de redirect
                    } else {
                        echo "Er is een fout opgetreden bij het bijwerken van de les.";
                    }
                } else {
                    echo "Niet alle vereiste velden zijn ingevuld.";
                }
                break;
                case 'updateLesson':
                    if (isset($_POST['lessonId'], $_POST['date'], $_POST['time'])) {
                        $lessonId = $_POST['lessonId'];
                        $date = $_POST['date'];
                        $time = $_POST['time'];
                        $result = $lessonController->updateLesson($lessonId, $date, $time);
                        if ($result) {
                            // Als het bijwerken succesvol is, doorsturen naar de indexpagina
                            header("Location: ../view/template/lessonPage.php");
                            exit(); // Zorg ervoor dat het script stopt na de redirect
                        } else {
                            echo "Er is een fout opgetreden bij het bijwerken van de les.";
                        }
                    } else {
                        echo "Niet alle vereiste velden zijn ingevuld.";
                    }
                    break;
                    
                case 'deleteLesson':
                    if (isset($_POST['lessonId'])) {
                        $lessonId = $_POST['lessonId'];
                        $result = $lessonController->deleteLesson($lessonId);
                        if ($result) {
                            // Als het verwijderen succesvol is, doorsturen naar de indexpagina
                            header("Location: ../view/template/lessonPage.php");
                            exit(); // Zorg ervoor dat het script stopt na de redirect
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
?>
