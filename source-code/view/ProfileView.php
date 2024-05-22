<?php

require_once '../controller/ProfileController.php';

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Driving School DriveSmart - Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Driving School DriveSmart - Profile</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>
    <main>
        <center>
            <section>
                <?php if ($loggedIn): ?>
                    <h2>Update details</h2>
                    <form method="post" action="">
                        <label for="new_name">Name:</label>
                        <input type="text" id="new_name" name="new_name"
                            value="<?php echo htmlspecialchars($_SESSION['name']) ?>">
                        <br /><br />
                        <label for="new_address">Address:</label>
                        <input type="text" id="new_address" name="new_address"
                            value="<?php echo htmlspecialchars($_SESSION['address']) ?>">
                        <br /><br />
                        <label for="new_city">City:</label>
                        <input type="text" id="new_city" name="new_city"
                            value="<?php echo htmlspecialchars($_SESSION['city']) ?>">
                        <br /><br />
                        <label for="new_email">Email:</label>
                        <input type="email" id="new_email" name="new_email"
                            value="<?php echo htmlspecialchars($_SESSION['email']) ?>">
                        <br /><br />
                        <label for="new_phone">Phone:</label>
                        <input type="tel" id="new_phone" name="new_phone"
                            value="<?php echo htmlspecialchars($_SESSION['phone']) ?>">
                        <br /><br />
                        <label for="new_password">Password:</label>
                        <input type="password" id="new_password" name="new_password" placeholder="New password"
                            minlength="8" placeholder="New password">
                        <br /><br />
                        <label for="new_disabilitydetails">Disability Details:</label>
                        <input type="text" id="new_disabilitydetails" name="new_disabilitydetails"
                        value="<?php echo htmlspecialchars($_SESSION['disabilitydetails'])?>" >
                        <br /><br />
                        <input type="hidden" name="update" value="1">
                        <input type="submit" name="update" value="Update">
                        <br />
                    </form>

                <?php endif; ?>

                <?php if (!$loggedIn): ?>
                    <h2>Login</h2>
                    <form method="post" action="">
                        <label for="login_email">Email:</label>
                        <input type="text" id="login_email" name="email" placeholder="Email" required>
                        <br /><br />
                        <label for="login_password">Password:</label>
                        <input type="password" id="login_password" name="password" placeholder="Password" required>
                        <br /><br />
                        <input type="submit" name="login" value="Login">
                    </form>
                <?php endif; ?>

                <?php if ($loggedIn): ?>
                    <form method="post" action="ProfileView.php">
                        <input type="submit" name="logout" value="Logout">
                    </form>
                <?php endif; ?>
            </section>
        </center>

    </main>
</body>

</html>