<?php

require_once '../controller/auth-controllers/SessionController.php';
require_once '../controller/auth-controllers/CheckInlogController.php';
require_once '../controller/auth-controllers/RedirectController.php';

?>
<nav>
    <ul>
        <?php include '../controller/auth-controllers/RoleController.php'; ?>
        <li><a href="HomepageView.php">Home</a></li>
        <li><a href="InformationView.php">Information</a></li>
        <?php if (!$loggedIn) : ?>
            <li><a href="RegisterView.php">Register</a></li>
        <?php endif; ?>
        <li><a href="ContactView.php">Contact</a></li>
        <?php if ($loggedIn && ($isAdmin || $isInstructor)): ?>
            <li><a href="ScheduleView.php">Schedule</a></li>
            <li><a href="CarsView.php">Cars</a></li>
        <?php endif; ?>
        <li><a href="PackagesView.php">Packages</a></li>
        <?php if ($loggedIn): ?>
            <li><a href="LessonsView.php">Lessons</a></li>
            <li><a href="planningView.php">Planning</a></li>
            <li><a href="ProfileView.php"><?php echo $name; ?></a></li>
        <?php else: ?>
            <li><a href="ProfileView.php">Log in</a></li>
        <?php endif; ?>
        </ul>
</nav>