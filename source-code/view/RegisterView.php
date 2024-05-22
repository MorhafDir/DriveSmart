<?php

require_once '../controller/RegisterController.php';

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Driving School DriveSmart - Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
        <h1>Driving School DriveSmart - Register</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>
    <main>
        <center>
            <section>
                <h2>Register</h2>
                <form method="post" action="">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <br /><br />
                    <label for="address">address:</label>
                    <input type="text" id="address" name="address" required>
                    <br /><br />
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required>
                    <br /><br />
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                    <br /><br />
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <br /><br />
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" minlength="8" required>
                    <br /><br />
                    <label for="password_confirm">Confirm Wachtwoord:</label>
                    <input type="password" id="password_confirm" name="password_confirm" minlength="8" required>
                    <br /><br />
                    <input type="hidden" name="register" value="1">
                    <input type="submit" value="Register">
                </form>
            </section>
        </center>

    </main>
</body>

</html>