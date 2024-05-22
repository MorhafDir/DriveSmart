<?php
require_once '../controller/PlanningController.php';
require_once '../controller/SicknessController.php';

$planningController = new Lesson();

$instructorLessons = $planningController->getInstructorLessons();


$lessons = $planningController->getAllLessons();


$cars = $planningController->getAllCars();
$users = $planningController->getAllStudents();

if (isset($_GET['view'])) {
    $view = $_GET['view'];
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning beheren</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Driving School DriveSmart - Schedule</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>

    <nav>
        <h1>Applicatie</h1>
    </nav>

    <section class="lesson-h2">
        <h2 class="lesson-toe">Nieuwe Les Toevoegen</h2>
    </section>

    <form action="../controller/planningController.php" method="post">
        <input type="hidden" name="action" value="addLesson">
        <!-- Formulier voor het toevoegen van een les -->
        <!-- Vul de juiste invoervelden in -->
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="time">Tijd:</label>
        <input type="time" id="time" name="time" required>
        <br>
        <label for="userName">Student:</label>
        <select id="userName" name="userId" required>

            <?php
            foreach ($users as $user) {
                echo "<option value=\"{$user['user_id']}\">{$user['name']}</option>";
            }
            ?>
        </select>


        <!-- Auto Dropdown -->

        <br>
        <!-- Voeg hier de user_id toe als een verborgen veld -->
        <label for="carName">Auto:</label>
        <select id="carName" name="carId" required>

            <!-- PHP-code om auto's weer te geven -->
            <?php
            foreach ($cars as $car) {
                // Zorg ervoor dat de value het car_id is en dat de weergegeven tekst de Model en Type is
                echo "<option value=\"{$car['car_id']}\">{$car['model']} ({$car['type']})</option>";
            }
            ?>
        </select>


        <br>
        <label for="startKilometers"> Opmerkingen Toevoegen</label>
        <input type="text" id="startKilometers" name="start_kilometer">
        <br>
        <label for="endKilometers">Mankementen melden</label>
        <input type="text" id="endKilometers" name="end_kilometer">
        <br>
        <input type="submit" value="Toevoegen">
    </form>


    <br><br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Gebruiker</th>
            <th>Auto</th>
        </tr>
        <?php foreach ($lessons as $lesson): ?>
            <tr>
                <td><?php echo $lesson['lesson_id']; ?></td>
                <td>
                    <form action="../controller/planningController.php" method="post">
                        <input type="hidden" name="action" value="updateLessonDetails">
                        <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
                        <input type="date" name="date" value="<?php echo $lesson['date']; ?>">
                </td>
                <td><input type="time" name="time" value="<?php echo $lesson['time']; ?>"></td>

                <td>
                    <select name="userId" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['user_id']; ?>" <?php if ($user['user_id'] === $lesson['user_id']) {
                                   echo 'selected';
                               } ?>><?php echo $user['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <select name="carId" required>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo $car['car_id']; ?>" <?php if ($car['car_id'] === $lesson['car_id']) {
                                   echo 'selected';
                               } ?>><?php echo $car['model'] . ' (' . $car['type'] . ')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <button type="submit">Wijzigen</button>
                    </form>
                    <form action="../controller/planningController.php" method="post">
                        <input type="hidden" name="action" value="deleteLesson">
                        <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>



    <section>
        <h2>Ziek Melden</h2>
        <!-- Optie om een andere gebruiker te selecteren -->
        <form action="../controller/SicknessController.php" method="post">
            <input type="hidden" name="action" value="submitSicknessReport">
            <label for="selectedUserId">Ziek melden voor:</label>
            <select id="selectedUserId" name="selectedUserId">
                <?php
                // Loop door alle gebruikers en geef een selectieoptie voor elke gebruiker
                foreach ($users as $user) {
                    echo "<option value=\"{$user['user_id']}\">{$user['name']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="reason">Reden:</label>
            <textarea id="reason" name="reason" required></textarea>
            <br>
            <input type="submit" value="Ziek melden voor geselecteerde gebruiker">
        </form>

    </section>


    <table>
        <tr>
            <th>ID</th>
            <th>Gebruiker</th>
            <th>Reden</th>
            <th>Gemeld op</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($sicknessReports as $report): ?>
            <tr>
                <td><?php echo $report['id']; ?></td>
                <td><?php echo $report['user_id']; ?></td>
                <td><?php echo $report['reason']; ?></td>
                <td><?php echo $report['reported_at']; ?></td>
                <td>
                    <form action="../controller/SicknessController.php" method="post">
                        <input type="hidden" name="action" value="cancelSicknessReport">
                        <input type="hidden" name="sicknessReportId" value="<?php echo $report['id']; ?>">
                        <button type="submit">Annuleren</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <section>
        <h2>Daily/Weekly Schedule</h2>
        <form action="" method="get">
            <label for="view">View:</label>
            <select id="view" name="view">
                <option value="day">Day</option>
                <option value="week">Week</option>
            </select>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            <input type="submit" value="Apply">
        </form>

        <button onclick="printSchedule()">Print Schedule</button>

        <table id="scheduleTable">
            <thead>
                <h2>Schedule</h2>
                <tr>
                    <th>Les ID</th>
                    <th>Datum</th>
                    <th>Tijd</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                    <tr>
                        <td><?php echo $lesson['lesson_id']; ?></td>
                        <td><?php echo $lesson['date']; ?></td>
                        <td><?php echo $lesson['time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>
    <!-- deze js code zorgt ervoor dat de pagina geprint kan worden -->
    <script>
        function printSchedule() {
            window.print();
        }
    </script>
</body>

</html>