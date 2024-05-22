<?php
include_once __DIR__ . "/Database.php";


class User {
    public function addUser($name, $address, $city, $phoneNumber, $email, $password) {
        $db = new Database();
        $conn = $db->getDb();

        // Hash het wachtwoord voordat je het opslaat in de database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO users (name, address, city, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $address, $city, $phoneNumber, $email, $hashedPassword]);

        // Redirect to success page or do further processing as needed
        header("Location: ../view/template/login.php");
        exit();
    }


    public function loginUser($email, $password) {
        $db = new Database();
        $conn = $db->getDb();

        // Prepare statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Controleer of gebruiker is gevonden en of wachtwoord overeenkomt
        if ($user && password_verify($password, $user['password'])) {
            // Gebruiker is succesvol ingelogd
            // Hier kun je verdere acties uitvoeren, bijvoorbeeld sessievariabelen instellen
            session_start();
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role']; // Sla de gebruikersrol op in de sessie

            // Doorsturen naar het juiste dashboard op basis van gebruikersrol
            if ($user['role'] == 'student') {
                header("Location: ../view/template/student_dashboard.php");
            } elseif ($user['role'] == 'instructor') {
                header("Location: ../view/template/instructeur_dashboard.php");
            }

            exit();
        } else {
            // Gebruiker niet gevonden of wachtwoord incorrect
            echo "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }
    

    public function logoutUser() {
        session_start();
        session_destroy();
        header("Location: ../template/login.php");
        exit();
    }
    
}