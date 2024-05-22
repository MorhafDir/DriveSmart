<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="small.css">
</head>
<body>
    <header>
        <h1>Inloggen bij Rijschool XYZ</h1>
    </header>

    <main>
        <form action="../../controller/UserController.php" method="POST">
            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" name="login" value="Inloggen">
        </form>
        
        <p>nog geen account : <a href="./register.php">register</a></p>
    </main>

    <footer>
        <p>© 2024 Rijschool XYZ. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
