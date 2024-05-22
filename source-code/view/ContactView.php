<?php
require_once '../model/Database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autorijschool DriveSmart - Homepage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Autorijschool DriveSmart</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>
    <main>
        <section>
            <center>
                <h2>Welkom bij Autorijschool DriveSmart</h2>
                <h3>
                    Welkom bij Autorijschool DriveSmart, aarzel niet om contact met ons op te nemen voor meer informatie. 
                </h3>
            </center>  
        </section>  
        <center>
            <section>
                <h2>Contact Page</h2>
                <form action="../controller/ContactController.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <br>
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <br>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                    <br>
                    <input type="submit" >
                </form>
            </section>
        </center>
    </main>
</body>
</html>
