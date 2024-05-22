<?php

// checkt of welke rol de ingelogde gebruiker is
$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin');

$isInstructor = (isset($_SESSION['role']) && $_SESSION['role'] == 'Instructor');

?>
<h3>
    <?php if ($loggedIn && $isAdmin) : ?>
        Admin
    <?php elseif ($loggedIn && $isInstructor && !$isAdmin) : ?>
        Instructor
    <?php elseif ($loggedIn && !$isInstructor && !$isAdmin) : ?>
        Student
    <?php elseif (!$loggedIn) : ?>
        Guest
    <?php endif; ?>
</h3>