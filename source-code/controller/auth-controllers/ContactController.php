<?php

require_once '../model/User.php';
require_once 'SessionController.php';
require_once 'CheckInlogController.php';
require_once '../model/Database.php';

class ContactController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDb();
    }

    public function processFormSubmission() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $message = $_POST["message"];

            try {
                $stmt = $this->db->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':message', $message);
                $stmt->execute();

                header("Location: success.php");
                exit();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

// Creëer een instantie van de ContactController en verwerk het formulierinzending
$contactController = new ContactController();
$contactController->processFormSubmission();
?>
