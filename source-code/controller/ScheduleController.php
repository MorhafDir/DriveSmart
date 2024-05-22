<?php


require_once '../model/Schedule.php';
require_once 'auth-controllers/SessionController.php';

class ScheduleController {
    
    private $schedule;

    public function __construct() {
        $this->schedule = new Schedule();
    }

    public function displaySchedule() {
        $view = isset($_GET['view']) ? $_GET['view'] : 'week'; // Hij gaat automatisch naar week als je niks invult
        $lessons = [];

        if ($view === 'week') {
            $lessons = $this->schedule->getWeeklyLessons();
        } elseif ($view === 'day') {
            $lessons = $this->schedule->getDailyLessons();
        }

        include '../view/ScheduleView.php';
    }
}
?>