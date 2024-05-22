<?php

require_once '../controller/CarController.php';

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Driving School DriveSmart - Cars</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Driving School DriveSmart - Cars</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
    </header>
    <main>
        <center>
            <?php if ($isAdmin): ?>
                <section>
                    <h2>Add Cars</h2>
                    <form method="post" action="">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model" required><br><br>
                        <label for="type">Type:</label>
                        <select id="type" name="type" required>
                            <option value="" disabled selected>Select a type</option>
                            <option value="electric">Electric</option>
                            <option value="petrol">Petrol</option>
                        </select><br><br>
                        <input type="submit" name="register" value="Register">
                    </form>
                </section>
            <?php endif; ?>
            <section>
                <h2>All Cars</h2>
                <table>
    <thead>
        <tr>
            <th>Model</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?php echo $car['model']; ?></td>
                <td><?php echo $car['type']; ?></td>
                <td>
                    <!-- Formulier om de auto te verwijderen -->
                    <form method="POST" action="../controller/cancelController.php">
                        <!-- Verborgen inputveld om de car_id door te geven -->
                        <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">
                        <input type="submit" value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete this car?')">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            </section>
        </center>
    </main>
</body>

</html>