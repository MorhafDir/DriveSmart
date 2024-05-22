<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studenten Dashboard</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="small.css">
</head>
<body>
    <header>
        <?php include "../navbar.php" ?> 
        <h1>Welkom op het Studenten Dashboard</h1>
    </header>

    <main>
    <h2>Uw Gegevens:</h2>
    <?php if(isset($_SESSION['user_name'])): ?>
        <p>Naam: <?php echo $_SESSION['user_name']; ?></p>
    <?php else: ?>
        <p>Naam niet gevonden</p>
    <?php endif; ?>
    <p>Rol: Student</p>

    <h2>Mededelingen:</h2>
    <div class="mededelingen">
        <p>Hier kunnen mededelingen voor leerlingen worden weergegeven.</p>
        <p>Bijvoorbeeld: Belangrijke aankondigingen, nieuws, updates, etc.</p>
    </div>

    <h2>Lesrooster:</h2>
    <div class="kalender">
        <table>
            <caption>Lesrooster</caption>
            <thead>
                <tr>
                    <th>Maandag</th>
                    <th>Dinsdag</th>
                    <th>Woensdag</th>
                    <th>Donderdag</th>
                    <th>Vrijdag</th>
                    <th>Zaterdag</th>
                    <th>Zondag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Voorbeeld van het genereren van enkele lege cellen voor de weergave
                for($i = 0; $i < 5; $i++):
                ?>
                <tr>
                    <?php for($j = 0; $j < 7; $j++): ?>
                    <td></td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</main>
<h2>Plan een les</h2>
<form method="post" action="process_lesson.php">
    <label for="date">Datum:</label>
    <input type="date" id="date" name="date" required>
    <br /><br />
    <label for="time">Tijd:</label>
    <input type="time" id="time" name="time" required>
    <br /><br />
    <label for="instructor">Instructeur:</label>
    <select id="instructor" name="instructor" required>
        <option value="1">John Doe</option>
        <option value="2">Jane Doe</option>
    </select>
    <br /><br />
    <input type="submit" value="Plan">
</form>
