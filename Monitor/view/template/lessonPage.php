<?php
require_once '../../controller/LessonController.php';

// Maak een instantie van de controller
$lesson = new Lesson();

// Haal alle lessen op
$lessons = $lesson->getAllLessons();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessen beheren</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<header class="header">
    <?php include "../navbar.php"; ?>
</header>

<nav>
    <h1>Applicatie</h1>
</nav>

<section class="lesson-h2">
    <h2 class="lesson-toe">Nieuwe Les Toevoegen</h2>
</section>

<form action="../../controller/LessonController.php" method="post">
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
    <select id="userName" name="userName" required>
        <!-- PHP-code om alleen studentgebruikers weer te geven -->
        <?php
        // Controleer of de gebruiker is ingelogd en of de sessievariabele is ingesteld
        if(isset($_SESSION['user_name'])) {
            // Haal alle studentgebruikers op
            $users = $lesson->getAllStudents();
            foreach ($users as $user) {
                // Controleer of de gebruiker de rol "student" heeft
                if ($user['role'] == 'student') {
                    // Geef de studentgebruiker weer in het selectievakje
                    echo "<option value=\"{$user['name']}\">{$user['name']}</option>";
                }
            }
        }
        ?>
    </select>
    <br>
    <!-- Voeg hier de user_id toe als een verborgen veld -->
    <input type="hidden" id="user_id" name="user_id" >
    <label for="carName">Auto:</label>
    <select id="carName" name="carName" required>
        <!-- PHP-code om auto's weer te geven -->
        <?php
        // Controleer of de gebruiker is ingelogd en of de sessievariabele is ingesteld
        if(isset($_SESSION['user_name'])) {
            // Haal alle auto's op
            $cars = $lesson->getAllCars();
            foreach ($cars as $car) {
                // Geef de auto weer in het selectievakje
                echo "<option value=\"{$car['brand']} {$car['model']} ({$car['registration_number']})\">{$car['brand']} {$car['model']} ({$car['registration_number']})</option>";
            }
        }
        ?>
    </select>
    <br>
    <label for="startKilometers">Start Kilometerstand:</label>
    <input type="number" id="startKilometers" name="startKilometers" required>
    <br>
    <label for="endKilometers">Eind Kilometerstand:</label>
    <input type="number" id="endKilometers" name="endKilometers" required>
    <br>
    <input type="submit" value="Toevoegen">
</form>



<table>
    <tr>
        <th>ID</th>
        <th>Datum</th>
        <th>Tijd</th>
        <!-- Andere kolomkoppen -->
        <th>Acties</th>
    </tr>
    <?php foreach ($lessons as $lesson): ?>
        <tr>
            <td><?php echo $lesson['lesson_id']; ?></td>
            <td>
    <form action="../../controller/LessonController.php" method="post">
        <input type="hidden" name="action" value="updateLesson">
        <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
        <input type="date" name="date" value="<?php echo $lesson['date']; ?>">
</td>
<td><input type="time" name="time" value="<?php echo $lesson['time']; ?>"></td>

<!-- Verwijder de invoervelden voor userName en carName -->

            <td>
                <button type="submit">Wijzigen</button>
                </form>
                <form action="../../controller/LessonController.php" method="post">
                    <input type="hidden" name="action" value="deleteLesson">
                    <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
                    <button type="submit">Verwijderen</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


</body>
</html>
