<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toevoegen Mededeling</title>
    <!-- Voeg hier je CSS-bestand toe -->
</head>
<body>

<h1>Mededelingen</h1>
    <?php
    require_once '../model/Mededeling.php';

    // Maak een instantie van de Mededeling klasse
    $mededeling = new Mededeling();

    // Haal alle mededelingen op
    $mededelingen = $mededeling->getMededelingen();

    // Controleer of er mededelingen zijn
    if ($mededelingen) {
        // Loop door elke mededeling en toon deze op de pagina
        foreach ($mededelingen as $mededeling) {
            echo "<div class='mededeling'>";
            echo "<h2>{$mededeling['titel']}</h2>";
            echo "<p>{$mededeling['bericht']}</p>";
            echo "<p><strong>Datum:</strong> {$mededeling['datum']}</p>";
            echo "</div>";
        }
    } else {
        // Toon een bericht als er geen mededelingen zijn
        echo "<p>Er zijn geen mededelingen op dit moment.</p>";
    }
    ?>



    <h1>Toevoegen Mededeling</h1>
    <form action="../controller/MededelingController.php" method="post">
        <label for="titel">Titel:</label>
        <input type="text" id="titel" name="titel" required>
        <br>
        <label for="bericht">Bericht:</label>
        <textarea id="bericht" name="bericht" rows="4" cols="50" required></textarea>
        <br>
        <label for="ontvanger">Ontvanger Type:</label>
        <select id="ontvanger" name="ontvanger_type" required>
            <option value="instructeur">Instructeur</option>
            <option value="klant">Klant</option>
        </select>
        <br>
        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required>
        <br>
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>
