<?php


require_once '../model/Lesson.php';
require_once 'auth-controllers/SessionController.php';


$lessonController = new Lesson();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            
            case 'updateLesson':
                if (isset($_POST['lessonId'], $_POST['date'], $_POST['time'])) {
                    $lessonId = $_POST['lessonId'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $result = $lessonController->updateLesson($lessonId, $date, $time);
                    if ($result) {
                        echo "<script>alert('Les succesvol bijgewerkt.'); window.location.href='../view/LessonsView.php';</script>";

                        exit();
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
                        echo "<script>alert('Les succesvol geannuleerd.'); window.location.href='../view/LessonsView.php';</script>";
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
    class LessonController {
    
        private $lessonModel;
    
        public function __construct() {
            $this->lessonModel = new Lesson();
        }
    
    
        public function getWeeklyLessons() {
            $startOfWeek = date('Y-m-d', strtotime('monday this week'));
            $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
            return $this->lessonModel->getLessonsBetweenDates($startOfWeek, $endOfWeek);
        }
        
        public function getDailyLessons() {
            $currentDate = date('Y-m-d');
            return $this->lessonModel->getLessonsForDate($currentDate);
        }
}
}