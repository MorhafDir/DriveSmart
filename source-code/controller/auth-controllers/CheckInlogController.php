<?php

// checkt welke gebruiker er is ingelogd
$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Profile';
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Profile';