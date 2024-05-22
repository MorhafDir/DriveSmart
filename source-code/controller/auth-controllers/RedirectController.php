<?php

// deze functie checkt of de gebruiker ingelogd is en de rol heeft.
function redirectToHomepage()
{
    $allowedPagesForAdminsAndInstructors = ['CarsView.php', 'ScheduleView.php'];

    // lijst van pagina's die toegankelijk zijn voor iedereen
    $publicPages = ['HomepageView.php', 'InformationView.php', 'ContactView.php', 'RegisterView.php', 'ProfileView.php', 'PackagesView.php'];
    // basename bekijkt de bestandsnaam van het huidige script
    $currentPage = basename($_SERVER['PHP_SELF']);

    // als de gebruiker niet is ingelogd en probeert toegang te krijgen tot een niet-openbare pagina
    if (!isset($_SESSION['loggedIn']) && !in_array($currentPage, $publicPages)) {
        header('Location: HomepageView.php');
        exit();
    }

    // als de gebruiker geen admin of instructeur is en probeert toegang te krijgen tot een pagina die alleen voor hen is
    if (isset($_SESSION['role']) && !in_array($_SESSION['role'], ['Admin', 'Instructor']) && in_array($currentPage, $allowedPagesForAdminsAndInstructors)) {
        header('Location: HomepageView.php');
        exit();
    }
}

// dit roept de functie aan
redirectToHomepage();
