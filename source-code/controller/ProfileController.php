<?php

require_once '../model/User.php';
require_once 'auth-controllers/SessionController.php';
require_once 'auth-controllers/LogoutController.php';
require_once 'auth-controllers/RedirectController.php';

function handleLogin($email, $password)
{
    // dit is een functie die de gebruiker inlogt, null wordt gebruikt omdat alleen email en wachtwoord nodig zijn
    $user = new User(null, null, null, $email, null, null);
    // dit haalt alle data op van de gebruiker
    $userData = $user->fetchAllData();
    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['name'] = $userData['name'];
        $_SESSION['role'] = $userData['role'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['address'] = $userData['address'];
        $_SESSION['city'] = $userData['city'];
        $_SESSION['phone'] = $userData['phone'];
        $_SESSION['disabilitydetails'] = $userData['disabilitydetails'] ?? 'Add disability details';

        header("Location: ProfileView.php");
        exit();
    } else {
        echo "<script>alert('Verkeerd wachtwoord of e-mail, probeer het opnieuw.');</script>";
    }
}


// deze functie logt de gebruiker uit
function handleLogout()
{
    session_destroy();
    header("Location: ProfielView.php");
    exit();
}

// deze functie update de gebruiker
function handleUpdate()
{
    $id = $_SESSION['user_id'];
    $new_name = $_POST['new_name'] ?? null;
    $new_address = $_POST['new_address'] ?? null;
    $new_city = $_POST['new_city'] ?? null;
    $new_email = $_POST['new_email'] ?? null;
    $new_phone = $_POST['new_phone'] ?? null;
    $new_password = $_POST['new_password'] ?? null;
    $new_disability_details = $_POST['new_disabilitydetails'] ?? null;

    // dit is een functie die de gebruiker update
    $user = new User(null, null, null, null, null, null);
    // dit roept de update functie aan uit de User class
    if ($user->update($id, $new_name, $new_address, $new_city, $new_email, $new_phone, $new_password, $new_disability_details)) {
        // dit update de sessie variabelen
        $_SESSION['name'] = $new_name;
        $_SESSION['address'] = $new_address;
        $_SESSION['city'] = $new_city;
        $_SESSION['email'] = $new_email;
        $_SESSION['phone'] = $new_phone;
        $_SESSION['disabilitydetails'] = $new_disability_details;

        echo "<script>alert('Gebruiker succesvol bijgewerkt.'); window.location.href='ProfileView.php';</script>";
    } else {
        echo "<script>alert('Gebruiker bijwerken mislukt.'); window.location.href='ProfileView.php';</script>";
    }
}

// dit checkt of de request een POST request is en roept de juiste functie aan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        // dit roept de functie handleLogin aan
        handleLogin($email, $password);
    } elseif (isset($_POST['logout'])) {
        // dit roept de functie handleLogout aan
        handleLogout();
    } elseif (isset($_POST['update'])) {
        // dit roept de functie handleUpdate aan
        handleUpdate();
    }
}