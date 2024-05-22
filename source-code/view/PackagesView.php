<?php

require_once '../controller/PackageController.php';

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Driving School DriveSmart - Packages</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Driving School DriveSmart - Packages</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>
    <main>
        <center>
            <section>
                <?php if ($isAdmin): ?>
                    <h2>Add Package</h2>
                    <form method="post" action="">
                        <label for="name">Package Name:</label>
                        <input type="text" id="name" name="name" placeholder="Package name" required>
                        <br /><br />

                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" placeholder="Price" required min="0">
                        <br /><br />

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" placeholder="Description"></textarea>
                        <br /><br />

                        <label for="available">Availability:</label>
                        <select id="available" name="available" required>
                            <option value="" disabled selected>Select availability</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                        <br /><br />

                        <button type="submit" name="action" value="createPackage">Add Package</button>
                    </form>

                <?php endif; ?>
            </section>
        </center>
    </main>

</body>

</html>