<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeur Dashboard</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="small.css">
</head>
<body>
    <header>
        <?php
        include "../navbar.php";
        ?>
    </header>

    <main>
        <?php

        // Controleer of de gebruiker is ingelogd en of de sessievariabele is ingesteld
        if(isset($_SESSION['user_name'])) {
            echo "<h2>Uw Gegevens:</h2>";
            echo "<p>Naam: {$_SESSION['user_name']}</p>";
            echo "<p>Rol: Instructeur</p>";
        } else {
            echo "<p>U bent niet ingelogd.</p>";
        }
        ?>
        <!-- Voeg hier verdere instructeur-dashboardfunctionaliteit toe -->
    </main>

    
    <main>
        <h2>Mededelingen</h2>
        <ul>
            <?php
            include_once "../../controller/AnnouncementsController.php";
            $announcementsController = new AnnouncementsController();
            $mededelingen = $announcementsController->getAnnouncements();
            foreach ($mededelingen as $mededeling) {
                echo "<li><strong>{$mededeling['titel']}</strong> - {$mededeling['inhoud']} ({$mededeling['datum']})</li>";
            }
            ?>
        </ul>

        <!-- Formulier om nieuwe mededeling toe te voegen -->
        <h2>Nieuwe Mededeling Toevoegen</h2>
        <form action="../../controller/AnnouncementsController.php" method="POST">
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="content">Inhoud:</label>
            <textarea id="content" name="content" required></textarea><br>

            <input type="submit" name="addMededeling" value="Toevoegen">
        </form>
    </main>

    <footer>
        <p>© <?php echo date("Y"); ?> Rijschool XYZ. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
