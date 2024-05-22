<?php

// dit geeft een melding als de gebruiker is uitgelogd
if (isset($_GET['message'])) {
    echo $_GET['message'];
}

// dit zorgt ervoor dat de gebruiker wordt uitgelogd
if (isset($_POST['logout'])) {
    $_SESSION = array();

    session_destroy();
    header("Location: ProfileView.php?message=U bent uitgelogd.");
    exit;
}

