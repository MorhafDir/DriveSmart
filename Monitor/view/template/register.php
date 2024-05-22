<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="small.css">
</head>
<body>
    <header>
        <h1>Registreren bij Rijschool XYZ</h1>
    </header>

    <main>
        <form action="../../controller/UserController.php" method="POST">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="address">Adres:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="city">Stad:</label>
            <input type="text" id="city" name="city" required><br>

            <label for="phoneNumber">Telefoonnummer:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required><br>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" name="register" value="Registreren">
        </form>

        <p>heb al een account : <a href="./login.php">inloggen</a></p>
    </main>

    <footer>
        <p>© 2024 Rijschool XYZ. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
